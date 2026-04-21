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
    public function index(Request $request)
    {
        $this->authorize('scanner-pass'); $this->authorize('viewAny', UserNotification::class); $user = Auth::user(); $query = UserNotification::where('user_id', $user->id) ->with('notification') ->orderBy('created_at', 'desc'); if ($request->filled('search')) { $search = $request->search; $query->whereHas('notification', function($q) use ($search) { $q->where('title', 'like', "%{$search}%") ->orWhere('message', 'like', "%{$search}%"); }); } if ($request->filled('filter')) { if ($request->filter === 'unread') { $query->where('is_read', false); } elseif ($request->filter === 'read') { $query->where('is_read', true); } } $notifications = $query->paginate(15); $notifications->getCollection()->transform(function($userNotification) use ($user) { $relatedRoute = null; if ($userNotification->notification && in_array($userNotification->notification->type, ['interview', 'interview_update'])) { $notificationTime = $userNotification->created_at; $notificationType = $userNotification->notification->type; $jobTitle = null; if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) { $jobTitle = trim($matches[1]); } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } $interview = null; if ($notificationType === 'interview_update') { if ($jobTitle) { $interview = Interview::where('candidate_id', $user->id) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', $jobTitle); }) ->with(['job.company', 'candidate']) ->orderBy('updated_at', 'desc') ->first(); if (!$interview) { $interview = Interview::where('candidate_id', $user->id) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', 'like', "%{$jobTitle}%"); }) ->with(['job.company', 'candidate']) ->orderBy('updated_at', 'desc') ->first(); } } if (!$interview) { $interview = Interview::where('candidate_id', $user->id) ->with(['job.company', 'candidate']) ->orderBy('updated_at', 'desc') ->first(); } } else { if ($jobTitle) { $interview = Interview::where('candidate_id', $user->id) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', $jobTitle); }) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(5), $notificationTime->copy()->addMinutes(5) ]) ->orderBy('created_at', 'desc') ->first(); if (!$interview) { $interview = Interview::where('candidate_id', $user->id) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', 'like', "%{$jobTitle}%"); }) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(5), $notificationTime->copy()->addMinutes(5) ]) ->orderBy('created_at', 'desc') ->first(); } } if (!$interview) { $interview = Interview::where('candidate_id', $user->id) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(2), $notificationTime->copy()->addMinutes(2) ]) ->orderBy('created_at', 'desc') ->first(); } } if ($interview) { $userNotification->interview = $interview; $relatedRoute = route('candidate.interviews.show', $interview); } else { $userNotification->interview = null; } } if ($userNotification->notification && ($userNotification->notification->type === 'success' || $userNotification->notification->type === 'warning') && (str_contains($userNotification->notification->message, 'acceptée') || str_contains($userNotification->notification->message, 'rejetée') || str_contains($userNotification->notification->message, 'présélectionnée'))) { $relatedRoute = route('candidate.applications'); } $userNotification->related_route = $relatedRoute; return $userNotification; }); if ($request->ajax()) { return api_json([ 'html' => view('candidate.notifications-partial', compact('notifications'))->render(), 'has_more' => $notifications->hasMorePages(), 'next_page' => $notifications->currentPage() + 1 ]); } return view('candidate.notifications', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        $userNotification = UserNotification::findOrFail($id);
        $this->authorize('update', $userNotification);
            
        if ($userNotification) {
            $userNotification->update([
                'is_read' => true,
                'read_at' => now()
            ]);
            
            if (request()->expectsJson()) {
                return api_json(['success' => true]);
            }
            return redirect()->back()->with('success', 'Notification marquée comme lue.');
        }
        
        if (request()->expectsJson()) {
            return api_json(['success' => false], 404);
        }
        return redirect()->back()->with('error', 'Notification non trouvée.');
    }
    
    public function markAllAsRead()
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', UserNotification::class);

        $user = Auth::user();
        UserNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
            
        if (request()->expectsJson()) {
            return api_json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
    
    public function destroy($id)
    {
        $this->authorize('scanner-pass');
        $user = Auth::user();
        $userNotification = UserNotification::findOrFail($id);
        $this->authorize('delete', $userNotification);
            
        if ($userNotification) {
            $userNotification->delete();
            
            if (request()->expectsJson()) {
                return api_json(['success' => true]);
            }
            return redirect()->back()->with('success', 'Notification supprimée.');
        }
        
        if (request()->expectsJson()) {
            return api_json(['success' => false], 404);
        }
        return redirect()->back()->with('error', 'Notification non trouvée.');
    }
    
    public function destroyAll()
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', UserNotification::class);

        $user = Auth::user();
        UserNotification::where('user_id', $user->id)->delete();
        
        if (request()->expectsJson()) {
            return api_json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont été supprimées.');
    }
}
