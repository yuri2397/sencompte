<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __contruct()
    {
        $this->middleware("guest");
    }

    public function registerForm()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'min:2', 'string'],
            'last_name' => ['required', 'min:2', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
            'password' => ['required', 'min:6',],
            'phone_number' => ['required', 'min:9', 'max:15']
        ]);

        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->phone_number = $request->phone_number;
        $client->password = bcrypt($request->password);
        $client->save();

        session(['user_email' => $client->email, 'user_id' => $client->id]);
        $request->session()->regenerate();
        Flashy::success('Bienvenue', $client->first_name . ' ' . $client->last_name);

        session([
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'email' => $client->email
        ]);
        return redirect()->intended('profile');
    }
}
