<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Votable
{
	/**
	 * Get all votes for the model.
	 */
	public function votes(): MorphMany
	{
		return $this->morphMany(Vote::class, 'votable');
	}

	/**
	 * Upvote the model.
	 */
	public function upvote(User $user): void
	{
		$this->votes()->updateOrCreate([
			'user_id' => $user->id,
		], [
			'value' => 1,
		]);
	}

	/**
	 * Downvote the model.
	 */
	public function downvote(User $user): void
	{
		$this->votes()->updateOrCreate([
			'user_id' => $user->id,
		], [
			'value' => -1,
		]);
	}

	/**
	 * Cancel the vote for the model.
	 */
	public function undoVote(User $user): void
	{
		$this->votes()->where('user_id', $user->id)->delete();
	}

	/**
	 * Check if the model is upvoted by the given user.
	 */
	public function isUpvotedBy(User $user): bool
	{
		return $this->votes()->where('user_id', $user->id)->where('value', 1)->exists();
	}

	/**
	 * Check if the model is downvoted by the given user.
	 */
	public function isDownvotedBy(User $user): bool
	{
		return $this->votes()->where('user_id', $user->id)->where('value', -1)->exists();
	}

	/**
	 * Check if the model is voted by the given user.
	 */
	public function isVotedBy(User $user): bool
	{
		return $this->votes()->where('user_id', $user->id)->exists();
	}
}
