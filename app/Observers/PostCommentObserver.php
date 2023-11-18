<?php

namespace App\Observers;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class PostCommentObserver
{
    public function creating(PostComment $postComment)
    {
        $postComment->user_id = Auth::id();
        $postComment->post_id = $postComment->post->id;
    }
}
