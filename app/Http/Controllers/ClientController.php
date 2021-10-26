<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private const PRICE = 2000;
    const URL_BASE = "https://paytech.sn/api";
    const COMMAND_NAME = "abonnement(s)";
    const HOST = "https://univ-resto.herokuapp.com";
    const PAYTECH = "https://paytech.sn";
    private $api_key;
    private $secret_key;
    public function __construct()
    {
        $this->middleware("auth");
        $this->api_key = env('PAYTECH_API_KEY');
        $this->secret_key = env('PAYTECH_SECRET_KEY');
    }

    public function home()
    {
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
        return view('client.show-profile')->with(['profile' => $profile]);
    }

    /**
     * Ajouter un nouveau abonnement
     */
    public function abonnement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'abonnement' => ['numeric', 'min:1', 'max:5']
        ]);

        $profiles_dispo = Profile::whereClientId(null)->get();

        if ($profiles_dispo && count($profiles_dispo) >= $request->abonnement) {
            $user = Client::find(auth()->id());
            $ref = $user->email . '_' . time();

            // calcule du montant
            $amount = $request->abonnement * static::PRICE;

            $customfield = json_encode([
                'email' => $user->email,
                'amount' => $amount,
                'ref' => $ref,
            ]);

            $data = [
                'item_price' => $amount,
                "currency"     => "xof",
                "ref_command" => $ref,
                'item_name' => $request->abonnement . ' ' .self::COMMAND_NAME,
                'command_name' =>   $request->abonnement . ' ' .self::COMMAND_NAME,
                "success_url"  =>  self::HOST . '/api/pay-success',
                "ipn_url"      =>  self::HOST . '/api/pay-ipn',
                "cancel_url"   =>  self::HOST . '/api/pay-cancel',
                'env' => 'test',
                "custom_field" =>   $customfield,
            ];
            return $this->requestPayment($data);
        }
    }

    /**
     * ANNULATION
     */
    public function cancel(Request $request)
    {
        return view('pay-cancel');
    }

    /**
     *
     */
    public function success()
    {
        # code...
    }

    /**
     * IPN
     */
    public function ipn(Request $request)
    {
        $api_key_sha256 = $request->api_key_sha256;
        $api_secret_sha256 = $request->api_secret_sha256;

        if (hash('sha256', $this->secret_key) === $api_secret_sha256 && hash('sha256', $this->api_key) === $api_key_sha256) {
            if ($request->type_event === "sale_complete") {

                DB::beginTransaction();



                DB::commit();
            }
        }
    }

    /**
     * Requet vers PayTech
     */
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
            return response()->json($jsonResponse, 200);
        } else {
            return response()->json([
                "message" => "Une erreur c'est produit. Merci de réessayer plustard.",
                "code" => 500,
            ], 500);
        }
    }
}
