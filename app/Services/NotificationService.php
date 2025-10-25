<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    /**
     * Create and send a notification to specific users
     */
    public function createNotification($title, $message, $type = 'info', $userIds = [])
    {
        try {
            \Log::info('Creating notification: ' . $title . ' for users: ' . implode(',', $userIds));
            
            DB::beginTransaction();

            // Create the notification (like admin system)
            $notification = Notification::create([
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'target_type' => 'specific',
                'target_users' => $userIds,
                'is_sent' => false, // Start as not sent
            ]);

            \Log::info('Notification created with ID: ' . $notification->id);

            // Update to sent and set sent_at (like admin system)
            $notification->update([
                'is_sent' => true,
                'sent_at' => now()
            ]);

            // Create user notifications for each target user (like admin system)
            foreach ($userIds as $userId) {
                $userNotification = UserNotification::create([
                    'user_id' => $userId,
                    'notification_id' => $notification->id,
                    'is_read' => false,
                ]);
                \Log::info('User notification created for user: ' . $userId . ' with ID: ' . $userNotification->id);
            }

            DB::commit();
            \Log::info('Notification creation completed successfully');
            return $notification;

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to create notification: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Create notification for job application
     */
    public function notifyApplicationReceived($application)
    {
        $job = $application->job;
        $candidate = $application->candidate;
        
        // Get the recruiter (job owner)
        $recruiter = $job->recruiter;
        
        if (!$recruiter) {
            \Log::error('No recruiter found for job: ' . $job->id);
            return;
        }

        $title = "Nouvelle candidature reçue";
        $message = "Vous avez reçu une nouvelle candidature pour le poste \"{$job->title}\" de {$candidate->name}.";
        
        \Log::info('Sending notification to recruiter: ' . $recruiter->id);
        
        return $this->createNotification(
            $title,
            $message,
            'info',
            [$recruiter->id]
        );
    }

    /**
     * Create notification for application status update
     */
    public function notifyApplicationStatusUpdate($application, $status)
    {
        $job = $application->job;
        $candidate = $application->candidate;
        
        \Log::info('Creating status update notification for candidate: ' . $candidate->id . ' with status: ' . $status);
        
        $statusMessages = [
            'accepted' => [
                'title' => 'Candidature acceptée',
                'message' => "Félicitations ! Votre candidature pour le poste \"{$job->title}\" chez {$job->company->name} a été acceptée.",
                'type' => 'success'
            ],
            'rejected' => [
                'title' => 'Candidature rejetée',
                'message' => "Votre candidature pour le poste \"{$job->title}\" chez {$job->company->name} n'a pas été retenue.",
                'type' => 'warning'
            ],
            'shortlisted' => [
                'title' => 'Candidature présélectionnée',
                'message' => "Votre candidature pour le poste \"{$job->title}\" chez {$job->company->name} a été présélectionnée.",
                'type' => 'info'
            ]
        ];

        if (!isset($statusMessages[$status])) {
            \Log::warning('Unknown status for notification: ' . $status);
            return;
        }

        $notificationData = $statusMessages[$status];
        
        \Log::info('Creating notification with title: ' . $notificationData['title'] . ' for candidate: ' . $candidate->id);
        
        return $this->createNotification(
            $notificationData['title'],
            $notificationData['message'],
            $notificationData['type'],
            [$candidate->id]
        );
    }

    /**
     * Get unread notifications for a user
     */
    public function getUnreadNotifications($userId, $limit = 10)
    {
        return UserNotification::with('notification')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($userNotificationId, $userId)
    {
        $userNotification = UserNotification::where('id', $userNotificationId)
            ->where('user_id', $userId)
            ->first();

        if ($userNotification) {
            $userNotification->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }

        return $userNotification;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead($userId)
    {
        return UserNotification::where('user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Get notification count for a user
     */
    public function getUnreadCount($userId)
    {
        return UserNotification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }
}
