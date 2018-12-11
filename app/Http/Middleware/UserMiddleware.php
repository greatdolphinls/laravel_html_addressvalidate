<?php

namespace App\Http\Middleware;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Closure;
use Auth;

class UserMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->role != 'user') {
            if ($request->ajax() || $request->wantsJson()) {
                return redirect('signin');
            } else {
                return redirect('signin');
            }
        }

        return $next($request);
    }
}
