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
     * Inverse relationship for the Post to have PostStatistics
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
