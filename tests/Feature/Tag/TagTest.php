<?php

namespace Tests\Feature\Tag;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_tag_get(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('api/v1/tags');

        $response->assertSuccessful();
    }
}
