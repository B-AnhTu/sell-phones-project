<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->user_type == 1) {
                // User is an admin
                return $next($request);
            } else {
                // Redirect regular users to a different route
                return redirect()->route('user.home');
            }
        } else {
            // Redirect unauthenticated users to login page
            return redirect()->route('login');
        }
    }
}