<?php

use App\Models\Client;
use App\Models\Profile;
use App\Mail\ManqueDeProfil;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;

/**
 * HOME PAGE
 */
Route::view('/', 'welcome', [
    'clients_number' => count(Client::all()),
    "profiles_number" => count(Profile::all())
]);

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
 * PASSWORD CONTROLLER
 */
Route::view("/forgot-password", "auth.forgot-password")
    ->name("forgotPasswordForm");

Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])
    ->name("forgotPassword");

Route::get('/new-password/{token}/{email}', [PasswordController::class, 'newPasswordForm'])
    ->name("newPasswordForm");
Route::post('/new-password', [PasswordController::class, 'newPassword'])
    ->name("newPassword");
/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->middleware(['auth:admin', 'role:Admin'])->group(function () {
    Route::get('/', [AdminController::class, 'home'])
        ->name("admin");
    Route::get('/profile', [AdminController::class, "profile"])->name("admin.profile");
    Route::get('accounts', [AdminController::class, 'accountsPage'])->name('admin.accounts');
    Route::get('add-account', [AdminController::class, 'addAccountPage'])->name('add.accountForm');
    Route::get('show-account/{id}', [AdminController::class, 'showAccount'])->name('show.account');
    Route::post('add-account', [AdminController::class, 'addAccount'])->name('add.account');
    Route::post('delete-account/{id}', [AdminController::class, 'deleteAccount'])->name('delete.account');
    Route::post('update-account/{id}', [AdminController::class, 'updateAccount'])->name('update.account');
    Route::post('/change-password', [AdminController::class, "changerPassword"]);

    Route::get('clients', [AdminController::class, 'clientsPages'])->name('clientsPage');
    Route::get('client-profile/{id}', [AdminController::class, 'showClientProfile'])->name('showClientProfile');
});

/**
 * CLIENT ROUTES
 */
Route::prefix('client')->middleware(['auth:client'])->group(function () {
    Route::get('/', [ClientController::class, 'home'])
        ->name("client");
    Route::get('abonnement/{id}', [ClientController::class, 'show'])
        ->name("client.show");

    Route::get('/abonnement', [ClientController::class, 'abonnement'])
        ->name("client.abonnement");
    Route::get('payement/{id}', [ClientController::class, 'renouvellement'])->name('renouvellement');
    Route::post('/change-password', [ClientController::class, "changerPassword"]);
    Route::get('confirmation/{token}/{email}/', [ClientController::class, 'confirmationForm'])->withoutMiddleware("auth:client");
    Route::get('params/', [ClientController::class, 'params'])->name("client.params");
    Route::post('confirmation', [ClientController::class, 'confirmation'])->withoutMiddleware("auth:client");
});

Route::view("pay-success", 'client.pay-success');
Route::view("pay-cancel", 'client.pay-cancel');


Route::get('/test', function () {
    return DB::table('payments')
    ->whereYear('created_at', date('Y'))
    ->whereMonth('created_at', date('n'))
    ->select("amount")
    ->sum("amount");
});
