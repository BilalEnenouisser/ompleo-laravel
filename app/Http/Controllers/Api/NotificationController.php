<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of user notifications
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // For header dropdown, return simple format
        if ($request->header('X-Requested-With') === 'XMLHttpRequest' || $request->get('header') === 'true') {
            // Get recent unread notifications for header dropdown
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
        
        // For regular API calls, return paginated format
        $query = UserNotification::with('notification')
            ->where('user_id', $user->id);

        // Filter by read status
        if ($request->filled('is_read')) {
            $query->where('is_read', $request->boolean('is_read'));
        }

        // Filter by notification type
        if ($request->filled('type')) {
            $query->whereHas('notification', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        $notifications = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'message' => 'Notifications retrieved successfully'
        ]);
    }

    /**
     * Get unread notification count
     */
    public function unreadCount()
    {
        $user = Auth::user();
        $count = UserNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$userNotification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }

        $userNotification->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'data' => $userNotification,
            'message' => 'Notification marked as read'
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        UserNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    /**
     * Remove the specified notification
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$userNotification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }

        $userNotification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully'
        ]);
    }
}
