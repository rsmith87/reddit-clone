<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    public $guarded = [
        'user_id',
        'reaction',
        'reactionables_id',
        'reactionables_type',
    ];

    public function reactions()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeLikes($query)
    {
        return $query->where('reaction', 'like');
    }

    public function scopeDislikes($query)
    {
        return $query->where('reaction', 'dislike');
    }
}
