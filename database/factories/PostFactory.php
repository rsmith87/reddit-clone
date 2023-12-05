<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(128, 1);
        $slug = Str::slug($title);
        return [
            'status' => PostStatus::PUBLISHED,
            'title' => $title,
            'content' => fake()->realText(300, 1),
            'user_id' => User::factory(),
            'slug' => $slug,
        ];
    }
}
