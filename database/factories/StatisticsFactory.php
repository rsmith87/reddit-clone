<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistics>
 */
class StatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'views' => fake()->numberBetween(0, 1000),
            'statisticables_id' => fake()->randomElement([Post::factory(), Media::factory()]),
            'statisticables_type' => fake()->randomElement(['App\Models\Post', 'App\Models\Media']),
        ];
    }
}
