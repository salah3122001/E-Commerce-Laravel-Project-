<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((Auth::check() && Auth::user()->role === 'user') || !(Auth::check())) {
            if (!Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')->with('error', 'Please verify your email first.');
            }
            return $next($request);
        } else {
            return $next($request);
            // abort(403,'Unauthorized action.');
            // return redirect()->route('mainPage')->with('status', 'You are logged in as user');

        }
    }
}
