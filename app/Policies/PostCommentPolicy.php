<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PostComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;
    public User $user;
    public PostComment $comment;

    /**
     * Ensure user can view comment.
     *
     * @param  User  $user
     * @param  PostComment  $comment
     * @return bool
     */
    public function view(User $user)
    {
        return true; // Allow everyone to view.
    }

    /**
     * Ensure user can create comment.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user?->id; // Only allow users who are logged in.
    }

    /**
     * Determine if the given user can delete the given comment.
     *
     *
     * @return bool
     */
    public function destroy(User $user, PostComment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
