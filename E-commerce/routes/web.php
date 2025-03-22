<?php

use App\Http\Controllers\AuthController;
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
    /* Home redirection route */

});
