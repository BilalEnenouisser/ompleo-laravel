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
        $this->authorize('scanner-pass'); $this->authorize('viewAny', UserNotification::class); $user = Auth::user(); $query = UserNotification::where('user_id', $user->id) ->with('notification') ->orderBy('created_at', 'desc'); if ($request->filled('search')) { $search = $request->search; $query->whereHas('notification', function($q) use ($search) { $q->where('title', 'like', "%{$search}%") ->orWhere('message', 'like', "%{$search}%"); }); } if ($request->filled('filter')) { if ($request->filter === 'unread') { $query->where('is_read', false); } elseif ($request->filter === 'read') { $query->where('is_read', true); } } $notifications = $query->paginate(15); $notifications->getCollection()->transform(function($userNotification) use ($user) { $relatedRoute = null; if ($userNotification->notification && (str_contains($userNotification->notification->title, 'candidature') || str_contains($userNotification->notification->message, 'candidature'))) { $candidateName = null; if (preg_match('/de (.+?)\./', $userNotification->notification->message, $matches)) { $candidateName = trim($matches[1]); } $jobTitle = null; if (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } if ($candidateName && $jobTitle) { $application = Application::whereHas('job', function($q) use ($user, $jobTitle) { $q->where('recruiter_id', $user->id) ->where('title', $jobTitle); }) ->whereHas('candidate', function($q) use ($candidateName) { $q->where('name', 'like', "%{$candidateName}%"); }) ->first(); if ($application && $application->job) { $relatedRoute = route('recruiter.jobs.applications', $application->job); } } if (!$relatedRoute && $jobTitle) { $job = Job::where('recruiter_id', $user->id) ->where('title', $jobTitle) ->first(); if ($job) { $relatedRoute = route('recruiter.jobs.applications', $job); } } if (!$relatedRoute) { $relatedRoute = route('recruiter.jobs'); } } if ($userNotification->notification && (str_contains($userNotification->notification->title, 'Entretien') || str_contains($userNotification->notification->title, 'entretien') || str_contains($userNotification->notification->title, 'modification') || str_contains($userNotification->notification->title, 'annulé') || str_contains($userNotification->notification->title, 'confirmé') || str_contains($userNotification->notification->title, 'Problème') || str_contains($userNotification->notification->message, 'entretien'))) { $candidateName = null; $jobTitle = null; if (preg_match('/^([A-ZÉÈÊËÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ][a-zéèêëàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ]+(?:\s+[A-ZÉÈÊËÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ][a-zéèêëàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþ]+)+)\s+a\s+(?:confirmé|annulé|demandé|signalé)/', $userNotification->notification->message, $matches)) { $candidateName = trim($matches[1]); } elseif (preg_match('/^(.+?)\s+a\s+(?:confirmé|annulé|demandé|signalé)/', $userNotification->notification->message, $matches)) { $candidateName = trim($matches[1]); } $jobTitle = null; if (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } if ($candidateName && $jobTitle) { $interview = Interview::whereHas('candidate', function($q) use ($candidateName) { $q->where('name', 'like', "%{$candidateName}%"); }) ->whereHas('job', function($q) use ($user, $jobTitle) { $q->where('recruiter_id', $user->id) ->where('title', $jobTitle); }) ->whereNotIn('status', ['annule', 'termine']) ->orderBy('interview_date', 'desc') ->orderBy('created_at', 'desc') ->first(); if (!$interview) { $interview = Interview::whereHas('candidate', function($q) use ($candidateName) { $q->where('name', 'like', "%{$candidateName}%"); }) ->whereHas('job', function($q) use ($user, $jobTitle) { $q->where('recruiter_id', $user->id) ->where('title', 'like', "%{$jobTitle}%"); }) ->whereNotIn('status', ['annule', 'termine']) ->orderBy('interview_date', 'desc') ->orderBy('created_at', 'desc') ->first(); } if ($interview) { $relatedRoute = route('recruiter.interviews.edit', $interview); } } if (!$relatedRoute && $candidateName) { $interview = Interview::whereHas('candidate', function($q) use ($candidateName) { $q->where('name', 'like', "%{$candidateName}%"); }) ->where('recruiter_id', $user->id) ->whereNotIn('status', ['annule', 'termine']) ->orderBy('interview_date', 'desc') ->orderBy('created_at', 'desc') ->first(); if ($interview) { $relatedRoute = route('recruiter.interviews.edit', $interview); } } if (!$relatedRoute) { $relatedRoute = route('recruiter.interviews'); } } if (!$relatedRoute && $userNotification->notification && in_array($userNotification->notification->type, ['interview', 'interview_update'])) { $relatedRoute = route('recruiter.interviews'); } $userNotification->related_route = $relatedRoute; return $userNotification; }); if ($request->ajax()) { return api_json([ 'html' => view('recruiter.notifications-partial', compact('notifications'))->render(), 'has_more' => $notifications->hasMorePages(), 'next_page' => $notifications->currentPage() + 1 ]); } return view('recruiter.notifications', compact('notifications'));
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
