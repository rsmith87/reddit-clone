<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_data',
    ];

    protected $guarded = [
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id'    => 'integer',
        'profile_data' => 'array',
    ];

    /**
     * The user that belongs to the profile.

     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
