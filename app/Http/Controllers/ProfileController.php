<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Profile;
use App\Mail\ManqueDeProfil;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\ChangerMotDePasse;
use App\Mail\ProfileExipreDans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function removeNoPay()
    {
        Profile::where('date_end', "<=", Carbon::now())->update([
            "client_id" => null,
            "date_end" => null
        ]);

        $accounts = DB::table('accounts as A')
            ->join("profiles as P", "P.account_id", "A.id")
            ->where('P.date_end', '<=', Carbon::now())
            ->where("P.client_id", "=", null)
            ->select("A.*")
            ->groupBy("A.email", "A.password", "A.id", "A.created_at", "A.updated_at")
            ->get();
        Mail::to(env('ADMIN_EMAIL'))->send(new ChangerMotDePasse($accounts));
    }

    public function manqueProfiles()
    {
        if (count(Profile::whereClientId(null)->get()) === 0) {
            Mail::to(env('ADMIN_EMAIL'))->send(new ManqueDeProfil());
            $not = new Notification;
            $not->date = date(now());
            $not->message("Il y a plus de profils disponible.");
            $not->save();
        }
    }

    public function avertissements()
    {
        $profiles = Profile::where('date_end', '>=', Carbon::now()->addDays(4))
            ->where("client_id", "!=", null)
            ->get();
        collect($profiles)->map(function ($profile) {
            Mail::to($profile->client->email)->send(new ProfileExipreDans($profile));
        });
    }
}
