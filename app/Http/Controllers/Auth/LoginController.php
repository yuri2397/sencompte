<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Client;
use App\Utils\UserAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use UserAuth;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (
            Auth::guard('client')->attempt($credentials, $request->remember ?? false)
            || Auth::guard("admin")->attempt($credentials, $request->remember ?? false)
        ) {
            if (Auth::guard('admin')->check()) {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/client');
        }
        return back()->withErrors([
            'login_error' => 'Email ou mot de passe incorrecte.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
