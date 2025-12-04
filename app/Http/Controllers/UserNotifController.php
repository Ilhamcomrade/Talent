<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class UserNotifController extends Controller
{
    /**
     * 🔔 Halaman notifikasi milik user login
     */
    public function myNotifications(Request $request)
    {

        $user = request()->user();
        $filter = $request->get('filter', 'all'); // all, unread, read

        $notifications = $user->notifications()
            ->when($filter === 'unread', function ($query) {
                return $query->whereNull('read_at');
            })
            ->when($filter === 'read', function ($query) {
                return $query->whereNotNull('read_at');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $unreadCount = $user->unreadNotifications()->count();
        $totalCount = $user->notifications()->count();

        return view('user.notif.my', compact('notifications', 'unreadCount', 'totalCount', 'filter'));
    }

    /**
     * 🔔 API untuk ambil notifikasi user (JSON)
     */
    public function getMyNotificationsApi(Request $request)
    {
        $user = request()->user();
        $limit = $request->get('limit', 10);
        $offset = $request->get('offset', 0);

        $notifications = $user->notifications()
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at->toIso8601String(), // ✅ aman untuk JS Date
                    'is_read' => !is_null($notification->read_at)
                ];
            });

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications()->count(),
            'total_count' => $user->notifications()->count(),
            'has_more' => $user->notifications()->count() > ($offset + $limit)
        ]);
    }

    /**
     * 🔍 Detail notifikasi + tandai sebagai dibaca
     */
    public function show($id)
    {
        $notification = request()->user()->notifications()->where('id', $id)->firstOrFail();

        // Tandai sebagai dibaca jika belum
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        // Redirect ke URL notifikasi jika ada, atau tampilkan detail
        if (!empty($notification->data['action_url'])) {
            return redirect($notification->data['action_url']);
        }

        return view('user.notif.show', [
            'notification' => $notification,
            'data' => $notification->data
        ]);
    }

    /**
     * ✅ Tandai satu notifikasi sebagai dibaca
     */
    public function markRead($id)
    {
        DB::transaction(function () use ($id) {
            $notification = request()->user()->notifications()->where('id', $id)->firstOrFail();

            if (is_null($notification->read_at)) {
                $notification->update(['read_at' => now()]);
            }
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi ditandai sebagai dibaca.',
                'unread_count' => request()->user()->unreadNotifications()->count()
            ]);
        }

        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * ✅ Tandai semua notifikasi sebagai dibaca
     */
    public function markAllRead()
    {
        $user = request()->user();
        $unreadCount = $user->unreadNotifications()->count();

        DB::transaction(function () use ($user) {
            $user->unreadNotifications->each(function ($notification) {
                $notification->update(['read_at' => now()]);
            });
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Semua {$unreadCount} notifikasi telah ditandai sebagai dibaca.",
                'unread_count' => 0
            ]);
        }

        return redirect()->back()->with('success', "Semua {$unreadCount} notifikasi telah ditandai sebagai dibaca.");
    }

    /**
     * ❌ Hapus satu notifikasi
     */
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $notification = request()->user()->notifications()->where('id', $id)->firstOrFail();
            $notification->delete();
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus.',
                'unread_count' => request()->user()->unreadNotifications()->count()
            ]);
        }

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * ❌ Hapus semua notifikasi
     */
    public function deleteAll()
    {
        $user = request()->user();
        $totalCount = $user->notifications()->count();

        DB::transaction(function () use ($user) {
            $user->notifications()->delete();
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Semua {$totalCount} notifikasi berhasil dihapus.",
                'unread_count' => 0
            ]);
        }

        return redirect()->back()->with('success', "Semua {$totalCount} notifikasi berhasil dihapus.");
    }

    /**
     * 🔄 Tandai notifikasi sebagai belum dibaca
     */
    public function markUnread($id)
    {
        DB::transaction(function () use ($id) {
            $notification = request()->user()->notifications()->where('id', $id)->firstOrFail();
            $notification->update(['read_at' => null]);
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi ditandai sebagai belum dibaca.',
                'unread_count' => request()->user()->unreadNotifications()->count()
            ]);
        }

        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai belum dibaca.');
    }

    /**
     * 📊 Statistik notifikasi user
     */
    public function getNotificationStats()
    {
        $user = request()->user();

        $stats = [
            'total' => $user->notifications()->count(),
            'unread' => $user->unreadNotifications()->count(),
            'read' => $user->notifications()->whereNotNull('read_at')->count(),
            'today' => $user->notifications()->whereDate('created_at', today())->count(),
            'this_week' => $user->notifications()->whereBetween('created_at', [
                now()->startOfWeek(), now()->endOfWeek()
            ])->count(),
        ];

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
        }

        return $stats;
    }

    /**
     * 🔍 Cari notifikasi
     */
    public function searchNotifications(Request $request)
    {
        $search = $request->get('q');

        $notifications = request()->user()
            ->notifications()
            ->where('data', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'notifications' => $notifications,
                'search_term' => $search
            ]);
        }

        return view('user.notif.my', compact('notifications'));
    }

    /**
     * 📨 Clear notifikasi yang sudah lama (otomatis)
     */
    public function clearOldNotifications()
    {
        $days = request()->get('days', 30); // Default 30 hari

        $deletedCount = request()->user()
            ->notifications()
            ->where('created_at', '<', now()->subDays($days))
            ->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$deletedCount} notifikasi lama berhasil dihapus.",
                'deleted_count' => $deletedCount
            ]);
        }

        return redirect()->back()->with('success', "{$deletedCount} notifikasi lama berhasil dihapus.");
    }
}
