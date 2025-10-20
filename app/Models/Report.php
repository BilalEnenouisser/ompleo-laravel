<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reported_user_id',
        'reporter_user_id',
        'reason',
        'description',
        'status',
        'admin_notes',
        'action_taken',
        'action_taken_at'
    ];

    protected $casts = [
        'action_taken_at' => 'datetime'
    ];

    /**
     * Get the user who was reported
     */
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    /**
     * Get the user who made the report
     */
    public function reporterUser()
    {
        return $this->belongsTo(User::class, 'reporter_user_id');
    }

    /**
     * Scope for pending reports
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for reviewed reports
     */
    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    /**
     * Scope for resolved reports
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    /**
     * Scope for dismissed reports
     */
    public function scopeDismissed($query)
    {
        return $query->where('status', 'dismissed');
    }
}
