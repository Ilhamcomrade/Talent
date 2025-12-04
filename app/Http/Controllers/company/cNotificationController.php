<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class cNotificationController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();

        // contoh dummy, bisa ganti nanti pakai tabel notifications
        $notifications = [
            ['pesan' => 'Pelamar baru masuk', 'waktu' => '2 jam lalu'],
            ['pesan' => 'Lowongan Designer akan segera berakhir', 'waktu' => '1 hari lalu'],
        ];

        return view('company.notifications.index', compact('notifications'));
    }
}
