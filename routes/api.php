<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/whoami', [AuthController::class, 'whoami'])->middleware([JwtMiddleware::class]);
});

Route::group(['middleware' => [JwtMiddleware::class], 'prefix' => 'client'], function () {

    Route::get('/company/show', [CompanyController::class, 'show']);
    Route::post('/company/store', [CompanyController::class, 'store']);
    Route::patch('/company/update/{company_id}', [CompanyController::class, 'update']);
    Route::delete('/company/delete/{company_id}', [CompanyController::class, 'delete']);

    Route::post('/initialize-client-data', [ClientController::class, 'initializeClientData']);
});
