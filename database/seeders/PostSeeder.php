<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostStatistics;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
            ->has(PostStatistics::factory())
            ->has(PostComment::factory())
            ->has(Tag::factory())
            ->count(40)
            ->createQuietly();
    }
}
