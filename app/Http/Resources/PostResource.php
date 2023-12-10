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
            'created_by' => new UserResource($this->whenLoaded('user')),
            'tags'       => TagResource::collection($this->whenLoaded('tags')),
            'comments'   => CommentResource::collection($this->whenLoaded('comments')),
            'statistics' => new StatisticsResource($this->whenNotNull($statistics)),
            'upvote_count' => $this->getUpvoteCount($this),
            'downvote_count' => $this->getDownvoteCount($this),
        ];
    }

    private function getUpvoteCount($votable)
    {
        return $votable->votes()->where('vote', 'upvote')->count();
    }

    private function getDownvoteCount($votable)
    {
        return $votable->votes()->where('vote', 'downvote')->count();
    }
}
