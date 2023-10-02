<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mime_type' => fake()->mimeType(),
            'extension' => fake()->fileExtension(),
            'path' => fake()->imageUrl(1024, 768, null, null, null, false, 'png'),
            'size' => mt_rand(100000000,999999999),
        ];
    }
}
