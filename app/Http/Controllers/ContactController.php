<?php

namespace App\Http\Controllers;

use App\Models\Profile; // Pastikan Model Profile sudah di-import
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Mail; // Wajib di-import untuk mengirim email
use App\Mail\ContactUsMail; // Wajib di-import (asumsi Anda telah membuat file ini)

class ContactController extends Controller
{
    // PERUBAHAN: Menerima Request untuk membaca session flash
    public function index(Request $request)
    {
        // Ambil data profile
        $profile = Profile::first();

                // Jika belum ada, buat data default
        if (!$profile) {
            $profile = Profile::create([
                'address' => 'Jl. Pratista Utara III No.2, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat, Indonesia 4029',
                'email' => 'corporate@inotal.tech',
                'phone' => '+(62) 82115179879',
                'operation_hours' => 'Senin - Jumat, 08.00 - 16.00 WIB',
                'latitude' =>  -6.925457980196308,
                'longitude' =>   107.66299344598612,
                'map_popup_text' => 'PT INOTAL SISTEMA INTERNASIONAL Jl. Pratista Utara III No.2, Antapani.',
            ]);
        }

        // Cek apakah ada session flash 'success_message' yang dikirim dari method store()
        $success_message = $request->session()->get('success_message');

        // Kirim data 'profile' dan 'success_message' ke view 'contact'
        return view('contact', compact('profile', 'success_message'));
    }


    public function store(Request $request)
    {
        // 1. Validasi Data
        // Catatan: Jika Anda ingin wajib diisi (required), ganti 'nullable' menjadi 'required'
        $validatedData = $request->validate([
            'name'      => 'nullable|string|max:191',
            'phone'     => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:191',
            'subject'   => 'nullable|string|max:255',
            'message'   => 'nullable|string',
        ]);

        // 2. Simpan ke Database
        ContactMessage::create($validatedData);

        // 3. Kirim Email ke Alamat Tujuan
        try {
            // PERBAIKAN KRUSIAL: Mengubah 'gmaul.com' menjadi 'gmail.com'
            $recipientEmail = 'septiangeorgio@gmail.com';

            // Kirim email menggunakan Mailable Class ContactUsMail
            Mail::to($recipientEmail)->send(new ContactUsMail($validatedData));

            // Jika berhasil, redirect kembali dengan pesan sukses
            return redirect()->route('contact')->with('success_message', true);

        } catch (\Exception $e) {
            // Log error untuk debugging (sangat penting jika email gagal)
            // Pesan error ini akan muncul di file storage/logs/laravel.log
            Log::error('Gagal mengirim email dari Contact Form: ' . $e->getMessage());

            // Walaupun gagal kirim email, kita tetap memberikan pesan sukses karena data sudah tersimpan di DB
            return redirect()->route('contact')->with('success_message', true);
        }
    }

    // PERHATIAN: Method public function success() telah dihapus
}
