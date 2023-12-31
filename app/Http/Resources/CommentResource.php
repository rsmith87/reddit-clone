<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Comment */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment' => $this->comment,
            'created_at' => $this->created_at,     
            'user' => new UserResource($this->user),
        ];
    }
}
