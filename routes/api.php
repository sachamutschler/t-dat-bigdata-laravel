<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitcoinController;
use App\Http\Controllers\EthereumController;
use App\Http\Controllers\RippleController;
use App\Http\Controllers\CardanoController;
use App\Http\Controllers\SolanaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/crypto/btc', [BitcoinController::class, 'store']);
Route::post('/crypto/eth', [EthereumController::class, 'store']);
Route::post('/crypto/xrp', [RippleController::class, 'store']);
Route::post('/crypto/ada', [CardanoController::class, 'store']);
Route::post('/crypto/sol', [SolanaController::class, 'store']);
Route::get('/crypto/btc/{time}/{timeValue}', [BitcoinController::class, 'showByDate']);
Route::get('/crypto/eth/{time}/{timeValue}', [EthereumController::class, 'showByDate']);
Route::get('/crypto/xrp/{time}/{timeValue}', [RippleController::class, 'showByDate']);
Route::get('/crypto/ada/{time}/{timeValue}', [CardanoController::class, 'showByDate']);
Route::get('/crypto/sol/{time}/{timeValue}', [SolanaController::class, 'showByDate']);
Route::get('/crypto/btc', [BitcoinController::class, 'index']);
Route::get('/crypto/eth', [EthereumController::class, 'index']);
Route::get('/crypto/xrp', [RippleController::class, 'index']);
Route::get('/crypto/ada', [CardanoController::class, 'index']);
Route::get('/crypto/sol', [SolanaController::class, 'index']);
