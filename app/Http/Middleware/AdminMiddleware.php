<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;
use Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->role != 'admin') {
            if ($request->ajax() || $request->wantsJson()) {
                return redirect('signin');
            } else {
                return redirect('signin');
            }
        }

        return $next($request);
    }
}