<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'author_name' => $this->author_name,
            'category' => $this->category,
            'status' => $this->status,
            'tags' => $this->tags,
            'views' => $this->views,
            'reading_time' => $this->reading_time,
            'featured_image' => $this->featured_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}