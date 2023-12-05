<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\UserResource;

class GroupPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'user' => (new UserResource($this->user)),
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            'statistics' => StatisticsResource::collection($this->statistics),
        ];
    }
}
