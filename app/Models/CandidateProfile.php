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
        'title',
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
        // Helper function to check if array has meaningful content
        $hasArrayContent = function($value) {
            if (empty($value)) {
                return false;
            }
            if (!is_array($value)) {
                return false;
            }
            // Check if array has at least one non-empty element
            foreach ($value as $item) {
                if (!empty($item)) {
                    // If item is itself an array, check if it has any non-empty values
                    if (is_array($item)) {
                        $hasContent = false;
                        foreach ($item as $subItem) {
                            if (!empty($subItem)) {
                                $hasContent = true;
                                break;
                            }
                        }
                        if ($hasContent) {
                            return true;
                        }
                    } else {
                        return true;
                    }
                }
            }
            return false;
        };

        // Essential fields required for profile completion
        // Note: Address is optional if city is provided, date_of_birth and languages are optional
        $essentialFields = [
            'phone' => !empty($this->phone) && trim($this->phone) !== '',
            'city' => !empty($this->city) && trim($this->city) !== '',
            'bio' => !empty($this->bio) && trim($this->bio) !== '',
            'skills' => $hasArrayContent($this->skills),
            'experience' => $hasArrayContent($this->experience),
            'education' => $hasArrayContent($this->education),
        ];

        // Count address if city is not provided (to encourage location info)
        // But don't require both
        if (empty($this->city) || trim($this->city) === '') {
            $essentialFields['address'] = !empty($this->address) && trim($this->address) !== '';
        }

        $completedEssentialFields = array_filter($essentialFields);
        $totalEssentialFields = count($essentialFields);
        $completedCount = count($completedEssentialFields);

        // Calculate percentage based on essential fields only
        $percentage = round(($completedCount / $totalEssentialFields) * 100);
        
        // Cap at 100%
        return min($percentage, 100);
    }
}
