<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Mail\EmailConfirmation;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __contruct()
    {
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showClientRegisterForm()
    {
        return view('auth.register',);
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    protected function createClient(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'min:2', 'string'],
            'last_name' => ['required', 'min:2', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'phone_number' => ['required', 'min:9', 'max:15']
        ]);
        // send email
        try {
            $client = new Client;
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->email = $request->email;
            $client->phone_number = $request->phone_number;
            $client->password = bcrypt($request->password);

            Mail::to($client->email)->send(new EmailConfirmation($client));

            $client->save();
            return redirect()->route('login');
        } catch (\Throwable $th) {
            dd($th);
            toastr()->error("Votre addresse email est invalide.");
            return back();
        }
    }


}
