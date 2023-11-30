<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Media extends Model
{
    use HasFactory;

    public $guarded = [
        'name',
        'hash_name',
        'path',
        'mime_type',
        'size',
        'blob',
        'user_id',
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeLargeSize($query)
    {
        return $query->where('size', '>', 1000000);
    }

    public function scopePng($query)
    {
        return $query->where('mime_type', 'image/png');
    }

    public function scopeJpg($query)
    {
        return $query->where('mime_type', 'image/jpg')->orWhere('mime_type', 'image/jpeg');
    }
}
