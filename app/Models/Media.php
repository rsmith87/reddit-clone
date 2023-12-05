<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Traits\HasSlug;
use Illuminate\Support\Str;


class Media extends Model
{
    use HasFactory;
    use HasSlug;

    public $guarded = [
        'name',
        'hash_name',
        'path',
        'mime_type',
        'size',
        'slug',
        'blob',
        'user_id',
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }

    public function comments(): MorphToMany
    {
        return $this->morphToMany(Comment::class, 'commentables');
    }

    public function statistics(): MorphMany
    {
        return $this->morphMany(Statistics::class, 'statisticables');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactions');
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

    /**
     * Generate a slug of the tag by name.
     */
    public function generateSlug($name): string
    {
        return Str::slug($name);
    }
}
