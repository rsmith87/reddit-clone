<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class SettingsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_user_settings(): void
    {
        
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('api/v1/auth');

        $response->assertStatus(200);
    }
}
