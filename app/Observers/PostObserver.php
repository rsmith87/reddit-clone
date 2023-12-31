<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->user_id = Auth::id();
        $post->slug = $post->generateSlug($post->title);
    }

    /**
     * User is authorized to update the post.
     *
     * @return void
     */
    public function updating(Post $post)
    {
        $post->user_id = Auth::id();
    }
}
