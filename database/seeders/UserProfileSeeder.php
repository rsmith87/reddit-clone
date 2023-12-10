<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //UserProfile::factory()->count(10)->create();

        User::find(1)->userProfile()->create([
            'profile_data' => [
                'username' => 'codenut33',
                'city'     => 'Waco',
                'state'    => 'TX',
                'bio'      => 'I am a web developer.',
                'twitter'  => '@codenut33',
                'website'  => 'https://codenut.net',
            ],
        ]);
    }
}
