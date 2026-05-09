<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(20);

        // Mark all as read
        auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('student.notifications.index', compact('notifications'));
    }

    /*
    |--------------------------------------------------------------------------
    | UNREAD COUNT (JSON)
    |--------------------------------------------------------------------------
    */

    public function unreadCount()
    {
        $count = auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /*
    |--------------------------------------------------------------------------
    | MARK SINGLE AS READ
    |--------------------------------------------------------------------------
    */

    public function markRead(\App\Models\Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | MARK ALL AS READ
    |--------------------------------------------------------------------------
    */

    public function markAllRead()
    {
        auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
