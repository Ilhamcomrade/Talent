<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutForPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logout user jika sudah login
        if (Auth::check()) {
            Auth::logout();

            // Invalidate session untuk menghapus semua data session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Simpan flash message (opsional)
            session()->flash('info', 'Anda telah keluar untuk mengakses halaman reset password. Silakan login kembali setelah reset password.');
        }

        // Pastikan tidak ada remember token yang masih aktif
        $request->cookies->remove('remember_web_' . config('auth.defaults.guard'));

        // Hapus cookie remember me jika ada
        $cookie = \Illuminate\Support\Facades\Cookie::forget('remember_web_' . config('auth.defaults.guard'));

        $response = $next($request);

        // Attach cookie forget ke response
        return $response->withCookie($cookie);
    }
}
