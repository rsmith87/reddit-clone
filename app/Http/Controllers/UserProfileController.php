<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;

class UserProfileController extends Controller
{
    public function getProfileForUser(User $user)
    {
        $user = User::with('userProfile')->find($user->id);

        return new UserProfileResource($user->profile);
    }

    public function createProfileForUser(UserProfileRequest $request, User $user)
    {
        $user->profile()->create($request->validated());

        return new UserProfileResource($user->profile);
    }

    public function editProfileForUser(UserProfileRequest $request, User $user)
    {
        $user->profile()->update($request->all());

        return new UserProfileResource($user->profile);
    }

    public function deleteProfileForUser(User $user)
    {
        $user->profile()->delete();

        return response()->json(null, 204);
    }
}
