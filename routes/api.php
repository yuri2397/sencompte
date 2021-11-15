<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::post('/pay-ipn', [ClientController::class, 'ipn']);
Route::post('/payement', [ClientController::class, 'ipnRenouvellement']);
