<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\StatisticsResource;
use App\Http\Resources\Group\GroupCollection;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $statistics = $this->whenLoaded('statistics');

        return [
            'status'     => $this->status,
            'title'      => $this->title,
            'content'    => $this->content,
            'slug'       => $this->slug,
            'tags'       => TagResource::collection($this->whenLoaded('tags')),
            'comments'   => CommentResource::collection($this->whenLoaded('comments')),
            'statistics' => new StatisticsResource($this->whenNotNull($statistics)),
        ];
    }
}
