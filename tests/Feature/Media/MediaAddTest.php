<?php

namespace Tests\Feature\Media;

use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaAddTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_media_can_be_uploaded(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

		Storage::fake('media');

		$file = UploadedFile::fake()->image('media.jpg');

		$response = $this->post('api/v1/media', [
			'media' => $file
		]);

		Storage::disk('media')->assertExists($file->hashName());
    }
}
