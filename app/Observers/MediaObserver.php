<?php

namespace App\Observers;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaObserver
{
    public function creating(Media $media)
    {
        $media->user_id = Auth::id();
    }
}
