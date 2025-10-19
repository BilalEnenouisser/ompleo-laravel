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
    /**
     * Display notifications management page
     */
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
        
        // Get statistics
        $stats = [
            'total' => Notification::count(),
            'sent' => Notification::sent()->count(),
            'pending' => Notification::pending()->count(),
            'candidates' => User::where('user_type', 'candidate')->count(),
            'recruiters' => User::where('user_type', 'recruiter')->count(),
        ];


        return view('dashboard.admin.notifications', compact('notifications', 'stats'));
    }

    /**
     * Store a newly created notification
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'type' => 'required|in:info,success,warning,error',
                'target_type' => 'required|in:all,candidates,recruiters'
            ]);

            $notification = Notification::create([
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type,
                'target_type' => $request->target_type,
                'is_sent' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Notification créée avec succès',
                'notification' => $notification
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors()))
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la création de la notification: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send notification to target users
     */
    public function send(Request $request, $id)
    {
        try {
            $notification = Notification::findOrFail($id);
            
            if ($notification->is_sent) {
                return response()->json([
                    'success' => false,
                    'error' => 'Cette notification a déjà été envoyée'
                ], 400);
            }

            // Get target users based on target_type
            $users = $this->getTargetUsers($notification->target_type);
            
            if ($users->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Aucun utilisateur trouvé pour ce type de notification'
                ], 400);
            }

            // Store target users
            $notification->update([
                'target_users' => $users->pluck('id')->toArray(),
                'is_sent' => true,
                'sent_at' => now()
            ]);

            // Create user notifications for each target user
            foreach ($users as $user) {
                UserNotification::create([
                    'user_id' => $user->id,
                    'notification_id' => $notification->id,
                    'is_read' => false
                ]);
            }

            // Here you would typically send emails or push notifications
            // For now, we'll just mark as sent
            // In a real application, you would integrate with email services or push notification services

            return response()->json([
                'success' => true,
                'message' => "Notification envoyée à {$users->count()} utilisateur(s)",
                'sent_count' => $users->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de l\'envoi de la notification: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get target users based on target type
     */
    private function getTargetUsers($targetType)
    {
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
        try {
            $notification = Notification::findOrFail($id);
            $notification->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notification supprimée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
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
        $stats = [
            'total' => Notification::count(),
            'sent' => Notification::sent()->count(),
            'pending' => Notification::pending()->count(),
            'candidates' => User::where('user_type', 'candidate')->count(),
            'recruiters' => User::where('user_type', 'recruiter')->count(),
            'all_users' => User::count()
        ];

        return response()->json($stats);
    }
}
