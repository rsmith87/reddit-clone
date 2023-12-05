<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Statistics extends Model
{
    use HasFactory;

    public $guarded = [
        'views',
        'statisticable_id',
        'statisticable_type',
    ];

    public function statisticable(): MorphTo
    {
        return $this->morphTo();
    }
}
