<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModifiedMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'path'      => $this->path,
            'mime_type' => $this->mime_type,
            'size'      => $this->size,
            'tags'       => TagResource::collection($this->tags),
            'public_path' => \URL::asset(str_replace('/var/www/html/public', '', $this->path)),
        ];
    }
}
