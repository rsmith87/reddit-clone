<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserSettingsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Cache::get('userSettings') === null) {
            Cache::put('userSettings', Auth::user()?->settings);
        }

        return $next($request);
    }
}
