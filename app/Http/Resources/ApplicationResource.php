<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_id' => $this->job_id,
            'candidate_id' => $this->candidate_id,
            'cover_letter' => $this->cover_letter,
            'resume_url' => $this->when(
    auth()->user()?->isAdmin()
    || auth()->id() === $this->candidate_id
    || auth()->id() === optional($this->job)->recruiter_id,
    fn () => $this->resume_path
),
            'status' => $this->status,
            'applied_at' => $this->applied_at,
            'reviewed_at' => $this->reviewed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'job' => new JobResource($this->whenLoaded('job')),
            'candidate' => new UserResource($this->whenLoaded('candidate')),
        ];
    }
}
