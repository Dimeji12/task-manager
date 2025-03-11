<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the admin role (role_id = 1)
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request); // Allow access to the admin dashboard
        }

        // Redirect non-admin users to the home page or another route
        return redirect('/home')->with('error', 'You do not have access to the admin dashboard.');
    }
}
