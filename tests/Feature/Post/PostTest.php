<?php

namespace Tests\Feature\Post;

use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_get(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('api/v1/posts');

        $response->assertSuccessful();
    }
}
