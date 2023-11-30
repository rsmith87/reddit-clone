<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = new Tag;
        $tag->name = 'Laravel';
        $tag->slug = 'laravel';
        $tag->saveQuietly();
    }
}
