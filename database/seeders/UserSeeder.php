<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Rob',
            'email' => 'codenut33@gmail.com',
            'password' => '123123123',
        ]);
        
        User::factory()
            ->count(10)
            ->has(Settings::factory())
            ->create();
    }
}
