<?php

namespace App\Listeners;

use App\Events\UserLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;


class CacheUserSettingsOnLogin implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Cache::remember('user_settings_' . $event->user->id, 60 * 60 * 24,
            function () use ($event) {
                return $event->user->with('settings')->first();
        });
    }
}
