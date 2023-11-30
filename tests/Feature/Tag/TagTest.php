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

    /**
     * Test tag create.
     */
    public function test_tag_create(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post('api/v1/tags', [
            'name' => 'Test Tag',
        ]);

        $response->assertStatus(201);
    }

    /**
     * Text getting a single tag.
     */
    public function test_tag_get_single(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post('api/v1/tags', [
            'name' => 'Test Tag',
        ]);

        $response = $this->get('api/v1/tags/test-tag');

        $response->assertSuccessful();
    }

    /**
     * Test tag update.
     */
    public function test_tag_update(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post('api/v1/tags', [
            'name' => 'Test Tag',
        ]);

        $response = $this->patch('api/v1/tags/test-tag', [
            'name' => 'Test Tag 2',
        ]);

        $response->assertSuccessful();
    }

    /**
     * Test tag delete.
     */
    public function test_tag_delete(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post('api/v1/tags', [
            'name' => 'Test Tag',
        ]);

        $response = $this->delete('api/v1/tags/test-tag');

        $response->assertSuccessful();
    }
}
