<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['IsGuest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login/store', [AuthController::class, 'store']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('IsLogin');

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::middleware(['IsAdmin'])->group(function () {
        Route::get('/product', [ProductController::class, 'index']);
        Route::get('/product/create', [ProductController::class, 'create']);
        Route::post('/product/store', [ProductController::class, 'store']);
        Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
        Route::put('/product/{id}', [ProductController::class, 'update']);
        Route::delete('/product/{id}', [ProductController::class, 'destroy']);

        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/create', [UserController::class, 'create']);
        Route::post('/user/store', [UserController::class, 'store']);
        Route::get('/user/edit/{id}', [UserController::class, 'edit']);
        Route::put('/user/{id}', [UserController::class, 'update']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);
    });

    Route::middleware(['IsEmployee'])->group(function () {
        Route::get('/sale', [SaleController::class, 'index']);
    });

});
