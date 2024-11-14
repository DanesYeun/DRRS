<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPasswordUpdate
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role != 1 && is_null(Auth::user()->password_updated_at)) {
            return redirect()->route('update.password');
        }
        
        return $next($request);
    }
}
