<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    public User $user;
    public Post $post;

    /**
     * Ensure user can view post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return bool
     */
    public function view(User $user)
    {
        return true; // Allow everyone to view.
    }

    /**
     * Ensure user can create post.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user?->id; // Only allow users who are logged in.
    }

    /**
     * Ensure user can update post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine if the given user can delete the given post.
     *
     *
     * @return bool
     */
    public function destroy(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
