<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LighthouseApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the /test-lighthouse endpoint for valid input.
     */
    public function test_lighthouse_endpoint_with_valid_input()
    {
        // Simulate authentication with a Sanctum token
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'sanctum');

        // Make a POST request with valid data
        $response = $this->postJson('/api/test-lighthouse', [
            'url' => 'https://moveme.pk/',
            'platform' => 'Desktop',
        ]);

        // Assert the response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'performance_score',
        ]);
    }

    /**
     * Test the /test-lighthouse endpoint for invalid input.
     */
    public function test_lighthouse_endpoint_with_invalid_input()
    {
        // Simulate authentication with a Sanctum token
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'sanctum');

        // Make a POST request with invalid data
        $response = $this->postJson('/api/test-lighthouse', [
            'url' => 'invalid-url',
            'platform' => 'Desktop',
        ]);

        // Assert the response
        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['url']);
    }

    /**
     * Test the /test-lighthouse endpoint without authentication.
     */
    public function test_lighthouse_endpoint_without_authentication()
    {
        // Make a POST request without authentication
        $response = $this->postJson('/api/test-lighthouse', [
            'url' => 'https://moveme.pk/',
            'platform' => 'Desktop',
        ]);

        // Assert the response
        $response->assertStatus(401); // Unauthorized
    }
}
