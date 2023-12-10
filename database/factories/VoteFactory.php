<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vote' => $this->faker->randomElement(['upvote', 'downvote']),
            'user_id' => User::factory(),
            'votable_id' => $this->faker->numberBetween(1, 10),
            'votable_type' => $this->faker->randomElement(['App\Models\Post', 'App\Models\Comment', 'App\Models\Media']),
        ];
    }
}
