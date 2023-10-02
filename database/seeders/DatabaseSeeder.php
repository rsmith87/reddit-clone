<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Media;

use Database\Seeders\PostSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\MediaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PostSeeder::class,
            TagSeeder::class,
            MediaSeeder::class,
        ]);
        User::create([
            'name' => 'Rob',
            'email' => 'codenut33@gmail.com',
            'password' => '123123123',
        ]);
        // Populates tags on posts.
        $tags = Tag::all();
        Post::all()->each(function($post) use ($tags) {
            $post->tags()->attach(
                $tags->random((rand(1, 10)))->pluck('id')->toArray()
            );
        });

        Media::all()->each(function($media) use ($tags) {
            $media->tags()->attach(
                $tags->random((rand(1, 10)))->pluck('id')->toArray()
            );
        });
    }
}
