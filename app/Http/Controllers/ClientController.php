<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private static $price = 2000;
    const URL_BASE = "https://paytech.sn/api";
    const COMMAND_NAME = "Achat de tickets";
    const HOST = "https://univ-resto.herokuapp.com";
    const PAYTECH = "https://paytech.sn";
    private $api_key;
    private $secret_key;
    public function __construct()
    {
        $this->middleware("auth");
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

    public function abonnement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'abonnement' => ['numeric', 'min:1', 'max:5']
        ]);

        $profiles_dispo = Profile::whereClientId(null)->get();

        if($profiles_dispo && count($profiles_dispo) >= $request->abonnement){

        }
    }
}
