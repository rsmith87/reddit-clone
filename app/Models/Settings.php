<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'emailNotifications',
        'pushNotifications',
        'paginationSize',
        'darkMode',
        'timezone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'emailNotifications' => 'boolean',
        'pushNotifications'  => 'boolean',
        'darkMode'           => 'boolean',
        'user_id'            => 'integer',
        'timezone'           => 'string',
    ];

    /**
     * Get the user that owns the settings.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the email notifications setting.
     */
    public function getEmailNotificationsAttribute(): bool
    {
        return $this->attributes['emailNotifications'];
    }

    /**
     * Set the email notifications setting.
     */
    public function setEmailNotificationsAttribute(bool $value): void
    {
        $this->attributes['emailNotifications'] = $value;
    }
}
