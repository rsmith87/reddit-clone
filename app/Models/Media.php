<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Media extends Model
{
    use HasFactory;

    /**
     * The fillable attributes of the model.
     */
    public $fillable = [
        'path',
        'mime_type',
        'size',
        'extension',
    ];

    /**
     * Relationships
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }
}
