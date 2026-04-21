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
        $this->authorize('scanner-pass');
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $this->authorize('scanner-pass'); $this->authorize('viewAny', UserNotification::class); $query = UserNotification::with(['notification', 'user']) ->orderBy('created_at', 'desc'); if ($request->filled('search')) { $search = $request->search; $query->whereHas('notification', function($q) use ($search) { $q->where('title', 'like', "%{$search}%") ->orWhere('message', 'like', "%{$search}%"); })->orWhereHas('user', function($q) use ($search) { $q->where('name', 'like', "%{$search}%") ->orWhere('email', 'like', "%{$search}%"); }); } if ($request->filled('filter')) { if ($request->filter === 'unread') { $query->where('is_read', false); } elseif ($request->filter === 'read') { $query->where('is_read', true); } } $notifications = $query->paginate(15); $notifications->getCollection()->transform(function($userNotification) { if ($userNotification->notification && in_array($userNotification->notification->type, ['interview', 'interview_update'])) { $jobTitle = null; if (preg_match('/- (.+)$/', $userNotification->notification->title, $matches)) { $jobTitle = trim($matches[1]); } elseif (preg_match('/poste "([^"]+)"/', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } elseif (preg_match('/poste de (.+?)\./', $userNotification->notification->message, $matches)) { $jobTitle = trim($matches[1]); } $candidateId = $userNotification->user_id; $notificationTime = $userNotification->created_at; if ($jobTitle) { $interview = Interview::where('candidate_id', $candidateId) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', $jobTitle); }) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(5), $notificationTime->copy()->addMinutes(5) ]) ->orderBy('created_at', 'desc') ->first(); if (!$interview) { $interview = Interview::where('candidate_id', $candidateId) ->whereHas('job', function($q) use ($jobTitle) { $q->where('title', 'like', "%{$jobTitle}%"); }) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(5), $notificationTime->copy()->addMinutes(5) ]) ->orderBy('created_at', 'desc') ->first(); } } if (!$interview) { $interview = Interview::where('candidate_id', $candidateId) ->with(['job.company', 'candidate']) ->whereBetween('created_at', [ $notificationTime->copy()->subMinutes(1), $notificationTime->copy()->addMinutes(1) ]) ->orderBy('created_at', 'desc') ->first(); } if ($interview) { $userNotification->interview = $interview; } } return $userNotification; }); if ($request->ajax()) { return api_json([ 'html' => view('admin.notifications-partial', compact('notifications'))->render(), 'has_more' => $notifications->hasMorePages(), 'next_page' => $notifications->currentPage() + 1 ]); } return view('admin.notifications', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $this->authorize('scanner-pass');
        $userNotification = UserNotification::findOrFail($id);
        $this->authorize('update', $userNotification);
            
        $userNotification->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        if (request()->expectsJson()) {
            return api_json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }
    
    public function markAllAsRead()
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', UserNotification::class);

        UserNotification::where('is_read', false)
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
        $userNotification = UserNotification::findOrFail($id);
        $this->authorize('delete', $userNotification);
            
        $userNotification->delete();

        if (request()->expectsJson()) {
            return api_json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Notification supprimée.');
    }
    
    public function destroyAll()
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', UserNotification::class);

        UserNotification::truncate();
        
        if (request()->expectsJson()) {
            return api_json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Toutes les notifications ont été supprimées.');
    }
}
