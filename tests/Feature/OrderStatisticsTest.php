<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Order;
use App\Models\Meal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
// use Illuminate\Foundation\Auth\User;
use Tests\TestCase;

class OrderStatisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_total_orders(): void
    {
        $this->actingAs(User::factory()->create());
        Order::factory()->count(12)->create();
        $response = $this->getJson( 'api/order-stats');
        $response->assertJsonCount(12);
    }
    
    public function test_orders_this_month(): void
    {
        $this->actingAs(User::factory()->create());
        Order::factory()->count(5)->create(['created_at' => now()]);
        Order::factory()->count(3)->create(['created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'ordersThisMonth' => 5,
            'ordersLastMonth' => 3]
            ,);
    }

    public function test_sales_statistics(): void
    {
        $this->actingAs(User::factory()->create());
        Order::factory()->count(5)->create(['status' => 'paid', 'total_price' => 100, 'created_at' => now()]);
        Order::factory()->count(3)->create([   'status' => 'paid', 'total_price' => 50, 'created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'totalSales' => 650,
            'salesThisMonth' => 500,
            'salesLastMonth' => 150]
            ,);
    }

    public function test_users_statistics(): void
    {
        $this->actingAs(User::factory()->create());
        User::factory()->count(5)->create(['created_at' => now()]);
        User::factory()->count(3)->create(['created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'totalUsers' => 9,
            'usersGrowth' => 100]
            ,);
    }

    public function test_meals_statistics(): void
    {
        $this->actingAs(User::factory()->create());
        Meal::factory()->count(6)->create(['created_at' => now()]);
        Meal::factory()->count(3)->create(['created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'totalMeals' => 9,
            'mealsGrowth' => 100]
            ,);
    }

    public function test_percent_growth(): void
    {
        $this->actingAs(User::factory()->create());
        Order::factory()->count(6)->create(['created_at' => now()]);
        Order::factory()->count(3)->create(['created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'percentGrowth' => 100]
            ,);
    }

    public function test_sales_growth(): void
    {
        $this->actingAs(User::factory()->create());
        Order::factory()->count(6)->create(['status' => 'paid', 'total_price' => 100, 'created_at' => now()]);
        Order::factory()->count(3)->create(['status' => 'paid', 'total_price' => 50, 'created_at' => now()->subMonth()]);
        $response = $this->getJson( 'api/order-stats');
        $response->assertJson([
            'salesGrowth' => 300]
            ,);
    }

}
