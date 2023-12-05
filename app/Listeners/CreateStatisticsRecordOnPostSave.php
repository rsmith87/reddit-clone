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
        $postStatistics = new Statistics;
        $postStatistics->statisticables_type = \App\Models\Post::class;
        $postStatistics->statisticables_id = $event->post->id;
        $postStatistics->views = 0;
        $postStatistics->likes = 0;
        $postStatistics->dislikes = 0;
        $postStatistics->save();
    }
}
