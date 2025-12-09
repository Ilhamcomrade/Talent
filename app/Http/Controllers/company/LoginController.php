<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Company;

class LoginController extends Controller
{
    /**
     * Tampilkan form login perusahaan
     */
    public function showLoginForm()
    {
        return view('company.company_login');
    }

    /**
     * Proses login perusahaan dengan validasi spesifik
     */
    public function login(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek apakah email perusahaan ada di database
        $company = Company::where('email', $credentials['email'])->first();

        if (!$company) {
            // Email tidak ditemukan - HANYA error untuk email
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email tidak terdaftar. Silakan cek kembali.'
                ]);
        }

        // Cek apakah akun perusahaan aktif
        if (!$company->is_active) {
            // Akun tidak aktif - HANYA error untuk email
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Akun perusahaan tidak aktif. Silakan hubungi administrator.'
                ]);
        }

        // Cek apakah password salah
        if (!password_verify($credentials['password'], $company->password)) {
            // Password salah - HANYA error untuk password
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'Password salah. Silakan coba lagi.'
                ]);
        }

        // Coba login dengan guard company
        if (Auth::guard('company')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('company.dashboard')
                ->with('success', 'Login berhasil! Selamat datang ' . $company->company_name);
        }

        // Jika masih gagal (fallback) - HANYA error untuk email
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ]);
    }

    /**
     * Logout perusahaan - TANPA PESAN APAPUN
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login perusahaan TANPA pesan apapun
        return redirect()->route('company.login');
    }
}
