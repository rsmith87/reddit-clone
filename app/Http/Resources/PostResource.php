<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'     => $this->status,
            'title'      => $this->title,
            'content'    => $this->content,
            'slug'       => $this->slug,
            'tags'       => TagResource::collection($this->tags),
            'comments'   => PostCommentResource::collection($this->postComments),
            'statistics' => (new PostStatisticsResource($this->postStatistics)),
        ];
    }
}
