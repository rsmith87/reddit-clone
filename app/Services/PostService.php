<?php

namespace App\Services;

use App\Enums\PostStatus;
use App\Models\Post;

class PostService
{
    /**
     * Stores a new post
     *
     * @return mixed $post
     */
    public function store(
        string $title,
        PostStatus $status,
        string $content,
        string $slug
    ): Post {
        return Post::create([
            'title' => $title,
            'status' => PostStatus::PUBLISHED,
            'content' => $content,
            'slug' => $slug,
        ]);
    }
}
