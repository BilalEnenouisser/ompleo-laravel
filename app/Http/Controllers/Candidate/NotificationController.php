<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use App\Models\Interview;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get notifications for this candidate only
        $notifications = UserNotification::where('user_id', $user->id)
            ->with('notification')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // For each notification, if it's about interview, try to find associated interview
        // Also attach related routes for clickable notifications
        $notifications->getCollection()->transform(function($userNotification) use ($user) {
            $relatedRoute = null;
            // Check if notification is about interview (interview or interview_update type)
            if ($userNotification->notification && 
                in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                
                $notificationTime = $userNotification->created_at;
                
                // Extract job title from notification first (most reliable method)
                $jobTitle = null;
                if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) {
                    $jobTitle = trim($matches[1]);
                } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                }
                
                // First priority: Match by exact job title + candidate + time window (most precise)
                if ($jobTitle) {
                    $interview = Interview::where('candidate_id', $user->id)
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
                        $interview = Interview::where('candidate_id', $user->id)
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
                    $interview = Interview::where('candidate_id', $user->id)
                        ->with(['job.company', 'candidate'])
                        ->whereBetween('created_at', [
                            $notificationTime->copy()->subMinutes(1),
                            $notificationTime->copy()->addMinutes(1)
                        ])
                        ->orderBy('created_at', 'desc')
                        ->first();
                }
                
                // Only attach interview if it exists (don't attach if interview was deleted)
                if ($interview) {
                    $userNotification->interview = $interview;
                    // Link to interview detail page
                    $relatedRoute = route('candidate.interviews.show', $interview);
                } else {
                    // Mark that interview doesn't exist (deleted)
                    $userNotification->interview = null;
                }
            }
            
            // Application status notifications - link to applications page
            if ($userNotification->notification && 
                ($userNotification->notification->type === 'success' || 
                 $userNotification->notification->type === 'warning') &&
                (str_contains($userNotification->notification->message, 'acceptée') ||
                 str_contains($userNotification->notification->message, 'rejetée') ||
                 str_contains($userNotification->notification->message, 'présélectionnée'))) {
                $relatedRoute = route('candidate.applications');
            }
            
            $userNotification->related_route = $relatedRoute;
            return $userNotification;
        });
            
        return view('candidate.notifications', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $user = Auth::user();
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', $user->id)
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
    
    public function markAllAsRead()
    {
        $user = Auth::user();
        UserNotification::where('user_id', $user->id)
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
    
    public function destroy($id)
    {
        $user = Auth::user();
        $userNotification = UserNotification::where('id', $id)
            ->where('user_id', $user->id)
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
    
    public function destroyAll()
    {
        $user = Auth::user();
        UserNotification::where('user_id', $user->id)->delete();
        
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont été supprimées.');
    }
}
