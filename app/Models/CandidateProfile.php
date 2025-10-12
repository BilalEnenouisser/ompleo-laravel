<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'date_of_birth',
        'bio',
        'skills',
        'experience',
        'education',
        'languages',
        'resume_path',
        'avatar',
        'linkedin_url',
        'portfolio_url',
    ];

    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'languages' => 'array',
        'date_of_birth' => 'date',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the applications for the candidate.
     */
    public function applications()
    {
        return $this->hasManyThrough(Application::class, User::class, 'id', 'candidate_id');
    }

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Get the age attribute.
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    /**
     * Scope a query to filter by city.
     */
    public function scopeByCity($query, $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }

    /**
     * Scope a query to filter by skills.
     */
    public function scopeBySkills($query, $skills)
    {
        return $query->whereJsonContains('skills', $skills);
    }
}
