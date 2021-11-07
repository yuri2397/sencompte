<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Utils\PayTech;
use App\Models\Payment;
use App\Models\Profile;
use App\Mail\ManqueDeProfil;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PayementNotConf;
use App\Models\PayementPending;
use App\Mail\RenoullementSsucces;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NouveauAbonnementSucces;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    use PayTech;

    public function home()
    {
        $user = Auth::user();
        $profiles = Profile::whereClientId($user->id)->get();
        return view("client.profile")->with([
            "profiles" => $profiles,
            "user" => $user
        ]);
    }

    public function show($id)
    {
        $profile = Profile::whereHash($id)->first();
        if ($profile == null)
            return back();
        return view('client.show-profile')->with(['profile' => $profile]);
    }

    public function abonnement()
    {
        $profiles_dispo = Profile::whereClientId(null)->get();

        if ($profiles_dispo && count($profiles_dispo) > 0) {
            $user = Client::find(auth()->id());
            if ($user == null) redirect()->route("login");
            $ref = $user->email . '_' . now();

            $customfield = json_encode([
                'email' => $user->email,
                'client_id' => $user->id,
                'amount' => $this->price,
                'ref' => $ref,
            ]);

            $data = [
                'item_price' => $this->price,
                "currency"     => "xof",
                "ref_command" => $ref,
                'item_name' => $this->command_name,
                'command_name' => $this->command_name,
                "success_url"  =>  $this->host . '/pay-success',
                "ipn_url"      =>  $this->host . '/api/pay-ipn',
                "cancel_url"   =>  $this->host . '/pay-cancel',
                'env' => 'prod',
                "custom_field" =>   $customfield,
            ];
            return $this->requestPayment($data, $user);
        } else {
            Mail::to(env('MAIL_FROM_NAME'))->send(new ManqueDeProfil());
            toastr()->error("Il n y a pas de compte disponible. Réesayer plus tard.", "Erreur d'abonnement");
            return back();
        }
    }

    public function renouvellement($hash)
    {
        $profile = Profile::whereHash($hash)->first();

        if ($profile) {
            $user = Client::find(auth()->id());
            if ($user == null) redirect()->route("login");
            $ref = $user->email . '_' . now();
            $customfield = json_encode([
                'email' => $user->email,
                'client_id' => $user->id,
                'profile_id' => $profile->id,
                'amount' => $this->price,
                'ref' => $ref,
            ]);

            $data = [
                'item_price' => $this->price,
                "currency"     => "xof",
                "ref_command" => $ref,
                'item_name' => $this->command_name,
                'command_name' => $this->command_name,
                "success_url"  =>  $this->host . '/pay-success',
                "ipn_url"      =>  $this->host . '/api/payement',
                "cancel_url"   =>  $this->host . '/pay-cancel',
                'env' => 'prod',
                "custom_field" =>   $customfield,
            ];
            return $this->requestPayment($data, $user);
        } else {
            toastr()->error("Ce compte n'est plus à vous.", "Erreur de renouvellement");
            Auth::guard('client')->logout();
            return redirect()->route("/login");
        }
    }

    public function ipn(Request $request)
    {
        $api_key_sha256 = $request->api_key_sha256;
        $api_secret_sha256 = $request->api_secret_sha256;

        if (hash('sha256', $this->secret_key) === $api_secret_sha256 && hash('sha256', $this->api_key) === $api_key_sha256) {
            $token = $request->token;
            $pendding = PayementPending::whereToken($token)->first();

            if (($request->type_event === "sale_complete") && $pendding != null) {

                $client_phone = $request->client_phone;
                $via = $request->payment_method;
                $item_price = $request->item_price;
                $custom_field = json_decode($request->custom_field, true);
                $client = Client::find($custom_field['client_id']);

                DB::beginTransaction();

                $profile = Profile::whereClientId(null)->first();
                if ($profile == null) {
                    $notConf = new PayementNotConf();
                    $notConf->amount = $item_price;
                    $notConf->date = date(now());
                    $notConf->client_id = $client->id;
                    $notConf->save();
                } else {
                    $profile->date_end = Carbon::now()->addMonth();
                    $profile->client_id = $client->id;
                    $profile->save();
                }

                $pendding->delete();

                $payment = new Payment();
                $payment->amount = $item_price;
                $payment->date = date(now());
                $payment->via = $via;
                $payment->profile_id = $profile->id;
                $payment->client_id = $client->id;
                $payment->phone_number = $client_phone;
                $payment->save();

                DB::commit();

                try {
                    Mail::to($client->email)->send(new NouveauAbonnementSucces($client, $profile));
                } catch (\Throwable $th) {
                }
                return response()->json([], 200);
            }
        } else {
            return response()->json([
                "message" => "La requête ne vient pas de paytech."
            ], 200);
        }
    }

    public function ipnRenouvellement(Request $request)
    {
        $api_key_sha256 = $request->api_key_sha256;
        $api_secret_sha256 = $request->api_secret_sha256;

        if (hash('sha256', $this->secret_key) === $api_secret_sha256 && hash('sha256', $this->api_key) === $api_key_sha256) {
            $token = $request->token;
            $pendding = PayementPending::whereToken($token)->first();

            if (($request->type_event === "sale_complete") && $pendding != null) {

                $client_phone = $request->client_phone;
                $via = $request->payment_method;
                $item_price = $request->item_price;
                $custom_field = json_decode($request->custom_field, true);
                $client = Client::find($custom_field['client_id']);
                $profile = Profile::find($custom_field['profile_id']);
                DB::beginTransaction();

                $diff = Carbon::createFromFormat('Y-m-d H:s:i', $profile->date_end)->diffInDays(now()) + 1;

                if ($diff > 0) {
                    $profile->date_end = Carbon::now()->addMonth()->addDays($diff);
                } else {
                    $profile->date_end = Carbon::now()->addMonth();
                }
                $profile->client_id = $client->id;
                $profile->save();

                $pendding->delete();

                $payment = new Payment();
                $payment->amount = $item_price;
                $payment->date = date(now());
                $payment->via = $via;
                $payment->profile_id = $custom_field['profile_id'];
                $payment->client_id = $custom_field['client_id'];
                $payment->phone_number = $client_phone;
                $payment->save();

                DB::commit();

                try {
                    Mail::to($client->email)->send(new RenoullementSsucces($client, $profile));
                } catch (\Throwable $th) {
                }

                return response()->json([], 200);
            }
        } else {
            return response()->json([
                "message" => "La requête ne vient pas de paytech."
            ], 403);
        }
    }

    public function confirmationForm($token, $email)
    {
        $datas = DB::table('password_resets')->whereEmail($email)->whereToken($token)->first();
        if ($datas) {

            $client = Client::whereEmail($datas->email)->first();
            $client->email_verified_at = date(now());
            $client->save();
            $datas->delete();

            return view("client.email-verification-success");
        } else {
            return view("errors.email-verification-error");
        }
    }

    public function params()
    {
        $client = Client::find(auth()->id());
        return view("client.params")->with(['client' => $client]);
    }

    public function changerPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "password" => "required",
            "new_password" => "required|min:6"
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'message' => "Donner un mot de passe d'au moins 6 caractères."
            ]);
        }

        $client = Client::find(auth()->id());
        if ($client && Hash::check($request->password, $client->password)) {
            $client->password = bcrypt($request->new_password);
            $client->save();
            toastr()->success("Mot de passe modifier avec succès.");
            return back()->withErrors([
                'success' => "mot de passe modifier avec succès."
            ]);
        } else {
            toastr()->success("Le mot de passe saisie est invalide.");
            return back()->withErrors([
                'message' => "Le mot de passe courent est invalide."
            ]);
        }
    }
}
