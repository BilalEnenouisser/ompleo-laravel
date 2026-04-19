<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserNotification;

class UserNotificationPolicy
{
    /**
     * Determine whether the user can view any user notifications.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isRecruiter() || $user->isCandidate();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserNotification $userNotification): bool
    {
        return $user->isAdmin() || $userNotification->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserNotification $userNotification): bool
    {
        return $user->isAdmin() || $userNotification->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserNotification $userNotification): bool
    {
        return $user->isAdmin() || $userNotification->user_id === $user->id;
    }
}