<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     * Mengambil data user dari database dan mengirimkannya ke view.
     */
    public function show()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim data ke view 'profile.show' (pastikan view ini ada)
        return view('profile.show', compact('user'));
    }

    /**
     * Menampilkan form edit profil untuk pengguna yang sedang login.
     * Mengambil data user dan mengirimkannya ke view edit.
     */
    public function edit()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim data ke view 'profile.edit' (pastikan view ini ada)
        return view('profile.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan profil pengguna.
     * Validasi input, update data, dan redirect kembali dengan pesan sukses.
     */
    public function update(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input berdasarkan atribut yang ada di model
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Password opsional, hanya jika diubah
            'role' => 'nullable|string', // Asumsikan role bisa diubah, tapi sesuaikan jika perlu
            'is_active' => 'boolean',
            'lokasi' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk upload gambar
            'gender' => 'nullable|string|in:laki-laki,perempuan',
            'upload_cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Validasi untuk file CV
            'upload_ijazah' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Validasi untuk file ijazah
            'link_github' => 'nullable|url',
            'link_portofolio' => 'nullable|url',
            'skills' => 'nullable|string',
            'tentang_anda' => 'nullable|string',
            'asal_sekolah' => 'nullable|string|max:255',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role ?? $user->role; // Jika tidak diisi, tetap gunakan yang lama
        $user->is_active = $request->has('is_active') ? true : false;
        $user->lokasi = $request->lokasi;
        $user->whatsapp = $request->whatsapp;
        $user->gender = $request->gender;
        $user->link_github = $request->link_github;
        $user->link_portofolio = $request->link_portofolio;
        $user->skills = $request->skills;
        $user->tentang_anda = $request->tentang_anda;
        $user->asal_sekolah = $request->asal_sekolah;

        // Jika password diisi, hash dan update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle upload avatar (jika ada file baru)
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = basename($avatarPath); // Simpan nama file saja
        }

        // Handle upload CV (jika ada file baru)
        if ($request->hasFile('upload_cv')) {
            // Hapus CV lama jika ada
            if ($user->upload_cv && Storage::exists('public/cvs/' . $user->upload_cv)) {
                Storage::delete('public/cvs/' . $user->upload_cv);
            }
            // Simpan CV baru
            $cvPath = $request->file('upload_cv')->store('public/cvs');
            $user->upload_cv = basename($cvPath);
        }

        // Handle upload ijazah (jika ada file baru)
        if ($request->hasFile('upload_ijazah')) {
            // Hapus ijazah lama jika ada
            if ($user->upload_ijazah && Storage::exists('public/ijazahs/' . $user->upload_ijazah)) {
                Storage::delete('public/ijazahs/' . $user->upload_ijazah);
            }
            // Simpan ijazah baru
            $ijazahPath = $request->file('upload_ijazah')->store('public/ijazahs');
            $user->upload_ijazah = basename($ijazahPath);
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}
