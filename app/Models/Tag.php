<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;

    public function getRouteKeyName()
    {
        return 'slug'; // replace with your actual route key name
    }

    /**
     * The field that should be used for the slug.
     */
    protected $slugField = 'name';

    /**
     * The guarded attributes of the model.
     */
    public $guarded = [
        'slug',
    ];


    /**
     * The fillable attributes of the model.
     */
    public $fillable = [
        'name',
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggables');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Media::class, 'taggables');
    }

    /**
     * Generate a slug of the tag by name.
     */
    public function generateSlug($name): string
    {
        return Str::slug($name);
    }
}
