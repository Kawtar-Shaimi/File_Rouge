<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!FacadesAuth::guard('client')->check() 
            && !FacadesAuth::guard('publisher')->check() 
            && !FacadesAuth::guard('admin')->check()) 
        {
            return redirect()->route('loginView');
        }
        
        return $next($request);
    }
}
