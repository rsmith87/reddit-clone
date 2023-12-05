<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Group;
use App\Models\Comment;
use App\Models\Statistics;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->runArtisanCommand('media:deleteFiles');

        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            MediaSeeder::class,
            MailTemplateSeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            SettingsSeeder::class,
            CommentSeeder::class,
            StatisticsSeeder::class,
            ReactionSeeder::class,
        ]);


        Post::all()->each(function ($post) {
            $post->groups()->attach(Group::all()->random(1)->pluck('id'));
            //$post->comments()->attach(Comment::all()->random(1)->pluck('id'));
        });

        Media::all()->each(function ($media) {
            $media->comments()->attach(Comment::all()->random(1)->pluck('id'));
        });
    }

    private function runArtisanCommand(string $command): void
    {
        $this->command->info('Running command: '.$command);
        Artisan::call($command);
    }
}
