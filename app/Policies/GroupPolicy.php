<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;
    public User $user;
    public Group $group;

    /**
     * Ensure user can view group.
     *
     * @param  User  $user
     * @param  Group  $group
     * @return bool
     */
    public function view(User $user, Group $group)
    {
        return true; // Allow everyone to view.
    }

    /**
     * Ensure user can create group.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user?->id; // Only allow users who are logged in.
    }

    /**
     * Ensure user can update group.
     *
     * @param  User  $user
     * @param  Group  $group
     * @return bool
     */
    public function update(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }

    /**
     * Determine if the given user can delete the given group.
     *
     *
     * @return bool
     */
    public function destroy(User $user, Group $group)
    {
        return $user->id === $group->user_id;
    }
}
