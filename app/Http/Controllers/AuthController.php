<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registerProcess(Request $request)
    {
        // 1. Validasi Data Input dari form daftar.blade.php
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'lokasi' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:15',
        ]);

        // 2. Gabungkan nama depan dan belakang menjadi satu kolom 'name'
        $fullName = $request->nama_depan . ' ' . $request->nama_belakang;

        // 3. Simpan User Baru ke database dengan role 'user'
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lokasi' => $request->lokasi,
            'whatsapp' => $request->whatsapp,
            'role' => 'user',
            'is_active' => true,
        ]);

        // 4. Otomatis Login setelah daftar
        Auth::login($user);

        // 5. Redirect ke halaman utama ('/')
        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ada dan password benar
        if ($user && (!is_null($user->password) && Hash::check($credentials['password'], $user->password))) {
            // Simpan session login
            Auth::login($user);

            // --- PERBAIKAN: Cek role dan arahkan ke rute yang sesuai ---
            switch ($user->role) {
                case 'super admin':
                case 'admin':
                case 'pimpinan':
                case 'testdev':
                    // Role yang punya akses ke panel ADMIN
                    return redirect()->route('admin.dashboard');
                    break;

                case 'wawancara':
                    // Role WAWANCARA diarahkan ke rute 'Lihat Jadwal' khusus
                    return redirect()->route('wawancara.jadwal.index');
                    break;

                default:
                    // pengguna biasa (role 'user') atau role lainnya
                    return redirect('/');
            }
        }

        // TAMBAHAN: Jika user ada tetapi tidak punya password (Google User) dan mencoba login manual
        if ($user && is_null($user->password)) {
            return back()->with('error', 'Akun ini terdaftar melalui Google. Silakan gunakan tombol "Masuk dengan Google".');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        // Clear session untuk keamanan
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/masuk');
    }

    public function redirectToGoogle()
    {
        // PERUBAHAN: Tambahkan type hint untuk menghilangkan error Intelephense
        /** @var \Laravel\Socialite\Two\GoogleProvider $socialite */
        $socialite = Socialite::driver('google');

        return $socialite
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Contracts\User $googleUser */
            $googleUser = Socialite::driver('google')->user();

            // Log user data yang diterima dari Google
            Log::info('Google User Data Received: ' . $googleUser->getEmail());

            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // 1. User ditemukan, langsung login
                Auth::login($user);
                Log::info('User existing Google ID logged in: ' . $user->email);
            } else {
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // 2. Email sudah ada (daftar manual), tautkan akun
                    $existingUser->google_id = $googleUser->getId();
                    $existingUser->avatar = $googleUser->getAvatar();
                    $existingUser->save();
                    Auth::login($existingUser);
                    Log::info('Existing user linked to Google ID: ' . $existingUser->email);
                } else {
                    // 3. User BARU: Buat akun baru
                    $newUser = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => null,
                        'role' => 'user',
                        'is_active' => true,
                        'lokasi' => null,
                        'whatsapp' => null,
                    ]);

                    Auth::login($newUser);
                    Log::info('New Google user created and logged in: ' . $newUser->email);
                }
            }

            // 4. Redirect ke halaman utama ('/') sesuai permintaan
            return redirect('/')->with('success', 'Selamat datang, Anda berhasil masuk dengan Google!');
        } catch (\Exception $e) {
            // Log Error detail untuk debugging
            Log::error('Google Login GAGAL: ' . $e->getMessage() . ' pada line ' . $e->getLine() . ' di file ' . $e->getFile());
            return redirect('/masuk')->with('error', 'Gagal login dengan Google. Silakan coba lagi. Cek log server untuk detail.');
        }
    }
}
