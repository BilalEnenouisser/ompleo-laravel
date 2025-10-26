<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruiter_id',
        'candidate_id',
        'job_id',
        'application_id',
        'interview_date',
        'start_time',
        'duration_minutes',
        'type',
        'location',
        'notes',
        'status',
        'meeting_link',
        'meeting_id',
        'meeting_password',
    ];

    protected $casts = [
        'interview_date' => 'date',
        'start_time' => 'datetime:H:i',
        'duration_minutes' => 'integer',
    ];

    /**
     * Get the recruiter that owns the interview.
     */
    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    /**
     * Get the candidate for the interview.
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    /**
     * Get the job for the interview.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the application for the interview.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the formatted start time.
     */
    public function getFormattedStartTimeAttribute(): string
    {
        return Carbon::parse($this->start_time)->format('H:i');
    }

    /**
     * Get the formatted duration.
     */
    public function getFormattedDurationAttribute(): string
    {
        return "({$this->duration_minutes}min)";
    }

    /**
     * Get the full time with duration.
     */
    public function getFullTimeAttribute(): string
    {
        return $this->formatted_start_time . ' ' . $this->formatted_duration;
    }

    /**
     * Get the formatted interview date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->interview_date->format('Y-m-d');
    }

    /**
     * Get the status in French.
     */
    public function getStatusInFrenchAttribute(): string
    {
        $statusMap = [
            'programme' => 'Programmé',
            'confirme' => 'Confirmé',
            'en_attente' => 'En attente',
            'annule' => 'Annulé',
            'termine' => 'Terminé',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    /**
     * Get the type in French.
     */
    public function getTypeInFrenchAttribute(): string
    {
        $typeMap = [
            'visioconference' => 'Visioconférence',
            'presentiel' => 'Présentiel',
            'telephonique' => 'Téléphonique',
        ];

        return $typeMap[$this->type] ?? $this->type;
    }

    /**
     * Scope a query to only include interviews for a specific recruiter.
     */
    public function scopeForRecruiter($query, $recruiterId)
    {
        return $query->where('recruiter_id', $recruiterId);
    }

    /**
     * Scope a query to only include interviews for a specific candidate.
     */
    public function scopeForCandidate($query, $candidateId)
    {
        return $query->where('candidate_id', $candidateId);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('interview_date', [$startDate, $endDate]);
    }
}
