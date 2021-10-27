<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('client', [ClientController::class, 'home'])
    ->middleware("auth.basic")
    ->name("client");

Route::get('admin', [AdminController::class, 'home'])
    ->middleware("auth.basic")
    ->name("admin");


Route::get('profile/{id}', [ClientController::class, 'show'])
    ->middleware("auth.basic")
    ->name("profile.show");

Route::get('login', [LoginController::class, 'loginForm'])
    ->middleware("guest")
    ->name("loginForm");

Route::get('register', [RegisterController::class, 'registerForm'])
    ->middleware("guest")
    ->name("registerForm");

Route::post('login', [LoginController::class, 'login'])
    ->middleware("guest")
    ->name("login");

Route::post('register', [RegisterController::class, 'register'])
    ->middleware("guest")
    ->name("register");

Route::post('logout', [LoginController::class, 'logout'])
    ->name("logout");

Route::post('abonnement', [ClientController::class, 'abonnement'])
    ->middleware("auth.basic")
    ->name("abonnement");

