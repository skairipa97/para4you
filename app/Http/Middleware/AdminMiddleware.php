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
        // Check if user is admin
        if (!session('is_admin')) {
            // User is not an admin, redirect to home with error message
            return redirect()->route('welcome')->with('error', 'Accès non autorisé. Vous devez être administrateur pour accéder à cette page.');
        }
        
        return $next($request);
    }
}
