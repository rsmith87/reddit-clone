<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Events\PostViewed;
use App\Events\MediaCreated;
use App\Events\UserCreated;
use App\Events\UserLogin;
use App\Events\UserLogout;
use App\Listeners\AddOneToPostViewStat;
use App\Listeners\CreateSettingsRecordOnUserCreation;
use App\Listeners\CreateStatisticsRecordOnMediaSave;
use App\Listeners\CreateStatisticsRecordOnPostSave;
use App\Listeners\DestroyUserSettingsCache;
use App\Listeners\SendMailOnPostCreated;
use App\Listeners\CacheUserSettingsOnLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MediaCreated::class => [
            CreateStatisticsRecordOnMediaSave::class,
        ],
        PostCreated::class => [
            CreateStatisticsRecordOnPostSave::class,
            SendMailOnPostCreated::class,
        ],
        PostViewed::class => [
            AddOneToPostViewStat::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        UserCreated::class => [
            CreateSettingsRecordOnUserCreation::class,
        ],
        UserLogin::class => [
            CacheUserSettingsOnLogin::class,
        ],
        UserLogout::class => [
            DestroyUserSettingsCache::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
