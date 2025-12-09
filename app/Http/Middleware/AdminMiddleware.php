<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['super admin', 'admin', 'pimpinan', 'testdev'])) {
            return $next($request);
        }

        return redirect('/masuk')->with('error', 'Akses ditolak, hanya admin!');
    }
}
