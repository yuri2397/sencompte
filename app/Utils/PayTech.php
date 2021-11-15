<?php

namespace App\Utils;

use App\Models\PayementPending;

trait PayTech
{
    protected $price = 2000;
    protected $base_url = "https://paytech.sn/api";
    protected $command_name = "Abonnement Netflix";
    protected $host = "https://sencompte.sn";
    protected $paytech_host = "https://paytech.sn";
    protected $api_key = "e48863b91a1e6edea5f95fda966c0e4bb3be1cb08f849b5873656db9d209f103";
    protected $secret_key = "85fb1a9ccfa99b1105bc23526ef43ae3c2226031f654bfd20f28e58bc3e72b8e";

    protected function requestPayment($data, $client)
    {
        $ch = curl_init($this->base_url . "/payment/request-payment");
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
            $padding = new PayementPending;
            $padding->token = $jsonResponse['token'];
            $padding->client_id = $client->id;
            $padding->save();
            return redirect($jsonResponse['redirectUrl']);
        } else {
            toastr()->error("Merci de réessayer plus tart.", "Erreur de payement");
            back();
        }
    }

}
