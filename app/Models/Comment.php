<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        'comment',
    ];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'commentables');
    }

    public function media(): MorphToMany
    {
        return $this->morphedByMany(Media::class, 'commentables');
    }
}
