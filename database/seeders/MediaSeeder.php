<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::factory()->has(Tag::factory())->count(10)->createQuietly();
    }
}
