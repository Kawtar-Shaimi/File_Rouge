<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


/* Auth routes */
Route::middleware(['guest:client', 'guest:admin', 'guest:publisher'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerView'])->name('registerView');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::prefix('/')->group(function () {
    /* Logout route */
    Route::post('logout/{guard}', [AuthController::class, 'logout'])->name('logout');
});

/* Home routes */
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
});

/* Clients routes */
Route::prefix('/client')->as('client.')->middleware('auth:client')->group(function () {
    /* Client Home */
    Route::get('/', [ClientController::class,  'index'])->name('index');
    Route::get('/edit', [ClientController::class, 'edit'])->name('edit');
    Route::put('/update/{client}', [ClientController::class, 'update'])->name('update');
    /* Client Cart routes */
    Route::prefix('/cart')->as('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('add');
        Route::delete('/remove/{product}', [CartController::class, 'removeFromCart'])->name('remove');
        Route::delete('/delete/{product}', [CartController::class, 'deleteFromCart'])->name('delete');
    });
    /* Client Wishlist routes */
    Route::prefix('/wishlist')->as('wishlist.')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/add/{product}', [WishlistController::class, 'addToWishlist'])->name('add');
        Route::delete('/remove/{product}', [WishlistController::class, 'removeFromWishlist'])->name('remove');
    });
    /* Client Review routes */
    Route::prefix('/review')->as('review.')->group(function () {
        Route::post('/{product}', [ReviewController::class, 'store'])->name('store');
        Route::put('/edit/{review}', [ReviewController::class, 'update'])->name('update');
        Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('destroy');
    });
    /* Client Order routes */
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::post('/makeOrder', [OrderController::class, 'makeOrder'])->name('makeOrder');
    Route::prefix('/order')->as('order.')->group(function () {
        Route::get('/success', [OrderController::class, 'successOrder'])->name('success');
        Route::get('/track', [OrderController::class, 'trackOrder'])->name('track');
        Route::post('/status', [OrderController::class, 'getOrderStatus'])->name('status');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });

});

/* Publisher routes */
Route::prefix('/publisher')->as('publisher.')->middleware('auth:publisher')->group(function () {
    /* Publisher Home */
    Route::get('/', [PublisherController::class,  'index'])->name('index');
    /* Publisher Products routes */
    Route::prefix('/products')->as('products.')->group(function () {
        Route::get('/', [PublisherController::class, 'products'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [PublisherController::class, 'product'])->name('show');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
    });
    /* Publisher Reviews routes */
    Route::prefix('/reviews')->as('reviews.')->group(function () {
        Route::get('/', [PublisherController::class, 'reviews'])->name('index');
        Route::get('/{review}', [PublisherController::class, 'review'])->name('show');
        Route::delete('/delete/{review}', [PublisherController::class, 'deleteReview'])->name('delete');
    });
    /* Publisher Orders routes */
    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', [PublisherController::class, 'orders'])->name('index');
        Route::get('/{order_number}', [PublisherController::class, 'order'])->name('show');
    });
});


/* Admin routes */
Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    /* Admin Home */
    Route::get('/', [AdminController::class,  'index'])->name('index');

    /* Admin Categories routes */
    Route::prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('delete');
    });

    /* Admin Products routes */
    Route::prefix('/products')->as('products.')->group(function () {
        Route::get('/', [AdminController::class, 'products'])->name('index');
        Route::get('/{product}', [AdminController::class, 'product'])->name('show');
        Route::delete('/delete/{product}', [AdminController::class, 'destroyProduct'])->name('delete');
    });

    /* Admin Reviews routes */
    Route::prefix('/reviews')->as('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/{review}', [ReviewController::class, 'show'])->name('show');
        Route::delete('/delete/{review}', [ReviewController::class, 'delete'])->name('delete');
    });

    /* Admin Orders routes */
    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', [AdminController::class, 'orders'])->name('index');
        Route::get('/{order}', [AdminController::class, 'order'])->name('show');
        Route::delete('/delete/{order}', [AdminController::class, 'destroyOrder'])->name('delete');
        Route::get('{order}/change-status', [AdminController::class, 'changeOrderStatusView'])->name('edit');
        Route::put('{order}/change-status', [AdminController::class, 'changeOrderStatus'])->name('update');
    });

    /* Admin Payments routes */
    Route::prefix('/payments')->as('payments.')->group(function () {
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
        Route::delete('/delete/{payment}', [PaymentController::class, 'destroy'])->name('delete');
        Route::get('/edit/{payment}', [PaymentController::class, 'edit'])->name('edit');
        Route::put('/update/{payment}', [PaymentController::class, 'update'])->name('update');
    });

    /* Admin Users routes */
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

