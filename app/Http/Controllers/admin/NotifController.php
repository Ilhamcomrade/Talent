<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\AdminBroadcastNotification;

class NotifController extends Controller
{
    /**
     * Tampilkan halaman form kirim notifikasi.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.notif.index', compact('users'));
    }

    /**
     * Proses kirim notifikasi ke user tertentu.
     */
    public function send(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);

        Notification::send($user, new AdminBroadcastNotification(
            $request->title,
            $request->message
        ));

        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim ke ' . $user->name . '!');
    }

    /**
     * 🔔 Halaman notifikasi milik user yang sedang login
     */
    public function myNotifications()
    {
        $user = request()->user();
        $notifications = $user->notifications()->latest()->get();

        return view('admin.notif.my', compact('notifications'));
    }

    /**
     * 🔔 API untuk mengambil notifikasi user (JSON response)
     */
    public function getMyNotificationsApi()
    {
        try {
            $user = request()->user();
            $notifications = $user->notifications()
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'data' => $notification->data,
                        'read_at' => $notification->read_at,
                        'created_at' => $notification->created_at->toISOString(),
                    ];
                });

            $unreadCount = $user->unreadNotifications()->count();

            return response()->json([
                'success' => true,
                'notifications' => $notifications,
                'unread_count' => $unreadCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat notifikasi'
            ], 500);
        }
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca.
     */
    public function markAsRead($id)
    {
        $notification = request()->user()->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * 🔔 API untuk menandai notifikasi sebagai sudah dibaca (JSON response)
     */
    public function markAsReadApi($id)
    {
        try {
            $notification = request()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi ditandai sebagai dibaca.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai notifikasi'
            ], 500);
        }
    }

    /**
     * (Opsional) Untuk testing admin, tampilkan notifikasi user lain.
     */
    public function userNotifications($id)
    {
        $user = User::findOrFail($id);
        $notifications = $user->notifications()->latest()->get();

        return view('admin.notif.user', compact('user', 'notifications'));
    }
}
