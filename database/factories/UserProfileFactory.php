<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'profile_data' => [
                'city'     => $this->faker->city,
                'state'    => $this->faker->state,
                'bio'      => $this->faker->paragraph,
                'twitter'  => '@' . $this->faker->userName,
                'website'  => $this->faker->url,
            ],
        ];
    }
}
