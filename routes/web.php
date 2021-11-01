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

Route::get('/register', [RegisterController::class, 'showClientRegisterForm'])
    ->name("client.registerForm");

Route::post('/register', [RegisterController::class, 'createClient'])
    ->name("client.register");

/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->middleware(['auth:admin', 'role:Admin'])->group(function () {
    Route::get('/', [AdminController::class, 'home'])
        ->name("admin");

    Route::get('accounts', [AdminController::class, 'accountsPage'])->name('admin.accounts');
    Route::get('add-account', [AdminController::class, 'addAccountPage'])->name('add.accountForm');
    Route::get('show-account/{id}', [AdminController::class, 'showAccount'])->name('show.account');
    Route::post('add-account', [AdminController::class, 'addAccount'])->name('add.account');
    Route::post('delete-account/{id}', [AdminController::class, 'deleteAccount'])->name('delete.account');

    Route::get('clients', [AdminController::class, 'clientsPages'])->name('clientsPage');
    Route::get('client-profile/{id}', [AdminController::class, 'showClientProfile'])->name('showClientProfile');
});

/**
 * CLIENT ROUTES
 */
Route::prefix('client')->middleware(['auth:client'])->group(function () {
    Route::get('/', [ClientController::class, 'home'])
        ->name("client");
    Route::get('/{id}', [ClientController::class, 'show'])
        ->name("client.show");

    Route::get('/abonnement', [ClientController::class, 'abonnement'])
        ->name("client.abonnement");
});

Route::view('test', 'auth.register');
Route::view("pay-success", 'client.pay-success');
Route::view("pay-cancel", 'client.pay-cancel');
