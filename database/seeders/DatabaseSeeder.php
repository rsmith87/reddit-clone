<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            MediaSeeder::class,
            MailTemplateSeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            PostCommentSeeder::class,
            PostStatisticsSeeder::class,
            SettingsSeeder::class,
        ]);

        Post::all()->each(function ($post) {
            $post->groups()->attach(Group::all()->random(1)->pluck('id'));
        });
    }
}
