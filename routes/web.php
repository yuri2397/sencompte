<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Route::get('profile',[ClientController::class, 'home'])->middleware("auth:client")->name("profile");
Route::get('profile/{id}',[ClientController::class, 'show'])->middleware("auth:client")->name("profile.show");

Route::get('login', [LoginController::class, 'loginForm'])->middleware("guest")->name("loginForm");
Route::get('register',[RegisterController::class, 'registerForm'])->middleware("guest")->name("registerForm");

Route::post('login', [LoginController::class, 'login'])->middleware("guest")->name("login");
Route::post('register', [RegisterController::class, 'register'])->middleware("guest")->name("register");
Route::get('logout',[LoginController::class, 'logout'])->middleware("auth:client")->name("logout");
Route::post('abonnement', [ClientController::class, 'abonnement'])->middleware("auth:client")->name("abonnement");
