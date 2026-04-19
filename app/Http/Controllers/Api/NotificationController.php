<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Interview;
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
            // Admin sees system-wide unread notifications; other users see their own unread notifications.
            $notificationsQuery = UserNotification::with(['notification', 'user'])
                ->where('is_read', false)
                ->orderBy('created_at', 'desc');

            if (!$user->isAdmin()) {
                $notificationsQuery->where('user_id', $user->id);
            }

            $notifications = $notificationsQuery
                ->limit(5)
                ->get();

            $unreadCountQuery = UserNotification::where('is_read', false);
            if (!$user->isAdmin()) {
                $unreadCountQuery->where('user_id', $user->id);
            }
            $unreadCount = $unreadCountQuery->count();

            return response()->json([
                'notifications' => NotificationResource::collection($notifications->map(function ($userNotification) {
                    $interviewData = null;

                    if ($userNotification->notification && in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                        $notificationTime = $userNotification->created_at;
                        $jobTitle = null;

                        if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) {
                            $jobTitle = trim($matches[1]);
                        } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                            $jobTitle = trim($matches[1]);
                        } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) {
                            $jobTitle = trim($matches[1]);
                        }

                        $interview = null;

                        if ($jobTitle) {
                            $interview = Interview::where('candidate_id', $userNotification->user_id)
                                ->whereHas('job', function ($query) use ($jobTitle) {
                                    $query->where('title', $jobTitle);
                                })
                                ->with(['job.company', 'candidate'])
                                ->whereBetween('created_at', [
                                    $notificationTime->copy()->subMinutes(5),
                                    $notificationTime->copy()->addMinutes(5)
                                ])
                                ->orderBy('created_at', 'desc')
                                ->first();

                            if (!$interview) {
                                $interview = Interview::where('candidate_id', $userNotification->user_id)
                                    ->whereHas('job', function ($query) use ($jobTitle) {
                                        $query->where('title', 'like', "%{$jobTitle}%");
                                    })
                                    ->with(['job.company', 'candidate'])
                                    ->whereBetween('created_at', [
                                        $notificationTime->copy()->subMinutes(5),
                                        $notificationTime->copy()->addMinutes(5)
                                    ])
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                        }

                        if (!$interview) {
                            $interview = Interview::where('candidate_id', $userNotification->user_id)
                                ->with(['job.company', 'candidate'])
                                ->whereBetween('created_at', [
                                    $notificationTime->copy()->subMinutes(2),
                                    $notificationTime->copy()->addMinutes(2)
                                ])
                                ->orderBy('created_at', 'desc')
                                ->first();
                        }

                        if ($interview) {
                            $interviewData = [
                                'date' => $interview->interview_date->format('d/m/Y'),
                                'time' => \Carbon\Carbon::parse($interview->start_time)->format('H:i'),
                                'duration' => $interview->duration_minutes,
                                'location' => $interview->location,
                                'type' => $interview->type,
                                'type_in_french' => $interview->type_in_french ?? $interview->type,
                                'company' => $interview->job->company->name ?? null,
                                'job_title' => $interview->job->title ?? null,
                                'meeting_link' => $interview->meeting_link,
                                'notes' => $interview->notes,
                            ];
                        }
                    }

                    $userNotification->interview = $interviewData;

                    return $userNotification;
                }))->resolve($request),
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

        return NotificationResource::collection($notifications)
            ->additional([
                'success' => true,
                'message' => 'Notifications retrieved successfully',
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

        return (new NotificationResource($userNotification->load('notification')))
            ->additional([
                'success' => true,
                'message' => 'Notification marked as read',
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
