<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Settings;

class CreateSettingsRecordOnUserCreation
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $settings = new Settings;
        $settings->emailNotifications = true;
        $settings->pushNotifications = true;
        $settings->darkMode = false;
        $settings->paginationSize = 5;
        $settings->timezone = 'UTC';
        $settings->user_id = $event->user->id;
        $settings->save();
    }
}
