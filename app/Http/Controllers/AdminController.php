<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __contruct()
    {
        $this->middleware(['auth:Admin', 'role:Admin']);
    }

    public function home()
    {
        $user = Auth::user();

        return view("admin.admin-profile")->with([
            "user" => $user
        ]);
    }
}
