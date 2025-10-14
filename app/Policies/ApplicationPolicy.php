<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isRecruiter() || $user->isCandidate();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Application $application): bool
    {
        // Admin can view all applications
        if ($user->isAdmin()) {
            return true;
        }
        
        // Recruiter can view applications for their jobs
        if ($user->isRecruiter() && $application->job->recruiter_id === $user->id) {
            return true;
        }
        
        // Candidate can view their own applications
        if ($user->isCandidate() && $application->candidate_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isCandidate();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): bool
    {
        // Admin can update all applications
        if ($user->isAdmin()) {
            return true;
        }
        
        // Recruiter can update applications for their jobs
        if ($user->isRecruiter() && $application->job->recruiter_id === $user->id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): bool
    {
        // Only admin can delete applications
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return $user->isAdmin();
    }
}
