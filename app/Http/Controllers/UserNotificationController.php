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
            'notifications' => $notifications->map(function ($userNotification) use ($user) {
                $interviewData = null;
                
                // Check if notification is about interview
                if ($userNotification->notification && 
                    in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                    
                    // Find most recent interview for this candidate around notification time
                    $notificationCreatedAt = $userNotification->created_at;
                    $interview = Interview::where('candidate_id', $user->id)
                        ->where('created_at', '<=', $notificationCreatedAt)
                        ->where('created_at', '>=', $notificationCreatedAt->copy()->subDays(7))
                        ->with(['job.company', 'candidate'])
                        ->orderBy('created_at', 'desc')
                        ->first();
                    
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
                // Check if notification is about accepted application
                elseif ($userNotification->notification && 
                        $userNotification->notification->type === 'success' && 
                        str_contains($userNotification->notification->message, 'acceptée')) {
                    
                    // Try to extract job title from message
                    preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches);
                    $jobTitle = $matches[1] ?? null;
                    
                    if ($jobTitle) {
                        // Find application and then interview for this candidate and job
                        $application = Application::where('candidate_id', $user->id)
                            ->whereHas('job', function($q) use ($jobTitle) {
                                $q->where('title', 'like', "%{$jobTitle}%");
                            })
                            ->where('status', 'accepted')
                            ->first();
                        
                        if ($application) {
                            // Find interview associated with this application
                            $interview = Interview::where('candidate_id', $user->id)
                                ->where(function($q) use ($application) {
                                    $q->where('application_id', $application->id)
                                      ->orWhere('job_id', $application->job_id);
                                })
                                ->with(['job.company', 'candidate'])
                                ->orderBy('created_at', 'desc')
                                ->first();
                            
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