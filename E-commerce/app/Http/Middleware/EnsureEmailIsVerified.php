<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        $user = Auth::guard($guard)->user();


        if ($user && !$user->email_verified_at) {

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Please verify your email address to access this action.',
                ], 403)->header('Content-Type', 'application/json');
            }

            return redirect()->route('verify.notice', $user->uuid)
                ->with('error', 'Please verify your email address to access this page.');
        }

        return $next($request);
    }
}
