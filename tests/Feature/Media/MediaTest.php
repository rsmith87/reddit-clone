<?php

namespace Tests\Feature\Media;

use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
