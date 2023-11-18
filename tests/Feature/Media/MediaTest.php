<?php

namespace Tests\Feature\Media;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MediaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_media_get(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('api/v1/media');

        $response->assertSuccessful();
    }
}
