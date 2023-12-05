<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\CommentResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'path'       => $this->path,
            'mime_type'  => $this->mime_type,
            'size'       => $this->size,
            'slug'       => $this->slug,
            'statistics' => StatisticsResource::collection($this->statistics),
            'tags'       => TagResource::collection($this->tags),
            'comments'   => CommentResource::collection($this->comments),
        ];
    }
}
