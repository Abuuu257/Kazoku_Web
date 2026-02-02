<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->usertype === 'admin') {
            return $next($request);
        }

        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('dashboard')->with('error', 'Access Denied: You do not have administrative privileges.');
        }

        return redirect()->route('login')->with('error', 'Please log in as an administrator to access this area.');
    }
}
