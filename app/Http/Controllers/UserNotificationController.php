<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserNotification;
use App\Models\Notification;
use App\Models\Interview;
use App\Models\Application;
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

        // Admin sees system-wide unread notifications in header; others see only their own unread notifications.
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
            'notifications' => $notifications->map(function ($userNotification) use ($user) {
                $interviewData = null;
                $targetCandidateId = $user->isAdmin() ? $userNotification->user_id : $user->id;
                
                // Check if notification is about interview
                if ($userNotification->notification && 
                    in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                    
                    $notificationTime = $userNotification->created_at;
                    $notificationType = $userNotification->notification->type;
                    
                    // Extract job title from notification first (most reliable method)
                    $jobTitle = null;
                    if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) {
                        $jobTitle = trim($matches[1]);
                    } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                        $jobTitle = trim($matches[1]);
                    } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) {
                        $jobTitle = trim($matches[1]);
                    }
                    
                    $interview = null;
                    
                    // For interview_update notifications, match by job title + candidate (no time constraint)
                    // For new interview notifications, use time-based matching
                    if ($notificationType === 'interview_update') {
                        // Update notifications: match by candidate + job title (most recent for that job)
                        if ($jobTitle) {
                            $interview = Interview::where('candidate_id', $targetCandidateId)
                                ->whereHas('job', function($q) use ($jobTitle) {
                                    $q->where('title', $jobTitle);
                                })
                                ->with(['job.company', 'candidate'])
                                ->orderBy('updated_at', 'desc') // Use updated_at for updates
                                ->first();
                            
                            // If exact match not found, try LIKE match
                            if (!$interview) {
                                $interview = Interview::where('candidate_id', $targetCandidateId)
                                    ->whereHas('job', function($q) use ($jobTitle) {
                                        $q->where('title', 'like', "%{$jobTitle}%");
                                    })
                                    ->with(['job.company', 'candidate'])
                                    ->orderBy('updated_at', 'desc')
                                    ->first();
                            }
                        }
                        
                        // Fallback: Get most recent interview for this candidate (if no job title)
                        if (!$interview) {
                            $interview = Interview::where('candidate_id', $targetCandidateId)
                                ->with(['job.company', 'candidate'])
                                ->orderBy('updated_at', 'desc')
                                ->first();
                        }
                    } else {
                        // New interview notifications: match by exact job title + candidate + time window
                        if ($jobTitle) {
                            $interview = Interview::where('candidate_id', $targetCandidateId)
                                ->whereHas('job', function($q) use ($jobTitle) {
                                    // Use exact match first, fallback to LIKE if exact doesn't work
                                    $q->where('title', $jobTitle);
                                })
                                ->with(['job.company', 'candidate'])
                                ->whereBetween('created_at', [
                                    $notificationTime->copy()->subMinutes(5),
                                    $notificationTime->copy()->addMinutes(5)
                                ])
                                ->orderBy('created_at', 'desc')
                                ->first();
                            
                            // If exact match not found, try LIKE match
                            if (!$interview) {
                                $interview = Interview::where('candidate_id', $targetCandidateId)
                                    ->whereHas('job', function($q) use ($jobTitle) {
                                        $q->where('title', 'like', "%{$jobTitle}%");
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
                        
                        // Fallback: If no job title found or no match, try time-based matching (less reliable)
                        if (!$interview) {
                            $interview = Interview::where('candidate_id', $targetCandidateId)
                                ->with(['job.company', 'candidate'])
                                ->whereBetween('created_at', [
                                    $notificationTime->copy()->subMinutes(2),
                                    $notificationTime->copy()->addMinutes(2)
                                ])
                                ->orderBy('created_at', 'desc')
                                ->first();
                        }
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
                
                return [
                    'id' => $userNotification->id,
                    'title' => $userNotification->notification->title,
                    'message' => $userNotification->notification->message,
                    'type' => $userNotification->notification->type,
                    'rich_content' => $userNotification->notification->rich_content,
                    'background_color' => $userNotification->notification->background_color,
                    'created_at' => $userNotification->created_at,
                    'timestamp' => $userNotification->created_at,
                    'isRead' => $userNotification->is_read,
                    'interview' => $interviewData,
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

            if (request()->expectsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Notification marquée comme lue.');
        }

        if (request()->expectsJson()) {
            return response()->json(['success' => false], 404);
        }

        return redirect()->back()->with('error', 'Notification non trouvée.');
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

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
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
            
            if (request()->expectsJson()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Notification supprimée.');
        }

        if (request()->expectsJson()) {
            return response()->json(['success' => false], 404);
        }

        return redirect()->back()->with('error', 'Notification non trouvée.');
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        UserNotification::where('user_id', Auth::id())->delete();
        
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Toutes les notifications ont été supprimées.');
    }
}