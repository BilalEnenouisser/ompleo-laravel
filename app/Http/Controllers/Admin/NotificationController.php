<?php

namespace App\Http\Controllers\Admin;

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
        // Get all notifications from all users for admin
        $notifications = UserNotification::with(['notification', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // For each notification, if it's about interview or accepted application, find associated interview
        $notifications->getCollection()->transform(function($userNotification) {
            // Check if notification is about interview
            if ($userNotification->notification && 
                in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                
                // Try to find interview by extracting info from notification message
                // For interview notifications, we can search by candidate and recent interviews
                $candidateId = $userNotification->user_id;
                
                // Find most recent interview for this candidate around notification time
                $notificationCreatedAt = $userNotification->created_at;
                $interview = Interview::where('candidate_id', $candidateId)
                    ->where('created_at', '<=', $notificationCreatedAt)
                    ->where('created_at', '>=', $notificationCreatedAt->copy()->subDays(7))
                    ->with(['job.company', 'candidate'])
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                $userNotification->interview = $interview;
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
                    $application = Application::where('candidate_id', $userNotification->user_id)
                        ->whereHas('job', function($q) use ($jobTitle) {
                            $q->where('title', 'like', "%{$jobTitle}%");
                        })
                        ->where('status', 'accepted')
                        ->first();
                    
                    if ($application) {
                        // Find interview associated with this application
                        $interview = Interview::where('candidate_id', $userNotification->user_id)
                            ->where(function($q) use ($application) {
                                $q->where('application_id', $application->id)
                                  ->orWhere('job_id', $application->job_id);
                            })
                            ->with(['job.company', 'candidate'])
                            ->orderBy('created_at', 'desc')
                            ->first();
                        
                        $userNotification->interview = $interview;
                    }
                }
            }
            
            return $userNotification;
        });
            
        return view('admin.notifications', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $userNotification = UserNotification::find($id);
            
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
        UserNotification::where('is_read', false)
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
        $userNotification = UserNotification::find($id);
            
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
        UserNotification::truncate();
        
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont été supprimées.');
    }
}
