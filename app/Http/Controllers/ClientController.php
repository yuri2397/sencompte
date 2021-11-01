<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private const PRICE = 2000;
    const URL_BASE = "https://paytech.sn/api";
    const COMMAND_NAME = "Abonnement Netflix";
    const HOST = "https://sencompte.sn/";
    const PAYTECH = "https://paytech.sn";
    private $api_key;
    private $secret_key;
    public function __construct()
    {
        $this->middleware(['auth:client']);
        $this->api_key = "e48863b91a1e6edea5f95fda966c0e4bb3be1cb08f849b5873656db9d209f103";
        $this->secret_key = "85fb1a9ccfa99b1105bc23526ef43ae3c2226031f654bfd20f28e58bc3e72b8e";
    }

    public function home($message = null)
    {
        if ($message)
            toastr()->error($message);

        $user = Auth::user();
        $profiles = Profile::whereClientId($user->id)->get();
        return view("client.profile")->with([
            "profiles" => $profiles,
            'name' => $user->first_name
        ]);
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        if ($profile == null)
            return back();
        return view('client.show-profile')->with(['profile' => $profile]);
    }



    public function ipn(Request $request)
    {
        $api_key_sha256 = $request->api_key_sha256;
        $api_secret_sha256 = $request->api_secret_sha256;

        if (hash('sha256', $this->secret_key) === $api_secret_sha256 && hash('sha256', $this->api_key) === $api_key_sha256) {

            $client_phone = $request->client_phone;
            $via = $request->payment_method;
            $item_price = $request->item_price;
            $custom_field = $request->custom_field;
            $client = Client::find($custom_field['client_id']);

            if ($request->type_event === "sale_complete") {

                DB::beginTransaction();

                $profile = Profile::whereClientId(null)->first();
                if ($profile == null) {
                    $not = new Notification;
                    $not->date = date(now());
                    $not->message = "Il y a eu une erreur sur la validation d'un profil pour <span class='cc_error'>" . $client->first_name . " " . $client->last_name . "</span>";
                    $not->save();
                } else {
                    $profile->date_end = Carbon::now()->addMonth();
                    $profile->save();
                }

                $payment = new Payment();
                $payment->amount = $item_price;
                $payment->date = date(now());
                $payment->via = $via;
                $payment->profile_id = $custom_field['profile_id'];
                $payment->client_id = $custom_field['client_id'];
                $payment->phone_number = $client_phone;
                $payment->save();

                DB::commit();
            }
        }
    }


    private function requestPayment($data)
    {
        $ch = curl_init(self::URL_BASE . "/payment/request-payment");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
            "API_KEY: {$this->api_key}",
            "API_SECRET: {$this->secret_key}"
        ], [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length: ' . mb_strlen(http_build_query($data))
        ]));

        $rawResponse = curl_exec($ch);

        $jsonResponse = json_decode($rawResponse, true);

        if ($jsonResponse != null && $jsonResponse['success'] === 1) {
            return redirect($jsonResponse['redirectUrl']);
        } else {
            toastr()->error("Merci de réessayer plus tart.", "Erreur de payement");
            back();
        }
    }
}
