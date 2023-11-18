<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostStatistics>
 */
class PostStatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $number = fake()->numberBetween(1, 10);
        $views = fake()->numberBetween(1000, 100000);
        $upvote = fake()->numberBetween(100, 1000);
        $downvote = fake()->numberBetween(1, 100);

        return [
            'post_id' => Post::factory(),
            'view_count' => $views,
            'upvote_count' => $upvote,
            'downvote_count' => $downvote,
        ];
    }
}
