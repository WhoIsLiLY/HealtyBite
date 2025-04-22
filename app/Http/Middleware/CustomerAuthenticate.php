<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            abort(403, 'You already logged in as customer!');
        }
        if (!Auth::guard('customer')->check()) {
            // Redirect ke login kalau belum login
            return redirect()->route('customer.login');
        }
        
        return $next($request);
    }
}
