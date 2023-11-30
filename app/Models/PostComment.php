<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostComment extends Model
{
    use HasFactory;

    /**
     * The fillable attributes of the model.
     */
    public $fillable = [
        'comment',
        'post_id',
    ];

    public $guarded = [
        'user_id',
    ];

    public $casts = [
        'user_id' => 'integer',
        'post_id' => 'integer',
        'comment' => 'string',
    ];

    /**
     * The user associated with the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The post associated with the comment.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
