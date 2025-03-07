<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
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

    Route::get('/dashboard', [ClientController::class, 'dashboard']);

    Route::get('/company/show/{company_id}', [CompanyController::class, 'show']);
    Route::post('/company/store', [CompanyController::class, 'store']);
    Route::patch('/company/update/{company_id}', [CompanyController::class, 'update']);
    Route::delete('/company/delete/{company_id}', [CompanyController::class, 'delete']);

    Route::get('/shop/show/{shop_id}', [ShopController::class, 'show']);
    Route::post('/shop/store', [ShopController::class, 'store']);
    Route::patch('/shop/update/{shop_id}', [ShopController::class, 'update']);
    Route::delete('/shop/delete/{shop_id}', [ShopController::class, 'delete']);

    Route::post('/initialize-client-data', [ClientController::class, 'initializeClientData']);
});
