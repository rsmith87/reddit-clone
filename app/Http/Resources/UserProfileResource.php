<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bio' => $this->profile_data['bio'],
            'city' => $this->profile_data['city'],
            'state' => $this->profile_data['state'],
            'twitter' => $this->profile_data['twitter'],
            'website' => $this->profile_data['website'],
        ];
    }
}
