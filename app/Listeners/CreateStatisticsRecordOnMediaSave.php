<?php

namespace App\Listeners;

use App\Events\MediaCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Statistics;

class CreateStatisticsRecordOnMediaSave implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Handle the event.
     */
    public function handle(MediaCreated $event): void
    {
        $postStatistics = new Statistics;
        $postStatistics->statisticables_type = \App\Models\Media::class;
        $postStatistics->statisticables_id = $event->media->id;
        $postStatistics->views = 0;
        $postStatistics->likes = 0;
        $postStatistics->dislikes = 0;
        $postStatistics->save();
    }
}
