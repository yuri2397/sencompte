<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::post('/pay-ipn', [ClientController::class, 'ipn']);
Route::get('/pay-cancel', [ClientController::class, 'cancel']);
Route::get('/pay-success', [ClientController::class, 'succss']);
