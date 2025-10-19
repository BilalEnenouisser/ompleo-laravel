<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserNotification;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    /**
     * Display the notifications page for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user notifications with the notification details
        $userNotifications = UserNotification::with('notification')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notifications', compact('userNotifications'));
    }

    /**
     * Get notifications for the header dropdown
     */
    public function getNotifications()
    {
        $user = Auth::user();
        
        // Get recent unread notifications
        $notifications = UserNotification::with('notification')
            ->where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get total unread count
        $unreadCount = UserNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'notifications' => $notifications->map(function ($userNotification) {
                return [
                    'id' => $userNotification->id,
                    'title' => $userNotification->notification->title,
                    'message' => $userNotification->notification->message,
                    'type' => $userNotification->notification->type,
                    'created_at' => $userNotification->created_at,
                    'is_read' => $userNotification->is_read,
                ];
            }),
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($userNotification) {
            $userNotification->update([
                'is_read' => true,
                'read_at' => now()
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        UserNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($userNotification) {
            $userNotification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        UserNotification::where('user_id', Auth::id())->delete();
        return response()->json(['success' => true]);
    }
}