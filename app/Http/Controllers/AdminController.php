<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use App\Models\Profile;
use App\Utils\Statistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use Statistics;
    public $admin;
    public function __construct()
    {
        $this->middleware(['auth:admin', 'role:Admin']);
    }

    public function home()
    {
        $this->admin = Auth::user();
        return view("admin.dashboard")->with([
            "content_row" => $this->contentRow(),
            "clients_sub" => $this->clientsSub(),
            "admin" => $this->admin
        ]);
    }

    public function accountsPage()
    {
        $this->admin = Auth::user();
        $accounts = Account::with('profiles')->get();
        return view('admin.account-list')->with([
            'accounts' => $accounts,
            "admin" => $this->admin
        ]);
    }


    public function addAccountPage()
    {
        $this->admin = Auth::user();
        return view('admin.add-account')->with([
            "admin" => $this->admin
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
            $profile->client_id = null;
            $profile->save();
        }

        toastr()->success('Nouveau compte ajouté avec succés', "Ajoute d'un compte");
        return $this->accountsPage();
    }

    public function clientsPages()
    {
        $clients = Client::with('profiles')->get();
        $this->admin = Auth::user();
        return view('admin.clients-list')->with([
            'clients' => $clients,
            "admin" => $this->admin
        ]);
    }

    public function showAccount($id)
    {
        $account = Account::with("profiles")->find($id);
        $this->admin = Auth::user();
        if ($account) {
            return view("admin.account-show")->with([
                'account' => $account,
                "admin" => $this->admin
            ]);
        }
        toastr()->error('Le compte n° ' . $id . ' n \'existe pas.', "Attention");
        return back();
    }
}
