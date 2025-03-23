<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/* Auth routes */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerView'])->name('registerView');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::prefix('/')->middleware('auth')->group(function () {
    /* Logout route */
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});

/* Publisher routes */
Route::prefix('/publisher')->as('publisher.')->middleware('auth')->group(function () {
    /* Publisher Home */
    Route::get('/', [PublisherController::class,  'index'])->name('index');
    /* Publisher Products rotes */
    Route::prefix('/products')->as('products.')->group(function () {
        Route::get('/', [PublisherController::class, 'products'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
    });
});


/* Admin routes */
Route::prefix('/admin')->as('admin.')->middleware('auth')->group(function () {
    /* Admin Home */
    Route::get('/', [AdminController::class,  'index'])->name('index');

    /* Admin Categories rotes */
    Route::prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('delete');
    });

    /* Admin Products rotes */
    Route::prefix('/products')->as('products.')->group(function () {
        Route::get('/', [AdminController::class, 'products'])->name('index');
        Route::get('/{product}', [AdminController::class, 'product'])->name('show');
        Route::delete('/delete/{product}', [AdminController::class, 'destroyProduct'])->name('delete');
    });

    /* Admin Orders rotes */
    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', [AdminController::class, 'orders'])->name('index');
        Route::get('/{order}', [AdminController::class, 'order'])->name('show');
        Route::delete('/delete/{order}', [AdminController::class, 'destroyOrder'])->name('delete');
        Route::get('{order}/change-status', [AdminController::class, 'changeOrderStatusView'])->name('edit');
        Route::put('{order}/change-status', [AdminController::class, 'changeOrderStatus'])->name('update');
    });

    /* Admin Payments rotes */
    Route::prefix('/payments')->as('payments.')->group(function () {
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
        Route::delete('/delete/{payment}', [PaymentController::class, 'destroy'])->name('delete');
        Route::get('/edit/{payment}', [PaymentController::class, 'edit'])->name('edit');
        Route::put('/update/{payment}', [PaymentController::class, 'update'])->name('update');
    });

    /* Admin Users rotes */
    Route::prefix('/users')->as('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('delete');
    });
});

