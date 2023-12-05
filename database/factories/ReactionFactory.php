<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
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
            'reaction' => fake()->randomElement(['like', 'dislike']),
            'reactionables_id' => fake()->randomElement([Post::factory(), Media::factory()]),
            'reactionables_type' => fake()->randomElement(['App\Models\Post', 'App\Models\Media']),
        ];
    }
}
