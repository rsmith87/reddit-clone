<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;
    use HasSlug;

    public function getRouteKeyName()
    {
        return 'slug'; // replace with your actual route key name
    }


    /**
     * Set the field that should be used for the slug.
     *
     * @var string
     */
    protected $slugField = 'name';

    /**
     * Fillable attributes for the model
     */
    public $fillable = [
        'name',
        'type',
        'description',
    ];

    public $guarded = [
        'id',
        'slug',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'name'        => 'string',
        'description' => 'string',
        'slug'        => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'group_post', 'group_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}
