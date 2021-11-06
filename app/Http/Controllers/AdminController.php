<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Utils;
use App\Models\Client;
use App\Models\Account;
use App\Models\Message;
use App\Models\Profile;
use App\Utils\Statistics;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use Statistics, Utils;
    public $admin;
    public function __construct()
    {
        $this->middleware(['auth:admin', 'role:Admin']);
    }

    private function initNav()
    {
        $this->admin = Auth::user();
        $this->notifications = Notification::whereIsRead(false)->get();
        $this->messages = Message::whereIsRead(false)->get();
    }

    public function home()
    {
        $this->initNav();
        return view("admin.dashboard")->with([
            "content_row" => $this->contentRow(),
            "clients_sub" => $this->clientsSub(),
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }

    public function accountsPage()
    {
        $accounts = Account::all();
        $this->initNav();

        collect($accounts)->map(function ($account) {
            $account->profiles = $account->profiles()->whereClientId(null)->get();
        });
        return view('admin.account-list')->with([
            'accounts' => $accounts,
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }

    public function profile()
    {
        $this->initNav();
        return view('admin.admin-profile')->with([
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }


    public function addAccountPage()
    {
        $this->initNav();

        return view('admin.add-account')->with([
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }

    public function addAccount(Request $request)
    {
        $request->validate([
            'account_email' => 'required|unique:accounts,email',
            'account_password' => 'required|min:6'
        ]);

        $account = new Account;
        $account->email = $request->account_email;
        $account->password = $request->account_password;
        $account->save();

        for ($i = 0; $i < 5; $i++) {
            $profile = new Profile;
            $profile->pin = rand(1000, 9999);
            $profile->account_id = $account->id;
            $profile->number = $i + 1;
            $profile->date_end = date(now());
            $hash = '';
            while (true) {
                $hash = Str::random(30);
                if (Profile::whereHash($hash)->first() == null) break;
            }
            $profile->hash = $hash;
            $profile->client_id = null;
            $profile->save();
        }

        toastr()->success('Nouveau compte ajouté avec succés', "Ajoute d'un compte");
        return $this->showAccount($account->id);
    }

    public function clientsPages()
    {
        $clients = Client::with('profiles')->get();
        $this->initNav();
        return view('admin.clients-list')->with([
            'clients' => $clients,
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }

    public function showAccount($id)
    {
        $account = Account::with("profiles")->find($id);
        $this->initNav();

        if ($account) {
            return view("admin.account-show")->with([
                'account' => $account,
                "admin" => $this->admin,
                "notifications" => $this->notifications,
                "messages" => $this->messages
            ]);
        }
        toastr()->error('Le compte n° ' . $id . ' n \'existe pas.', "Attention");
        return back();
    }

    public function deleteAccount($id)
    {
        $account = Account::with('profiles')->find($id);
        if ($account) {
            foreach ($account->profiles as $profile) {
                if ($profile->client_id != null) {
                    toastr()->error("Il y a des clients abonnés dans cet compte.", "Impossible de supprimer ce compte");
                    return back();
                }
            }
            $account->delete();
            toastr()->success("Le compte est ses profiles sont supprimés avec succès.", "Suppression succès");
            return back();
        } else {
            toastr()->error("Le compte n° '$id' n'existe pas.", "Erreur de suppression");
            return back();
        }
    }


    public function showClientProfile($id)
    {
        $client = Client::with('profiles')->find($id);
        $this->initNav();
        return view("admin.show-client-profile")->with([
            'client' => $client,
            "admin" => $this->admin,
            "notifications" => $this->notifications,
            "messages" => $this->messages
        ]);
    }

    public function updateAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "new_password" => "required|min:6"
        ]);

        if ($validator->fails()) {
            toastr()->error("Le mot de passe est requi.", "Modification de mot de passe");
            return redirect()->route("admin.accounts");
        }
        else{
            $account = Account::find($id);
            $account->password = $request->new_password;
            $account->save();
            toastr()->success("Mis à jour efféctuer avec succés", "Modification de mot de passe");
            return redirect()->route("admin.accounts");
        }


    }

    public function changerPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "new_password" => "required",
            "password" => "required|min:6"
        ]);

        if($validator->fails()){
            return back()->withInput();
        }

        $admin = User::find(auth()->id());
        if($admin && Hash::check($request->password, $admin->password)){
            $admin->password = bcrypt($request->new_password);
            $admin->save();
            toastr()->success("Mot de passe modifier avec succès.");
            return back(301);
        }
        else{
            toastr()->success("Le mot de passe saisie est invalide.");
            return back(301);
        }
    }
}
