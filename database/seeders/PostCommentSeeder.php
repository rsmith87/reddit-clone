<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\PostComment;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $post = Post::where('id', 1)->first();
        $user = User::where('id', 1)->first();

        $comments = new PostComment;
        $comments->comment = 'This is a comment for testing.';
        $comments->user_id = $user->id;
        $post->postComments()->save($comments);


        //PostComment::factory()->count(20)->createQuietly();
    }
}
