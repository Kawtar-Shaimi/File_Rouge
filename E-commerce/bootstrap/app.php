<?php

use App\Http\Middleware\AlreadyVerified;
use App\Http\Middleware\Auth;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\Guest;
use App\Http\Middleware\GuestAuth;
use App\Http\Middleware\TrackVisit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'authAll' => Auth::class,
            'guestAll' => Guest::class,
            'guestAuth' => GuestAuth::class,
            'trackVisit' => TrackVisit::class,
            'ensureEmailIsVerified' => EnsureEmailIsVerified::class,
            'alreadyVerified' => AlreadyVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();