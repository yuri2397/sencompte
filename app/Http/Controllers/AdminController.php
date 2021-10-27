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

    public function __contruct()
    {
        $this->middleware(['auth:admin', 'role:Admin']);
    }

    public function home()
    {
        $admin = Auth::user();
        session(['admin' => $admin]);
        return view("admin.dashboard")->with([
            "content_row" => $this->contentRow(),
            "clients_sub" => $this->clientsSub()
        ]);
    }

    public function accountsPage()
    {
        $accounts = Account::with('profiles')->get();
        return view('admin.account-list')->with([
            'accounts' => $accounts
        ]);
    }
}
