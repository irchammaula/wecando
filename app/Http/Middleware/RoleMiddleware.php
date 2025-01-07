<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::user()->role_id == 1) {
            return redirect()->route('dashboard');  // Misalnya ke dashboard admin
        }

        if (Auth::user()->role_id == 2) {
            return redirect()->route('customer.dashboard');  // Misalnya ke dashboard customer
        }

        return redirect()->route('home')->with('error', 'Access denied.');
    }
}
