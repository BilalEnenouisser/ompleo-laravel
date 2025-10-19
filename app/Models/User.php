<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * Get the candidate profile for the user.
     */
    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class);
    }

    /**
     * Get the recruiter profile for the user.
     */
    public function recruiterProfile()
    {
        return $this->hasOne(RecruiterProfile::class);
    }

    /**
     * Get the applications for the user (as candidate).
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'candidate_id');
    }

    /**
     * Get the jobs created by the user (as recruiter).
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'recruiter_id');
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    /**
     * Check if the user is a recruiter.
     */
    public function isRecruiter()
    {
        return $this->user_type === 'recruiter';
    }

    /**
     * Check if the user is a candidate.
     */
    public function isCandidate()
    {
        return $this->user_type === 'candidate';
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
