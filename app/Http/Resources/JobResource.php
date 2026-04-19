<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'type' => $this->type,
            'work_type' => $this->work_type,
            'experience_level' => $this->experience_level,
            'status' => $this->status,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'application_deadline' => $this->application_deadline,
            'requirements' => $this->requirements,
            'benefits' => $this->benefits,
            'tags' => $this->tags,
            'responsibilities' => $this->responsibilities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => new CompanyResource($this->whenLoaded('company')),
            'recruiter' => new UserResource($this->whenLoaded('recruiter')),
        ];
    }
}
