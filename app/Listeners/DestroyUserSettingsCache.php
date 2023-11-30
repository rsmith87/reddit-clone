<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class DestroyUserSettingsCache
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $userSettings = Cache::forget('user_settings_' . $event->user->id);
    }
}
