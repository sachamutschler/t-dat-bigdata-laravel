<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoEntityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/crypto', [CryptoEntityController::class, 'store']);
Route::get('/crypto/{symbol}/{time}/{timeValue}', [CryptoEntityController::class, 'show']);
