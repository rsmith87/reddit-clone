<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostStatistics;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postStatistics = new PostStatistics;
        $postStatistics->post_id = 1;
        $postStatistics->view_count = 100;
        $postStatistics->upvote_count = 50;
        $postStatistics->downvote_count = 50;
        $postStatistics->save();

        $postStatistics = new PostStatistics;
        $postStatistics->post_id = 2;
        $postStatistics->view_count = 200;
        $postStatistics->upvote_count = 100;
        $postStatistics->downvote_count = 50;
        $postStatistics->save();
    }
}
