<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            // Redirect to a specific route or return a response
            // For example, redirect to a 'verification required' page

            flash()->addWarning('Your account may not have been activated. Please contact Support');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
