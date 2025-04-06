<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlreadyVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('client')->user() ?? (Auth::guard('publisher')->user() ?? Auth::guard('admin')->user());

        if ($user && $user->email_verified_at) {

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Your email already verified.',
                ], 403)->header('Content-Type', 'application/json');
            }

            return match ($user->role) {
                'admin' => redirect()->route('admin.profile')->with('success', 'Your email already verified.'),
                'publisher' => redirect()->route('publisher.profile')->with('success', 'Your email already verified.'),
                default => redirect()->route('client.index')->with('success', 'Your email already verified.')
            };
        }

        return $next($request);
    }
}