<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Models\Traits\HasSlug;
use App\Models\Traits\Votable;
use App\Models\User;
use App\Models\Reaction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use Votable;

    public function getRouteKeyName()
    {
        return 'slug'; // replace with your actual route key name
    }

    protected $slugField = 'title';

    protected $guarded = [
        'user_id',
        'slug',
    ];

    /**
     * Fillable attributes for the model
     */
    public $fillable = [
        'status',
        'title',
        'content',
    ];

    protected $casts = [
        'status'  => PostStatus::class,
        'slug'    => 'string',
        'user_id' => 'integer',
    ];

    /**
     * Gets tags that were attached to the post.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }

    public function comments(): MorphToMany
    {
        return $this->morphToMany(Comment::class, 'commentables');
    }

    public function statistics(): MorphOne
    {
        return $this->morphOne(Statistics::class, 'statisticables');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable', 'votable_type', 'votable_id');
    }

    public function scopePopular(Builder $query): void
    {
        $query->whereHas('statistics', function ($subquery) {
            $subquery->where('upvote_count', '>', 100);
        });
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
     * Retrieve user of post.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Handle relationship with groups.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_post');
    }
}
