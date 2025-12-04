<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class cAuthController extends Controller
{
    public function showLoginForm()
    {
        // Sesuai struktur view lu
        return view('perusahaan.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (Auth::guard('company')->attempt($request->only('email','password'))) {
            return redirect()->route('perusahaan.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegisterForm()
    {
        return view('perusahaan.register'); // Sesuai view lu
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|max:255',
            'email'           => 'required|email|unique:companies',
            'password'        => 'required|min:8'
        ]);

        Company::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
        ]);

        return redirect()->route('perusahaan.login')
            ->with('success', 'Pendaftaran berhasil.');
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('perusahaan.login');
    }
}
