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
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        // Build query
        $query = UserNotification::with(['notification', 'user'])
            ->orderBy('created_at', 'desc');
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('notification', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            })->orWhereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Apply read/unread filter
        if ($request->filled('filter')) {
            if ($request->filter === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->filter === 'read') {
                $query->where('is_read', true);
            }
        }
        
        // Paginate with 15 per page
        $notifications = $query->paginate(15);
        
        // For each notification, if it's about interview, find associated interview
        $notifications->getCollection()->transform(function($userNotification) {
            // Check if notification is about interview (interview or interview_update type)
            if ($userNotification->notification && 
                in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                
                // Extract job title from notification first (most reliable method)
                $jobTitle = null;
                if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) {
                    $jobTitle = trim($matches[1]);
                } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                }
                
                $candidateId = $userNotification->user_id;
                $notificationTime = $userNotification->created_at;
                
                // First priority: Match by exact job title + candidate + time window (most precise)
                if ($jobTitle) {
                    $interview = Interview::where('candidate_id', $candidateId)
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
                        $interview = Interview::where('candidate_id', $candidateId)
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
                    $interview = Interview::where('candidate_id', $candidateId)
                        ->with(['job.company', 'candidate'])
                        ->whereBetween('created_at', [
                            $notificationTime->copy()->subMinutes(1),
                            $notificationTime->copy()->addMinutes(1)
                        ])
                        ->orderBy('created_at', 'desc')
                        ->first();
                }
                
                if ($interview) {
                    $userNotification->interview = $interview;
                }
            }
            
            return $userNotification;
        });
        
        // If AJAX request (for Load More), return JSON
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.notifications-partial', compact('notifications'))->render(),
                'has_more' => $notifications->hasMorePages(),
                'next_page' => $notifications->currentPage() + 1
            ]);
        }
            
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
