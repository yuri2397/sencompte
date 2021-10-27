<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * HOME PAGE
 */
Route::view('/', 'welcome');

/**
 * SHARED ROUTES
 */
Route::get('login', [LoginController::class, 'loginForm'])
    ->middleware("guest")
    ->name("loginForm");

Route::post('login', [LoginController::class, 'login'])
    ->middleware("guest")
    ->name("login");

Route::post('logout', [LoginController::class, 'logout'])
    ->name("logout");

/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'home'])
        ->name("admin");
});

/**
 * CLIENT ROUTES
 */
Route::prefix('client')->middleware(['auth:client'])->group(function () {
    Route::get('/', [ClientController::class, 'home'])
        ->name("client");
    Route::get('/{id}', [ClientController::class, 'show'])
        ->name("client.show");

    Route::get('/register', [RegisterController::class, 'showClientRegisterForm'])
        ->withoutMiddleware('auth:client')
        ->name("client.registerForm");
    Route::post('/register', [RegisterController::class, 'createClient'])
        ->withoutMiddleware('auth:client')
        ->name("client.register");

    Route::post('/abonnement', [ClientController::class, 'abonnement'])
        ->name("client.abonnement");
});
