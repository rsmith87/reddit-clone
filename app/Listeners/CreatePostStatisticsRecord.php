<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\PostStatistics;

class CreatePostStatisticsRecord
{
    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $postStatistics = new PostStatistics;
        $postStatistics->post_id = $event->post->id;
        $postStatistics->upvote_count = 0;
        $postStatistics->downvote_count = 0;
        $postStatistics->view_count = 0;
        $postStatistics->save();
    }
}
