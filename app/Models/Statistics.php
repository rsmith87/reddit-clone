<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Post;

class Statistics extends Model
{
    use HasFactory;

    public $guarded = [
        'views',
        'likes',
        'dislikes',
    ];

    protected $casts = [
        'views'     => 'integer',
        'likes'     => 'integer',
        'dislikes'  => 'integer',
    ];

    public function posts(): MorphOne
    {
        return $this->morphOne(Post::class, 'statisticables');
    }

    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'statisticables');
    }
}
