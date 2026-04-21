<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->authorize('scanner-pass');
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display notifications management page
     */
    public function index()
    {
        $this->authorize('scanner-pass'); $notifications = Notification::with('userNotifications')->orderBy('created_at', 'desc')->paginate(10); foreach ($notifications as $notification) { if ($notification->is_sent) { $totalRecipients = 0; if ($notification->target_users && is_array($notification->target_users)) { $totalRecipients = count($notification->target_users); } else { if ($notification->target_type === 'all') { $totalRecipients = User::count(); } elseif ($notification->target_type === 'candidates') { $totalRecipients = User::where('user_type', 'candidate')->count(); } elseif ($notification->target_type === 'recruiters') { $totalRecipients = User::where('user_type', 'recruiter')->count(); } } $openedCount = $notification->userNotifications()->where('is_read', true)->count(); $notification->opened_count = $openedCount; $notification->total_recipients = $totalRecipients; $notification->opening_rate = $totalRecipients > 0 ? round(($openedCount / $totalRecipients) * 100) : 0; } else { $notification->opened_count = 0; $notification->total_recipients = 0; $notification->opening_rate = 0; } } $stats = [ 'total' => Notification::count(), 'sent' => Notification::sent()->count(), 'pending' => Notification::pending()->count(), 'candidates' => User::where('user_type', 'candidate')->count(), 'recruiters' => User::where('user_type', 'recruiter')->count(), 'all_users' => User::count() ]; return view('dashboard.admin.notifications', compact('notifications', 'stats'));
    }

    /**
     * Store a newly created notification
     */
    public function store(Request $request)
    {
        $this->authorize('scanner-pass'); try { $request->validate([ 'title' => 'required|string|max:255', 'message' => 'required|string|max:1000', 'type' => 'required|in:info,success,warning,error', 'target_type' => 'required|in:all,candidates,recruiters', 'rich_content' => 'nullable|string', 'background_color' => 'nullable|string|max:50' ]); $richContent = null; if ($request->rich_content) { $richContent = json_decode($request->rich_content, true); if (json_last_error() !== JSON_ERROR_NONE) { return api_json([ 'success' => false, 'error' => 'Invalid rich_content JSON format' ], 422); } } $notification = Notification::create([ 'title' => $request->title, 'message' => $request->message, 'type' => $request->type, 'target_type' => $request->target_type, 'rich_content' => $richContent, 'background_color' => $request->background_color, 'is_sent' => false ]); return api_json([ 'success' => true, 'message' => 'Notification créée avec succès', 'notification' => $notification ]); } catch (\Illuminate\Validation\ValidationException $e) { return api_json([ 'success' => false, 'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors())) ], 422); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de la création de la notification: ' . $e->getMessage() ], 500); }
    }

    /**
     * Send notification to target users
     */
    public function send(Request $request, $id)
    {
        $this->authorize('scanner-pass'); try { $notification = Notification::findOrFail($id); if ($notification->is_sent) { return api_json([ 'success' => false, 'error' => 'Cette notification a déjà été envoyée' ], 400); } $users = $this->getTargetUsers($notification->target_type); if ($users->isEmpty()) { return api_json([ 'success' => false, 'error' => 'Aucun utilisateur trouvé pour ce type de notification' ], 400); } $notification->update([ 'target_users' => $users->pluck('id')->toArray(), 'is_sent' => true, 'sent_at' => now() ]); foreach ($users as $user) { UserNotification::create([ 'user_id' => $user->id, 'notification_id' => $notification->id, 'is_read' => false ]); } return api_json([ 'success' => true, 'message' => "Notification envoyée à {$users->count()} utilisateur(s)", 'sent_count' => $users->count() ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de l\'envoi de la notification: ' . $e->getMessage() ], 500); }
    }

    /**
     * Get target users based on target type
     */
    private function getTargetUsers($targetType)
    {
        $this->authorize('scanner-pass');
        switch ($targetType) {
            case 'candidates':
                return User::where('user_type', 'candidate')->get();
            case 'recruiters':
                return User::where('user_type', 'recruiter')->get();
            case 'all':
            default:
                return User::all();
        }
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $this->authorize('scanner-pass');
        try {
            $notification = Notification::findOrFail($id);
            $notification->delete();

            return api_json([
                'success' => true,
                'message' => 'Notification supprimée avec succès'
            ]);

        } catch (\Exception $e) {
            return api_json([
                'success' => false,
                'error' => 'Erreur lors de la suppression de la notification: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get notification statistics
     */
    public function stats()
    {
        $this->authorize('scanner-pass');
        $stats = [
            'total' => Notification::count(),
            'sent' => Notification::sent()->count(),
            'pending' => Notification::pending()->count(),
            'candidates' => User::where('user_type', 'candidate')->count(),
            'recruiters' => User::where('user_type', 'recruiter')->count(),
            'all_users' => User::count()
        ];

        return api_json($stats);
    }
}
