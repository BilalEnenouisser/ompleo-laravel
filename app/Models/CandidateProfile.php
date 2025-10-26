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
        'facebook_url',
        'twitter_url',
        'status',
        'experience_years',
        'availability',
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

    /**
     * Calculate profile completion percentage
     */
    public function getCompletionPercentage()
    {
        $fields = [
            'phone' => !empty($this->phone),
            'address' => !empty($this->address),
            'city' => !empty($this->city),
            'date_of_birth' => !empty($this->date_of_birth),
            'bio' => !empty($this->bio),
            'skills' => !empty($this->skills) && is_array($this->skills) && count($this->skills) > 0,
            'experience' => !empty($this->experience) && is_array($this->experience) && count($this->experience) > 0,
            'education' => !empty($this->education) && is_array($this->education) && count($this->education) > 0,
            'languages' => !empty($this->languages) && is_array($this->languages) && count($this->languages) > 0,
            'linkedin_url' => !empty($this->linkedin_url),
            'portfolio_url' => !empty($this->portfolio_url),
        ];

        $completedFields = array_filter($fields);
        $totalFields = count($fields);
        $completedCount = count($completedFields);

        return round(($completedCount / $totalFields) * 100);
    }
}
