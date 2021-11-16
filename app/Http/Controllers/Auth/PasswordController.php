<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Models\Client;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
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
            toastr("Votre adresse email n'existe pas.", "error", "Notification");
            return back()->withErrors([
                "message" => "Votre adresse email n'existe pas. "
            ]);
        } else {
            toastr("Nous vous avons envoyé un mail de réinitialisation de mot de passe.", "success", "Notification");
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
            toastr("Veuillez verifier les informations saisies.", "error", "Notification");
            return back()->withErrors($validator->errors());
        }

        $user = Client::whereEmail($request->email)->first();
        if ($user == null)
            $user = User::whereEmail($request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        DB::delete('delete from password_resets where email = ? and token = ?', [$request->email, $request->token]);
        toastr("Modification de mot de passe succès.", "success", "Notification");
        return redirect()->route("login");
    }
}
