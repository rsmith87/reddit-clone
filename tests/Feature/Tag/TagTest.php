<?php

namespace Tests\Feature\Tag;

use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
