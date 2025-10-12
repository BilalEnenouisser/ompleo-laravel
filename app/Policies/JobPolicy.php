<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Anyone can view jobs list
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        // Published jobs can be viewed by anyone
        if ($job->status === 'published') {
            return true;
        }
        
        // Admin can view all jobs
        if ($user->isAdmin()) {
            return true;
        }
        
        // Recruiter can view their own jobs
        if ($user->isRecruiter() && $job->recruiter_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isRecruiter() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        // Admin can update all jobs
        if ($user->isAdmin()) {
            return true;
        }
        
        // Recruiter can update their own jobs
        if ($user->isRecruiter() && $job->recruiter_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        // Admin can delete all jobs
        if ($user->isAdmin()) {
            return true;
        }
        
        // Recruiter can delete their own jobs
        if ($user->isRecruiter() && $job->recruiter_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return $user->isAdmin();
    }
}
