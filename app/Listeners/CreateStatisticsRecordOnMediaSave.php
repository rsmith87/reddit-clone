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
        $statistics = new Statistics;
        $statistics->statisticables_type = \App\Models\Media::class;
        $statistics->statisticables_id = $event->media->id;
        $statistics->views = 0;
        $statistics->likes = 0;
        $statistics->dislikes = 0;
        $statistics->save();
    }
}
