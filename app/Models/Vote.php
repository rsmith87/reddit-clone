<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VoteType;

class Vote extends Model
{
    use HasFactory;

    public $fillable = [
        'vote',
    ];

    protected $guarded = [
        'user_id',
        'votable_id',
        'votable_type',
    ];

    protected $casts = [
        'type' => VoteType::class,
    ];

    /**
     * Get the owning votable model.
     */
    public function votable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
