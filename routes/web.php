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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');

    Route::middleware(['IsAdmin'])->group(function () {
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
        Route::get('/sale/create', [SaleController::class, 'create'])->name('sale.create');
        Route::get('/sale/create/post', [SaleController::class, 'post'])->name('sale.post');
        Route::get('/sale/create/member/{id}', [SaleController::class, 'member'])->name('sale.member');
        Route::post('/sale/session', [SaleController::class, 'session'])->name('sale.session');
        Route::post('/sale/store', [SaleController::class, 'store'])->name('sale.store');
        Route::post('/sale/member/{id}', [SaleController::class, 'saveMember'])->name('sale.member.save');
        Route::get('/sale/detail-print/{id}', [SaleController::class, 'detail'])->name('sale.detail');
        Route::get('/sale/edit/{id}', [SaleController::class, 'edit']);
        Route::put('/sale/{id}', [SaleController::class, 'update']);
        Route::delete('/sale/{id}', [SaleController::class, 'destroy']);
    });

});
