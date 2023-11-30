<?php

namespace Tests\Feature\Media;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

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

        $this->post('api/v1/media', [
            'file' => $file,
        ]);

        Storage::disk('local')->assertExists('images/'.$file->hashName());
    }
}
