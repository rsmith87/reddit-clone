<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_post_create(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        // May need to create a plainTextToken
        $post = Post::factory()->create();

        $this->assertModelExists($post);

    }

    public function test_post_api_get(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('api/v1/posts');

        $response->assertSuccessful();
    }

    public function test_post_api_post(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $post = Post::factory()->create();

        $response = $this->post('api/v1/posts', [
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $post->slug,
            'user_id' => $post->user_id,
        ]);

        $response->assertStatus(200);
    }

    public function test_post_not_authenticated_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->post('api/v1/posts', [
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $post->slug,
            'user_id' => $post->user_id,
        ]);

        $response->assertStatus(405);
    }
}
