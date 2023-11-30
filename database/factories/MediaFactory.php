<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        $image = fake()->image(Storage::disk('public')->path('images'), 1024, 768, null, false);

        return [
            'name' => fake()->word(),
            'hash_name' => fake()->sha1(),
            'mime_type' => fake()->mimeType(),
            'extension' => fake()->fileExtension(),
            'path' => fake()->imageUrl(1024, 768, null, null, null, false, 'png'),
            'size' => mt_rand(100000000, 999999999),
            'user_id' => User::factory(),
            'blob' => fake()->image(),
        ];
    }
}
