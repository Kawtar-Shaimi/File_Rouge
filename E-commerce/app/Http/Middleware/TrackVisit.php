<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            $ip_address = $request->ip();
            $user_agent = $request->header('User-Agent');
            $last_visited_url = $request->url();
            $visitTimout = now()->subMinutes(30);

            $last_visit = Visit::where('ip_address', $ip_address)
                ->where('last_visit', '>', $visitTimout)
                ->first();
            
            if (!$last_visit) {
                Visit::create([
                    'ip_address' => $ip_address,
                    'user_agent' => $user_agent,
                    'last_visited_url' => $last_visited_url,
                    'last_visit' => now()
                ]);
            }
        }

        return $next($request);
    }
}
