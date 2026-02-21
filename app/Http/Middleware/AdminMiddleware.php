<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in AND has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Let them pass
        }

        // If they are not an admin, kick them back to the storefront
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}