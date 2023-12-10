<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Settings;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name'     => 'Rob',
            'username' => 'codenut',
            'email'    => 'codenut33@gmail.com',
            'password' => '123123123',
        ]);
        
        User::factory()
            ->count(10)
            ->has(Settings::factory())
            ->has(UserProfile::factory())
            ->create();
    }
}
