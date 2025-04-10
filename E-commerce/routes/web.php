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
use App\Http\Controllers\FilterController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::middleware('trackVisit')->group(function () {
    /* Auth routes */
    Route::controller(AuthController::class)->middleware('guestAll')->group(function () {
        Route::get('/login', 'loginView')->name('loginView');
        Route::post('/login', 'login')->name('login');
        Route::get('/register', 'registerView')->name('registerView');
        Route::post('/register', 'register')->name('register');

        /* Reset Password routes */
        Route::prefix('/reset')->as('reset.')->group(function () {
            Route::get('/forget-password', 'forgetPassword')->name('forget-password');
            Route::post('/send-token', 'sendResetPassword')->name('send-token');
            Route::get('/{uuid}/notice', 'resetNotice')->name('notice');
            Route::get('/{uuid}/{token}', 'verifyResetPassword')->name('password');
            Route::post('/{uuid}/resend', 'resendResetPasswordEmail')->name('resend')->middleware('throttle:5,1');
            Route::post('/{uuid}/auth.reset-password', 'resetPassword')->name('auth.reset-password');
        });
    });

    Route::controller(AuthController::class)->middleware('authAll')->group(function () {
        /* Logout route */
        Route::post('logout/{guard}', 'logout')->name('logout');

        /* Verify Email routes */
        Route::prefix('/verify')->as('verify.')->middleware('alreadyVerified')->group(function () {
            Route::get('/{uuid}/notice', 'verifyNotice')->name('notice');
            Route::get('/{uuid}/{token}', 'verifyEmail')->name('email');
            Route::post('/{uuid}/resend', 'resendVerificationEmail')->name('resend')->middleware('throttle:5,1');
        });
    });

    /* Users routes */
    Route::controller(UserController::class)->prefix('/users')->middleware('authAll')->as('users.')->group(function () {
        /* Change Password routes */
        Route::prefix('/change-password')->as('change-password.')->group(function () {
            Route::get('/{uuid}', 'changePasswordView')->name('view');
            Route::post('/{uuid}', 'changePassword')->name('update');
        });

        /* Profile routes */
        Route::get('/{uuid}/edit', 'editProfile')->name('edit');
        Route::put('/update/{uuid}', 'updateProfile')->name('update');
    });

    /* Home routes */
    Route::prefix('/')->middleware('guestAuth')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('books', [BookController::class, 'index'])->name('books');
        Route::get('books/{uuid}', [BookController::class, 'show'])->name('books.show');
    });

    /* Clients routes */
    Route::prefix('/client')->as('client.')->middleware(['auth:client', 'ensureEmailIsVerified:client'])->group(function () {
        /* Client Home */
        Route::controller(ClientController::class)->withoutMiddleware(['ensureEmailIsVerified:client'])->group(function () {
            Route::get('/',   'index')->name('index');

            /* Client Filters routes */
            Route::controller(FilterController::class)->prefix('/filter')->as('filter.')->withoutMiddleware(['auth:client', 'trackVisit'])->group(function () {
                Route::get('/searchTerms', 'getBooksSearchTerms')->name('searchTerms');
                Route::get('/books', 'filterClientBooks')->name('books');
            });
        });

        /* Client Cart routes */
        Route::controller(CartController::class)->prefix('/cart')->as('cart.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/add/{uuid}', 'addToCart')->name('add');
            Route::delete('/remove/{uuid}', 'removeFromCart')->name('remove');
            Route::delete('/delete/{uuid}', 'deleteFromCart')->name('delete');
        });

        /* Client Wishlist routes */
        Route::controller(WishlistController::class)->prefix('/wishlist')->as('wishlist.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/add/{uuid}', 'addToWishlist')->name('add');
            Route::delete('/remove/{uuid}', 'removeFromWishlist')->name('remove');
        });

        /* Client Review routes */
        Route::controller(ReviewController::class)->prefix('/review')->as('review.')->group(function () {
            Route::post('/{uuid}', 'store')->name('store');
            Route::put('/edit/{uuid}', 'update')->name('update');
            Route::delete('/delete/{uuid}', 'destroy')->name('destroy');
        });

        /* Client Order routes */
        Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
        Route::controller(OrderController::class)->prefix('/order')->as('order.')->group(function () {
            Route::post('/makeOrder', 'makeOrder')->name('makeOrder');
            Route::get('/success', 'successOrder')->name('success');
            Route::withoutMiddleware(['auth:client', 'ensureEmailIsVerified:client'])->group(function () {
                Route::get('/track', 'trackOrder')->name('track');
                Route::post('/status', 'getOrderStatus')->name('status');
            });
            Route::get('/{uuid}', 'show')->name('show');
        });

        /* Client Payment routes */
        Route::controller(PaymentController::class)->prefix('/payment')->as('payment.')->group(function () {
            /* Stripe route */
            Route::get('/stripe/confirm-card', 'confirmCardPayment')->name('stripe.confirm-card');

            /* Paypal route */
            Route::get('/paypal/confirm-paypal', 'confirmPaypalPayment')->name('paypal.confirm-paypal');

            /* Common routes */
            Route::prefix('/online')->as('online.')->group(function () {
                Route::get('/success', 'paymentSuccess')->name('success');
                Route::get('/cancel', 'paymentCancel')->name('cancel');
                Route::get('/failed', 'paymentFailed')->name('failed');
                Route::get('/try-again', 'paymentTryAgain')->name('try-again');
            });
        });
    });

    /* Publisher routes */
    Route::prefix('/publisher')->as('publisher.')->middleware(['auth:publisher', 'ensureEmailIsVerified:publisher'])->group(function () {
        /* Publisher Home */
        Route::get('/', [PublisherController::class,  'index'])->name('index');
        Route::get('/profile', [PublisherController::class,  'profile'])->name('profile')->withoutMiddleware('ensureEmailIsVerified:publisher');

        /* Publisher Books routes */
        Route::controller(BookController::class)->prefix('/books')->as('books.')->group(function () {
            Route::get('/', [PublisherController::class, 'books'])->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{uuid}', [PublisherController::class, 'book'])->name('show');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::put('/update/{uuid}', 'update')->name('update');
            Route::delete('/delete/{uuid}', 'destroy')->name('delete');
        });

        /* Publisher Reviews routes */
        Route::controller(PublisherController::class)->prefix('/reviews')->as('reviews.')->group(function () {
            Route::get('/', 'reviews')->name('index');
            Route::get('/{uuid}', 'review')->name('show');
        });

        /* Publisher Orders routes */
        Route::controller(PublisherController::class)->prefix('/orders')->as('orders.')->group(function () {
            Route::get('/', 'orders')->name('index');
            Route::get('/{uuid}', 'order')->name('show');
            Route::post('/{uuid}/cancel', 'cancelOrder')->name('cancel');
        });

        /* Publisher Filters routes */
        Route::controller(FilterController::class)->prefix('/filter')->as('filter.')->withoutMiddleware('trackVisit')->group(function () {
            Route::get('/books', 'filterPublishersBooks')->name('books');
            Route::get('/orders', 'filterPublishersOrders')->name('orders');
            Route::get('/reviews', 'filterPublishersReviews')->name('reviews');
        });
    });

    /* Notifications routes */
    Route::controller(NotificationsController::class)->prefix('/notifications')->as('notifications.')->group(function () {
        Route::get('/client', 'client')->name('client');
        Route::get('/client/read-notification/{id}', 'readNotification')->name('read-notification');
        Route::get('/publisher', 'publisher')->name('publisher');
        Route::get('/admin', 'admin')->name('admin');
        Route::put('/mark-as-read/{guard}/{id}', 'markAsRead')->name('mark-as-read');
        Route::delete('/delete-notification/{guard}/{id}', 'deleteNotification')->name('delete');
    });
});

/* Admin routes */
Route::prefix('/admin')->as('admin.')->middleware(['auth:admin', 'ensureEmailIsVerified:admin'])->group(function () {
    /* Admin Home */
    Route::get('/', [AdminController::class,  'index'])->name('index');
    Route::get('/profile', [AdminController::class,  'profile'])->name('profile')->withoutMiddleware('ensureEmailIsVerified:admin');

    /* Admin Categories routes */
    Route::controller(CategoryController::class)->prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{uuid}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::put('/update/{uuid}', 'update')->name('update');
        Route::delete('/delete/{uuid}', 'destroy')->name('delete');
    });

    /* Admin Books routes */
    Route::controller(AdminController::class)->prefix('/books')->as('books.')->group(function () {
        Route::get('/', 'books')->name('index');
        Route::get('/{uuid}', 'book')->name('show');
        Route::delete('/delete/{uuid}', 'destroyBook')->name('delete');
    });

    /* Admin Reviews routes */
    Route::controller(ReviewController::class)->prefix('/reviews')->as('reviews.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{uuid}', 'show')->name('show');
        Route::delete('/delete/{uuid}', 'delete')->name('delete');
    });

    /* Admin Orders routes */
    Route::controller(AdminController::class)->prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', 'orders')->name('index');
        Route::get('/{uuid}', 'order')->name('show');
        Route::delete('/delete/{uuid}', 'destroyOrder')->name('delete');
        Route::get('{uuid}/change-status', 'changeOrderStatusView')->name('edit');
        Route::put('{uuid}/change-status', 'changeOrderStatus')->name('update');
    });

    /* Admin Payments routes */
    Route::controller(PaymentController::class)->prefix('/payments')->as('payments.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{uuid}', 'show')->name('show');
        Route::delete('/delete/{uuid}', 'destroy')->name('delete');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::put('/update/{uuid}', 'update')->name('update');
    });

    /* Admin Users routes */
    Route::controller(UserController::class)->prefix('/users')->as('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{uuid}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{uuid}', 'edit')->name('edit');
        Route::put('/update/{uuid}', 'update')->name('update');
        Route::delete('/delete/{uuid}', 'destroy')->name('delete');
    });

    /* Admin Visits routes */
    Route::controller(VisitController::class)->prefix('/visits')->as('visits.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/delete/{uuid}', 'destroy')->name('delete');
    });

    /* Admin Filters routes */
    Route::controller(FilterController::class)->prefix('/filter')->as('filter.')->group(function () {
        Route::get('/books', 'filterBooks')->name('books');
        Route::get('/orders', 'filterOrders')->name('orders');
        Route::get('/reviews', 'filterReviews')->name('reviews');
        Route::get('/users', 'filterUsers')->name('users');
        Route::get('/categories', 'filterCategories')->name('categories');
        Route::get('/visits', 'filterVisits')->name('visits');
        Route::get('/payments', 'filterPayments')->name('payments');
    });
});
