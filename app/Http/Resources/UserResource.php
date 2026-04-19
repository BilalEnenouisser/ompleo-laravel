<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $viewer = $request->user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->when($viewer && (int) $viewer->id === (int) $this->id, $this->email),
            'user_type' => $this->user_type,
            'avatar' => $this->avatar,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'candidate_profile' => $this->whenLoaded('candidateProfile', function () {
                return [
                    'id' => $this->candidateProfile?->id,
                    'city' => $this->candidateProfile?->city,
                    'title' => $this->candidateProfile?->title,
                    'avatar' => $this->candidateProfile?->avatar,
                ];
            }),

            'recruiter_profile' => $this->whenLoaded('recruiterProfile', function () {
                return [
                    'id' => $this->recruiterProfile?->id,
                    'position' => $this->recruiterProfile?->position,
                    'company_id' => $this->recruiterProfile?->company_id,
                    'avatar' => $this->recruiterProfile?->avatar,
                ];
            }),
        ];
    }
}
