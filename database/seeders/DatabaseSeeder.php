<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Group;
use App\Models\Comment;
use App\Models\Statistics;
use App\Models\User;
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
            UserProfileSeeder::class,
        ]);


        // Attach a group to each post.
        Post::all()->each(function ($post) {
            $post->groups()->attach(Group::all()->random(1)->pluck('id'));
        });

        // Attach comments to each media.
        Media::all()->each(function ($media) {
            $media->comments()->attach(Comment::all()->random(1)->pluck('id'));
        });

        // Attach all users to a random group.
        User::all()->each(function ($user) {
            $user->groups()->attach(Group::all()->random(1)->first());
        });

        // Set admin user to group 1.
        Group::where('id', '=', 1)->first()->users()->attach(User::where('id', '=', 1)->first());

        // Add 10 comments to post 1.
        $post = Post::where('id', '=', 1)->first();
        for($i=0; $i<10; $i++) {
            $post->comments()->attach(Comment::all()->random(1)->pluck('id'));
        }
    }

    private function runArtisanCommand(string $command): void
    {
        $this->command->info('Running command: '.$command);
        Artisan::call($command);
    }
}
