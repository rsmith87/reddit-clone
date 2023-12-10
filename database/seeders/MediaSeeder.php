<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Media;
use App\Models\Statistics;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::factory()
            ->has(Statistics::factory())
            ->has(Vote::factory())
            ->has(Comment::factory())
            ->count(10)
            ->create();
    }
}
