<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
   public function test_get_orders(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));
        $response = $this->get('/api/get-orders');

        $response->assertStatus(200);
    }
}
