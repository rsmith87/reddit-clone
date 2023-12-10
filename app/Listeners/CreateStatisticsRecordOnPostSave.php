<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Statistics;

class CreateStatisticsRecordOnPostSave 
{
    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $statistics = new Statistics;
        $statistics->statisticables_type = \App\Models\Post::class;
        $statistics->statisticables_id = $event->post->id;
        $statistics->views = 0;
        $statistics->likes = 0;
        $statistics->dislikes = 0;
        $statistics->save();
    }
}
