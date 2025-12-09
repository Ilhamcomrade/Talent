<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campus;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Menampilkan form login kampus
     */
    public function showLoginForm()
    {
        // PERUBAHAN: Tidak perlu hapus session errors, biarkan tampil
        return view('campus.campus_login');
    }

    /**
     * Proses login kampus
     */
    public function login(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // PERUBAHAN: Cek apakah email ada di database
        $campus = Campus::where('email', $request->email)->first();

        if (!$campus) {
            // PERUBAHAN: Email tidak ditemukan, return dengan errors
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email yang Anda masukkan salah.'
                ]);
        }

        // PERUBAHAN: Cek password
        if (!Hash::check($request->password, $campus->password)) {
            // PERUBAHAN: Password salah, return dengan errors
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'Password yang Anda masukkan salah.'
                ]);
        }

        // Cek status aktif kampus
        if (!$campus->is_active) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Akun kampus Anda tidak aktif. Silakan hubungi administrator.'
                ]);
        }

        // Coba melakukan login dengan credentials
        $credentials = $request->only('email', 'password');

        if (Auth::guard('campus')->attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard kampus
            return redirect()->intended(route('campus.dashboard'));
        }

        // Jika login gagal karena alasan lain
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ]);
    }

    /**
     * Logout kampus
     */
    public function logout(Request $request)
    {
        Auth::guard('campus')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // DIUBAH: Redirect ke halaman login kampus, bukan ke halaman utama
        return redirect()->route('campus.login')->with('info', 'Anda telah berhasil keluar dari akun kampus.');
    }
}
