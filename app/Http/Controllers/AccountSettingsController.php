<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AccountSettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan akun (Detail Login).
     */
    public function index()
    {
        // Pastikan pengguna sudah login sebelum mengakses halaman ini
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('login_detail');
    }

    /**
     * Menampilkan halaman Kontak Saya.
     */
    public function contactIndex()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Data pengguna akan diakses langsung di view melalui Auth::user()
        return view('contact_detail');
    }

    /**
     * Menangani proses pembaruan detail kontak (nama, bio, dll.) pada halaman Kontak Saya.
     * (Asumsi fungsi ini ada dari versi sebelumnya, jika tidak ada, ini adalah tambahan yang logis)
     */
    public function updateContactDetails(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500', // Asumsi ada kolom 'bio'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'bio.max' => 'Bio tidak boleh lebih dari 500 karakter.',
        ]);

        // 2. Update detail kontak
        $user->name = $request->name;
        // Hanya update bio jika kolom 'bio' ada pada model User
        if (property_exists($user, 'bio')) {
             $user->bio = $request->bio ?? null;
        }
        $user->save();

        return back()->with('success_contact', 'Detail kontak berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman Akun Terhubung.
     */
    public function linkedAccountsIndex(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah ada session yang menandakan akun sudah diputuskan (hanya simulasi)
        $isDisconnected = $request->session()->pull('disconnected_status', false);

        // Data akun terhubung (Google ID) akan diakses di view
        return view('linked_accounts', compact('isDisconnected'));
    }

    /**
     * Menampilkan halaman Preferensi Notifikasi.
     */
    public function notificationIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('notification_preferences'); // Ganti 'notification_preferences' dengan nama file view Anda
    }

    /**
     * Menangani proses pembaruan preferensi notifikasi.
     * (Asumsi fungsi ini ada dari versi sebelumnya, jika tidak ada, ini adalah tambahan yang logis)
     */
    public function updateNotificationPreferences(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi input
        $request->validate([
            'notify_email' => 'nullable|boolean', // Asumsi kolom ini ada
            'notify_whatsapp' => 'nullable|boolean', // Asumsi kolom ini ada
        ]);

        // 2. Update preferensi
        $user->notify_email = $request->has('notify_email');
        $user->notify_whatsapp = $request->has('notify_whatsapp');

        $user->save();

        return back()->with('success_notification', 'Preferensi notifikasi berhasil diperbarui.');
    }

    // ⭐ FUNGSI BARU: Menampilkan halaman Bantuan & Dukungan
    /**
     * Menampilkan halaman Bantuan & Dukungan.
     */
    public function helpSupportIndex()
    {
        // Pengguna harus login untuk mengakses halaman dukungan
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Anda dapat menambahkan data dinamis di sini jika diperlukan (misalnya FAQ)
        return view('help_support');
    }

    /**
     * Menangani proses penggantian kata sandi.
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'new_password' => 'required|string|min:8|max:255',
            'confirm_password' => 'required|string|same:new_password',
        ], [
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi minimal 8 karakter.',
            'confirm_password.required' => 'Konfirmasi kata sandi wajib diisi.',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah akun adalah akun Google (tidak punya password)
        if (is_null($user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('success_password', 'Kata sandi berhasil dibuat untuk akun Google Anda.');
        }

        // 2. Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success_password', 'Kata sandi berhasil diperbarui.');
    }

    /**
     * Menangani proses pembaruan alamat email.
     */
    public function updateEmail(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'new_email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ], [
            'new_email.required' => 'Email baru wajib diisi.',
            'new_email.email' => 'Format email tidak valid.',
            'new_email.unique' => 'Email ini sudah digunakan oleh akun lain.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Update email
        $user->email = $request->new_email;
        $user->email_verified_at = null; // Set null karena email baru belum diverifikasi
        $user->save();

        return back()->with('success_email', 'Email berhasil diperbarui. Anda mungkin perlu memverifikasi email baru Anda.');
    }

    /**
     * Menangani proses pembaruan nomor WhatsApp.
     */
    public function updateWhatsapp(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'whatsapp' => [
                'required',
                'max:15',
                'regex:/^(\+628|08|8)[0-9]{8,13}$/',
            ],
        ], [
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 karakter.',
            'whatsapp.regex' => 'Format Nomor WhatsApp tidak valid. Masukkan format yang benar (cth: 0812xxxxxxxx, 812xxxxxxxx, atau +62812xxxxxxxx).',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $whatsapp_input = $request->whatsapp;

        // 2. Bersihkan dan Standarisasi Nomor sebelum disimpan ke database
        $cleaned_whatsapp = $whatsapp_input;

        if (substr($whatsapp_input, 0, 2) === '08') {
            $cleaned_whatsapp = substr($whatsapp_input, 1);
        }
        elseif (substr($whatsapp_input, 0, 4) === '+628') {
            $cleaned_whatsapp = substr($whatsapp_input, 3);
        }
        // Jika sudah dimulai dengan 8, biarkan saja.

        // Simpan nomor yang sudah distandarisasi (tanpa +62 atau 0)
        $user->whatsapp = $cleaned_whatsapp;
        $user->save();

        return back()->with('success_whatsapp', 'Nomor WhatsApp berhasil diperbarui.');
    }

    /**
     * Menangani SIMULASI pemutusan koneksi akun.
     */
    public function dummyDisconnect(Request $request)
    {
        // Set session flash untuk menampilkan empty state di view
        $request->session()->flash('disconnected_status', true);

        // Redirect ke halaman Akun Terhubung
        return redirect()->route('account.linked');
    }

    public function deleteAccount(Request $request)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 1. Validasi Input Kunci ("DELETE")
        $request->validate([
            'confirmation_word' => 'required|in:DELETE',
            'delete_reason' => 'required|string', // Alasan utama dari Langkah 2
            // DIUBAH: Penjelasan detail dari Langkah 3 diubah dari min:10 menjadi min:1
            'reason_explanation' => 'required|string|min:1',
        ], [
            'confirmation_word.required' => 'Kata konfirmasi wajib diisi.',
            'confirmation_word.in' => 'Kata konfirmasi harus "DELETE".',
            'delete_reason.required' => 'Alasan penghapusan wajib dipilih.',
            'reason_explanation.required' => 'Penjelasan alasan wajib diisi.',
            'reason_explanation.min' => 'Penjelasan alasan minimal 1 karakter.', // DIUBAH: Pesan error disesuaikan
        ]);

        $user = Auth::user();

        // 2. LOGIKA KRUSIAL: Pencatatan Alasan
        // Anda harus menyimpan alasan ini (misalnya ke tabel 'account_deletion_logs') sebelum menghapus.
        // Di sini saya hanya melakukan simulasi penyimpanan log.

        // Simulasikan penyimpanan log penghapusan
        // LogDeletion::create([
        //     'user_id' => $user->id,
        //     'primary_reason' => $request->delete_reason,
        //     'detail_explanation' => $request->reason_explanation,
        // ]);

        // 3. LOGIKA KRUSIAL: Menghapus Akun Permanen
        $userId = $user->id;

        // Logout pengguna sebelum menghapus
        Auth::logout();

        // Hapus akun dari database
        // Gunakan $user->delete() jika Anda menggunakan Soft Deletes
        // Atau: User::find($userId)->forceDelete(); atau $user->forceDelete(); untuk penghapusan permanen
        // Asumsi menggunakan penghapusan permanen (sesuai permintaan "benar-benar terhapus otomatis")
        User::destroy($userId);

        // 4. Redirect ke halaman login dengan status sukses
        // Gunakan session flash untuk menampilkan pop-up sukses di halaman login
        return redirect()->route('login')->with('account_deleted', 'Akun dihapus');
    }
}

