<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitcoinController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/crypto', [BitcoinController::class, 'store']);
Route::get('/crypto/{symbol}/{time}/{timeValue}', [BitcoinController::class, 'show']);
