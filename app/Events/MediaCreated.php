<?php

namespace App\Events;

use App\Models\Media;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class MediaCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Media $media;

    /**
     * Create a new event instance.
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }
}
