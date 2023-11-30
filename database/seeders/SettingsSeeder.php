<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = new Settings;
        $settings->emailNotifications = true;
        $settings->pushNotifications = true;
        $settings->darkMode = false;
        $settings->paginationSize = 5;
        $settings->timezone = 'UTC';
        $settings->user_id = 1;
        $settings->save();
    }
}
