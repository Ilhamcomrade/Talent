<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan kontak dengan opsi filter soft delete, pencarian, dan batas data per halaman (pagination).
     */
    public function index(Request $request)
    {
        // 1. Ambil nilai filter dari request
        $status = $request->query('status', 'without');
        $search = $request->query('search'); // Ambil nilai pencarian
        $limit = $request->query('limit', 10); // Ambil limit, default 10

        // 2. Tentukan Query Dasar
        // PERUBAHAN: Diurutkan DESC (terbaru di atas)
        $query = ContactMessage::orderBy('created_at', 'desc');

        // 3. Terapkan Pencarian (Jika ada nilai search)
        if ($search) {
            // Konversi string pencarian menjadi huruf kecil untuk perbandingan case-insensitive
            $lowerSearch = strtolower($search);
            // Tambahkan wildcard untuk LIKE
            $searchPattern = '%' . $lowerSearch . '%';

            $query->where(function ($q) use ($searchPattern) {
                // Untuk Kolom Teks (name, email): Gunakan LOWER() untuk pencarian case-insensitive
                // LOWER(kolom) LIKE ?
                $q->whereRaw('LOWER(name) LIKE ?', [$searchPattern])
                    ->orWhereRaw('LOWER(email) LIKE ?', [$searchPattern])
                    ->orWhereRaw('LOWER(phone) LIKE ?', [$searchPattern]);
            });
        }

        // 4. Terapkan Filter Status dan Pagination
        if ($status === 'only') {
            // Hanya data yang dihapus (onlyTrashed).
            $messages = $query->onlyTrashed()->paginate($limit)->withQueryString();

        } elseif ($status === 'with') {
            // Dengan data yang dihapus (withTrashed).
            $messages = $query->withTrashed()->paginate($limit)->withQueryString();

        } else {
            // Default: Tanpa data yang dihapus (hanya yang tidak soft deleted)
            $messages = $query->whereNull('deleted_at')->paginate($limit)->withQueryString();
        }

        // Catatan: Fungsi withQueryString() di Laravel akan otomatis
        // mempertahankan parameter search, limit, dan status pada link pagination.

        // Kirimkan variabel $messages ke view
        // $status sudah ada di $messages karena kita menggunakan withQueryString(),
        // tetapi untuk konsistensi blade, kita tetap kirim.
        return view('admin.contact.index', compact('messages', 'status'));
    }

    public function show($id)
    {
        // Gunakan withTrashed() agar bisa melihat pesan yang sudah di-soft delete
        $message = ContactMessage::withTrashed()->findOrFail($id);

        // set read_at dan status jika belum
        if (!$message->read_at) {
            $message->update([
                'read_at' => now(),
                'status' => 1, // SET STATUS MENJADI 1 (Sudah Dibaca)
            ]);
        }

        return view('admin.contact.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);

        // 1. SET active menjadi 0 (Tidak Aktif/Dihapus dari tampilan) - Sesuai logika Anda
        $message->update(['active' => 0]);

        // 2. Lakukan Soft Delete (mengisi kolom deleted_at)
        $message->delete();

        // PERBAIKAN: Mengubah route dari 'admin.contact.index' menjadi 'admin.contact-messages.index'
        return redirect()->route('admin.contact-messages.index')->with('success', 'Pesan berhasil disembunyikan.');
    }

    public function restore($id)
    {
        // Cari pesan yang di-soft delete (hanya yang terhapus)
        // Kita harus menggunakan withTrashed() untuk mencari ID
        $message = ContactMessage::withTrashed()->findOrFail($id);

        // 1. Pulihkan Soft Delete (mengosongkan kolom deleted_at)
        $message->restore();

        // 2. Kembalikan active menjadi 1 - Sesuai logika Anda
        $message->update(['active' => 1]);

        // PERBAIKAN: Mengubah route dari 'admin.contact.index' menjadi 'admin.contact-messages.index'
        return redirect()->route('admin.contact-messages.index', ['status' => 'only'])->with('success', 'Pesan berhasil dipulihkan dan ditampilkan kembali di Pesan Aktif.');
    }
}
