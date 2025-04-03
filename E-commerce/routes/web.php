<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


/* Auth routes */
Route::controller(AuthController::class)->middleware('guestAll')->group(function () {
    Route::get('/login', 'loginView')->name('loginView');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'registerView')->name('registerView');
    Route::post('/register', 'register')->name('register');
});

/* Logout route */
Route::post('logout/{guard}', [AuthController::class, 'logout'])->name('logout')->middleware('authAll');

/* Home routes */
Route::prefix('/')->middleware('guestAuth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('books', [BookController::class, 'index'])->name('books');
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
});

/* Clients routes */
Route::prefix('/client')->as('client.')->middleware('auth:client')->group(function () {
    /* Client Home */
    Route::controller(ClientController::class)->group(function () {
        Route::get('/',   'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/update/{client}', 'update')->name('update');
    });

    /* Client Cart routes */
    Route::controller(CartController::class)->prefix('/cart')->as('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{book}', 'addToCart')->name('add');
        Route::delete('/remove/{book}', 'removeFromCart')->name('remove');
        Route::delete('/delete/{book}', 'deleteFromCart')->name('delete');
    });

    /* Client Wishlist routes */
    Route::controller(WishlistController::class)->prefix('/wishlist')->as('wishlist.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{book}', 'addToWishlist')->name('add');
        Route::delete('/remove/{book}', 'removeFromWishlist')->name('remove');
    });

    /* Client Review routes */
    Route::controller(ReviewController::class)->prefix('/review')->as('review.')->group(function () {
        Route::post('/{book}', 'store')->name('store');
        Route::put('/edit/{review}', 'update')->name('update');
        Route::delete('/delete/{review}', 'destroy')->name('destroy');
    });

    /* Client Order routes */
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::controller(OrderController::class)->prefix('/order')->as('order.')->group(function () {
        Route::post('/makeOrder', 'makeOrder')->name('makeOrder');
        Route::get('/success', 'successOrder')->name('success');
        Route::get('/track', 'trackOrder')->name('track');
        Route::post('/status', 'getOrderStatus')->name('status');
        Route::get('/{order}', 'show')->name('show');
    });

});

/* Publisher routes */
Route::prefix('/publisher')->as('publisher.')->middleware('auth:publisher')->group(function () {
    /* Publisher Home */
    Route::get('/', [PublisherController::class,  'index'])->name('index');

    /* Publisher Books routes */
    Route::controller(BookController::class)->prefix('/books')->as('books.')->group(function () {
        Route::get('/', [PublisherController::class, 'books'])->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{book}', [PublisherController::class, 'book'])->name('show');
        Route::get('/edit/{book}', 'edit')->name('edit');
        Route::put('/update/{book}', 'update')->name('update');
        Route::delete('/delete/{book}', 'destroy')->name('delete');
    });

    /* Publisher Reviews routes */
    Route::controller(PublisherController::class)->prefix('/reviews')->as('reviews.')->group(function () {
        Route::get('/', 'reviews')->name('index');
        Route::get('/{review}', 'review')->name('show');
    });

    /* Publisher Orders routes */
    Route::controller(PublisherController::class)->prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', 'orders')->name('index');
        Route::get('/{order_number}', 'order')->name('show');
    });
});

/* Admin routes */
Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    /* Admin Home */
    Route::get('/', [AdminController::class,  'index'])->name('index');

    /* Admin Categories routes */
    Route::controller(CategoryController::class)->prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{category}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::put('/update/{category}', 'update')->name('update');
        Route::delete('/delete/{category}', 'destroy')->name('delete');
    });

    /* Admin Books routes */
    Route::controller(AdminController::class)->prefix('/books')->as('books.')->group(function () {
        Route::get('/', 'books')->name('index');
        Route::get('/{book}', 'book')->name('show');
        Route::delete('/delete/{book}', 'destroyBook')->name('delete');
    });

    /* Admin Reviews routes */
    Route::controller(ReviewController::class)->prefix('/reviews')->as('reviews.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{review}', 'show')->name('show');
        Route::delete('/delete/{review}', 'delete')->name('delete');
    });

    /* Admin Orders routes */
    Route::controller(AdminController::class)->prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', 'orders')->name('index');
        Route::get('/{order}', 'order')->name('show');
        Route::delete('/delete/{order}', 'destroyOrder')->name('delete');
        Route::get('{order}/change-status', 'changeOrderStatusView')->name('edit');
        Route::put('{order}/change-status', 'changeOrderStatus')->name('update');
    });

    /* Admin Payments routes */
    Route::controller(PaymentController::class)->prefix('/payments')->as('payments.')->group(function () {
        Route::get('/{payment}', 'show')->name('show');
        Route::delete('/delete/{payment}', 'destroy')->name('delete');
        Route::get('/edit/{payment}', 'edit')->name('edit');
        Route::put('/update/{payment}', 'update')->name('update');
    });

    /* Admin Users routes */
    Route::controller(UserController::class)->prefix('/users')->as('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{user}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::put('/update/{user}', 'update')->name('update');
        Route::delete('/delete/{user}', 'destroy')->name('delete');
    });
});

