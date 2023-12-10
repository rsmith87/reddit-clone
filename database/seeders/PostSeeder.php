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
use App\Models\Vote;
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

        $queued_post = new Post;
        $queued_post->user_id = $user->id;
        $queued_post->title = "QUEUED Post for testing";
        $queued_post->content = "This post is for setting up Postman data for testing.";
        $queued_post->status = PostStatus::QUEUED;
        $queued_post->slug = "queued-post-for-testing";
        $queued_post->save();


        $draft_post = new Post;
        $draft_post->user_id = $user->id;
        $draft_post->title = "DRAFT Post for testing";
        $draft_post->content = "This post is for setting up Postman data for testing.";
        $draft_post->status = PostStatus::DRAFT;
        $draft_post->slug = "draft-post-for-testing";
        $draft_post->save();

        Post::factory()
            ->has(Statistics::factory())
            ->has(Tag::factory()->count(3))
            //->has(Reaction::factory())
            ->has(Comment::factory()->count(5))
            ->has(Vote::factory()->count(100))
            ->count(10)
            ->createQuietly();

        //Post::where('id', '=', 1)->first()->votes()->save(Vote::factory()->count(100)->create());
    }
}
