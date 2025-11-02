<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use App\Models\Job;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Build query
        $query = UserNotification::where('user_id', $user->id)
            ->with('notification')
            ->orderBy('created_at', 'desc');
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('notification', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
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
        
        // If AJAX request (for Load More), return JSON
        if ($request->ajax()) {
            return response()->json([
                'html' => view('recruiter.notifications-partial', compact('notifications'))->render(),
                'has_more' => $notifications->hasMorePages(),
                'next_page' => $notifications->currentPage() + 1
            ]);
        }
        
        // Attach related data and routes for each notification
        $notifications->getCollection()->transform(function($userNotification) use ($user) {
            $relatedRoute = null;
            
            // Application notification - link to job applications page
            if ($userNotification->notification && 
                (str_contains($userNotification->notification->title, 'candidature') || 
                 str_contains($userNotification->notification->message, 'candidature'))) {
                
                // Try to find application by candidate name from notification
                $candidateName = null;
                if (preg_match('/de (.+?)\./', $userNotification->notification->message, $matches)) {
                    $candidateName = trim($matches[1]);
                }
                
                // Extract job title from notification
                $jobTitle = null;
                if (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                }
                
                // Try to find the application and then the job
                if ($candidateName && $jobTitle) {
                    $application = Application::whereHas('job', function($q) use ($user, $jobTitle) {
                        $q->where('recruiter_id', $user->id)
                          ->where('title', $jobTitle);
                    })
                    ->whereHas('candidate', function($q) use ($candidateName) {
                        $q->where('name', 'like', "%{$candidateName}%");
                    })
                    ->first();
                    
                    if ($application && $application->job) {
                        $relatedRoute = route('recruiter.jobs.applications', $application->job);
                    }
                }
                
                // Fallback: try to find job by title only
                if (!$relatedRoute && $jobTitle) {
                    $job = Job::where('recruiter_id', $user->id)
                        ->where('title', $jobTitle)
                        ->first();
                    
                    if ($job) {
                        $relatedRoute = route('recruiter.jobs.applications', $job);
                    }
                }
                
                // Last fallback: link to all jobs if we can't find specific job
                if (!$relatedRoute) {
                    $relatedRoute = route('recruiter.jobs');
                }
            }
            
            // Interview-related notifications (confirmations, cancellations, change requests, problem reports)
            // Check for interview-related notification titles/messages
            if ($userNotification->notification && 
                (str_contains($userNotification->notification->title, 'Entretien') ||
                 str_contains($userNotification->notification->title, 'entretien') ||
                 str_contains($userNotification->notification->title, 'modification') ||
                 str_contains($userNotification->notification->title, 'annulé') ||
                 str_contains($userNotification->notification->title, 'confirmé') ||
                 str_contains($userNotification->notification->title, 'Problème') ||
                 str_contains($userNotification->notification->message, 'entretien'))) {
                
                // Extract candidate name and job title from notification
                $candidateName = null;
                $jobTitle = null;
                
                // Extract candidate name from notification message
                // Pattern: "{Name} a confirmé/annulé/demandé..."
                if (preg_match('/^([A-ZÉÈÊËÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ][a-zéèêëàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ]+(?:\s+[A-ZÉÈÊËÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ][a-zéèêëàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ]+)+)\s+a\s+(?:confirmé|annulé|demandé|signalé)/', $userNotification->notification->message, $matches)) {
                    $candidateName = trim($matches[1]);
                } elseif (preg_match('/^(.+?)\s+a\s+(?:confirmé|annulé|demandé|signalé)/', $userNotification->notification->message, $matches)) {
                    $candidateName = trim($matches[1]);
                }
                
                // Extract job title (usually in quotes: "Job Title")
                $jobTitle = null;
                if (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) {
                    $jobTitle = trim($matches[1]);
                }
                
                // Try to find the interview by candidate name and job title
                // First try exact match, then LIKE match
                if ($candidateName && $jobTitle) {
                    // Exact job title match
                    $interview = Interview::whereHas('candidate', function($q) use ($candidateName) {
                        $q->where('name', 'like', "%{$candidateName}%");
                    })
                    ->whereHas('job', function($q) use ($user, $jobTitle) {
                        $q->where('recruiter_id', $user->id)
                          ->where('title', $jobTitle);
                    })
                    ->whereNotIn('status', ['annule', 'termine'])
                    ->orderBy('interview_date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->first();
                    
                    // If not found, try LIKE match for job title
                    if (!$interview) {
                        $interview = Interview::whereHas('candidate', function($q) use ($candidateName) {
                            $q->where('name', 'like', "%{$candidateName}%");
                        })
                        ->whereHas('job', function($q) use ($user, $jobTitle) {
                            $q->where('recruiter_id', $user->id)
                              ->where('title', 'like', "%{$jobTitle}%");
                        })
                        ->whereNotIn('status', ['annule', 'termine'])
                        ->orderBy('interview_date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->first();
                    }
                    
                    if ($interview) {
                        $relatedRoute = route('recruiter.interviews.edit', $interview);
                    }
                }
                
                // Fallback: try to find by candidate name only (most recent active interview)
                if (!$relatedRoute && $candidateName) {
                    $interview = Interview::whereHas('candidate', function($q) use ($candidateName) {
                        $q->where('name', 'like', "%{$candidateName}%");
                    })
                    ->where('recruiter_id', $user->id)
                    ->whereNotIn('status', ['annule', 'termine'])
                    ->orderBy('interview_date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->first();
                    
                    if ($interview) {
                        $relatedRoute = route('recruiter.interviews.edit', $interview);
                    }
                }
                
                // If still no route found, link to interviews list
                if (!$relatedRoute) {
                    $relatedRoute = route('recruiter.interviews');
                }
            }
            
            // Interview notification - link to interviews page (for interview creation/update notifications)
            if (!$relatedRoute && $userNotification->notification && 
                in_array($userNotification->notification->type, ['interview', 'interview_update'])) {
                $relatedRoute = route('recruiter.interviews');
            }
            
            $userNotification->related_route = $relatedRoute;
            return $userNotification;
        });
            
        return view('recruiter.notifications', compact('notifications'));
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
