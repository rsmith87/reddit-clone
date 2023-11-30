<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'view_count'     => $this->view_count,
            'upvote_count'   => $this->upvote_count,
            'downvote_count' => $this->downvote_count,
        ];
    }
}
