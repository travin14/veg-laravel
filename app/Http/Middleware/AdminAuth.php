<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * Allow access only if 'is_admin_logged_in' is set in the session.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('is_admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Access denied. Please login as admin.');
        }

        return $next($request);
    }
}
