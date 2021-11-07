<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Models\Client;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            "email" => "required|email"
        ]);

        $user = Client::whereEmail($request->email)->first();
        if ($user == null)
            $user = User::whereEmail($request->email)->first();
        if ($user == null) {
            return back()->withErrors([
                "message" => "Votre adresse email n'existe pas. "
            ]);
        } else {
            Mail::to($user->email)->send(new ForgotPassword($user));
            return back();
        }
    }

    public function newPasswordForm($token, $email)
    {
        $data = PasswordReset::whereEmail($email)->whereToken($token)->first();
        if ($data == null) {
            return back();
        }
        return view("auth.new-password")->with([
            'token' => $token,
            "email" => $email
        ]);
    }

    public function newPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "token" => "required|exists:password_resets,token",
            "email" => "required|exists:password_resets,email",
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($request->all());
        }

        $user = Client::whereEmail($request->email)->first();
        if ($user == null)
            $user = User::whereEmail($request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route("login");
    }
}
