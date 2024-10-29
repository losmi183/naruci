<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/whoami', [AuthController::class, 'whoami'])->middleware([JwtMiddleware::class]);
});

Route::group(['middleware' => [JwtMiddleware::class], 'prefix' => 'client'], function () {

    Route::post('/create-company', [ClientController::class, 'createCompany']);
    Route::post('/initialize-client-data', [ClientController::class, 'initializeClientData']);
});