<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$comment = new Comment;
        $comment->user_id = 1;
        $comment->content = "This is a comment for testing.";
        $comment->save();*/

        // TODO: figure out how to seed comments with polymorphic relationships

        Comment::factory()->count(10)->create();
    }
}
