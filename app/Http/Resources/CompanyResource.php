<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'logo' => $this->logo,
            'website' => $this->website,
            'size' => $this->size,
            'industry' => $this->industry,
            'specialisation' => $this->specialisation,
            'years_experience' => $this->years_experience,
            'location' => $this->location,
            'is_active' => (bool) $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'jobs' => JobResource::collection($this->whenLoaded('jobs')),
        ];
    }
}
