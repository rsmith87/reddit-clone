<?php

namespace App\Http\Resources\PostComment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment'    => $this->comment,
            'created_at' => $this->created_at,
            'user'       => new UserResource($this->user),
        ];
    }
}
