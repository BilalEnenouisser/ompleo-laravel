<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'target_type',
        'target_users',
        'is_sent',
        'sent_at',
        'rich_content',
        'background_color'
    ];

    protected $casts = [
        'target_users' => 'array',
        'is_sent' => 'boolean',
        'sent_at' => 'datetime',
        'rich_content' => 'array'
    ];

    /**
     * Scope for sent notifications
     */
    public function scopeSent($query)
    {
        return $query->where('is_sent', true);
    }

    /**
     * Scope for pending notifications
     */
    public function scopePending($query)
    {
        return $query->where('is_sent', false);
    }

    /**
     * Scope for notifications by target type
     */
    public function scopeForTargetType($query, $targetType)
    {
        return $query->where('target_type', $targetType);
    }

    /**
     * Get the user notifications for this notification
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
