<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_user_can_create_place(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/places', [
                'name' => 'Parque Ibirapuera',
                'type' => 'parque',
                'city' => 'São Paulo',
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Parque Ibirapuera']);
    }
}
