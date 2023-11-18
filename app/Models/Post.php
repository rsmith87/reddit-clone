<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for the model
     */
    public $fillable = [
        'status',
        'title',
        'content',
        'slug',
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    public function scopePopular(Builder $query): void
    {
        $query->load(['postStatistics']);

        $query->where('upvote_count', '>', 200);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where(['status' => PostStatus::PUBLISHED]);
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where(['status' => PostStatus::DRAFT]);
    }

    public function scopeQueued(Builder $query): void
    {
        $query->where(['status' => PostStatus::QUEUED]);
    }

    /**
     * Gets tags that were attached to the post.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }

    /**
     * Retreives post statistics
     */
    public function postStatistics(): HasOne
    {
        return $this->hasOne(PostStatistics::class, 'post_id', 'id');
    }

    /**
     * Retrieves post comments
     */
    public function postComments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    /**
     * Retrieve user of post.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
