<?php

namespace Tests\Feature;

use App\Models\Order;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderStatisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_total_orders(): void
    {
        Order::factory()->count(5)->create();
        $response = $this->getJson( 'admin/order-stats');
       
        $response->assertJsonCount(5);
    }
}
