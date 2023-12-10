<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Traits\Votable;

class Comment extends Model
{
    use HasFactory;
    use Votable;

    public $fillable = [
        'comment',
    ];

    protected $casts = [
        'comment' => 'string',
        'user_id' => 'integer',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'commentables');
    }

    public function media(): MorphToMany
    {
        return $this->morphedByMany(Media::class, 'commentables');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
