<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
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

    public function test_get_admin_orders(): void
    {
       $admin = User::factory()->create(['role' => 'admin']);
        $orders = Order::factory()->count(5)->create();

        Sanctum::actingAs($admin, ['*']);

        $response = $this->getJson('/api/get-orders');

        $response->assertStatus(200)
            ->assertJsonStructure(['orders' => ['data']])
            ->assertJsonCount(5, 'orders.data');
    }

    public function test_get_user_orders(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $orders = Order::factory()->count(5)->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/get-orders');

        $response->assertStatus(200)
            ->assertJsonStructure(['orders' => ['data']])
            ->assertJsonCount(5, 'orders.data');
    }

    public function test_get_user_orders_unauthenticated(): void
    {
        $response = $this->getJson('/api/get-orders');

        $response->assertStatus(401);
    } 
     public function test_returns_paginated_orders(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $orders = Order::factory()->count(15)->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/get-orders');

        $response->assertStatus(200)
            ->assertJsonStructure(['orders' => ['data']])
            ->assertJsonCount(10, 'orders.data');
    }
}
 