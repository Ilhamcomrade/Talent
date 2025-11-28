<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCampus
{
    public function handle(Request $request, Closure $next)
    {
        // Log untuk membantu debugging
        Log::info('Campus Auth Check', [
            'authenticated' => Auth::guard('campus')->check(),
            'user' => Auth::guard('campus')->user()
        ]);

        // Jika belum login pakai guard campus
        if (!Auth::guard('campus')->check()) {
            return redirect()->route('campus.login');
        }

        return $next($request);
    }
}
