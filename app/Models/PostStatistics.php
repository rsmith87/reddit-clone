<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostStatistics extends Model
{
    use HasFactory;

    /**
     * The mass assignable attributes of the PostStatistics model
     */
    public $fillable = [
        'view_count',
        'upvote_count',
        'downvote_count',
    ];

    /**
     * Get popular posts.
     */
    public function scopePopular($query)
    {
        return $query->where('upvote_count', '>', 100);
    }

    public function scopeUnpopular($query)
    {
        return $query->where('downvote_count', '>', 100)->where('view_count', '>' , 100);
    }

    /**
     * Inverse relationship for the Post to have PostStatistics
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
