<?php

namespace Database\Seeders;

use App\Models\Reaction;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Statistics;
use App\Models\Tag;
use App\Enums\PostStatus;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('id', 1)->first();

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = "PUBLISHED Post for testing";
        $post->content = "This post is for setting up Postman data for testing.";
        $post->status = PostStatus::PUBLISHED;
        $post->slug = "published-post-for-testing";
        $post->save();

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = "QUEUED Post for testing";
        $post->content = "This post is for setting up Postman data for testing.";
        $post->status = PostStatus::QUEUED;
        $post->slug = "queued-post-for-testing";
        $post->save();


        $post = new Post;
        $post->user_id = $user->id;
        $post->title = "DRAFT Post for testing";
        $post->content = "This post is for setting up Postman data for testing.";
        $post->status = PostStatus::DRAFT;
        $post->slug = "draft-post-for-testing";
        $post->save();
        

        Post::factory()
            ->has(Statistics::factory())
            ->has(Tag::factory())
            ->has(Reaction::factory())
            //->has(Group::factory())
            ->has(Comment::factory())
            ->count(10)
            ->createQuietly();
    }
}
