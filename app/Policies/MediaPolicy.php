<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Media;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;
    public User $user;
    public Media $media;

    /**
     * Ensure user can view media.
     *
     * @param  User  $user
     * @param  Media  $media
     * @return bool
     */
    public function view(User $user, Media $media)
    {
        return true; // Allow everyone to view.
    }

    /**
     * Ensure user can create media.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user?->id; // Only allow users who are logged in.
    }

    /**
     * Ensure user can update media.
     *
     * @param  User  $user
     * @param  Media  $media
     * @return bool
     */
    public function update(User $user, Media $media)
    {
        return $user->id === $media->user_id;
    }

    /**
     * Determine if the given user can delete the given media.
     *
     *
     * @return bool
     */
    public function destroy(User $user, Media $media)
    {
        return $user->id === $media->user_id;
    }
}
