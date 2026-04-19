<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notification_id' => $this->notification_id,
            'user_id' => $this->user_id,
            'title' => $this->notification?->title,
            'message' => $this->notification?->message,
            'type' => $this->notification?->type,
            'rich_content' => $this->notification?->rich_content,
            'background_color' => $this->notification?->background_color,
            'created_at' => $this->created_at,
            'timestamp' => $this->created_at,
            'is_read' => (bool) $this->is_read,
            'isRead' => (bool) $this->is_read,
            'read_at' => $this->read_at,
            'interview' => $this->interview ?? null,
        ];
    }
}