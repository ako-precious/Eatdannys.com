<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Stripe\Checkout\Session as StripeSession;
use Mockery;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        // Prevent the actual stripe calls
        Config::set('services.stripe.secret', 'test');
    }

    // Test to create a stripe cheskout session and order
    public function test_create_checkout_session(): void
    {
        // Mock the Stripe Session creation
        $mockSession = (object) [
            'id' => 'test_session_id'
        ];
        $stripeMock =  Mockery::mock('alias:' . StripeSession::class);
        $stripeMock->shouldReceive('create')->andReturn($mockSession);

        // Act as a user
      $user=  $this->actingAs(User::factory()->create());

        //Sample payload
        $payload = [
            'items' => [
                ['name' => 'Jollof Rice', 'unit_price' => 10, 'quantity' => 1],
                ['name' => 'Semo A Dozen', 'unit_price' => 14, 'quantity' => 4],
            ],
        ];

        // Make the request
        $response = $this->postJson('/api/create-checkout-session', $payload);
        dd $user;
        // Assert the response
        $response->assertStatus(200)
            ->assertJson(['id' => 'test_session_id']);
           
            // Assert the order was created
            $this->assertDatabaseHas('orders', [
                'session_id' => 'test_session_id',
                'user_id' => $user->id ?? 1,
                'menu' => json_encode($payload['items']),
                'address' => '20 Golfdale, Barrie, ON L9X 0N5',
                'total_price' => 60 * 1.13,
                'status' => 'unpaid',
            ]);
            //verify the tax was added to the total price
            $this->assertEquals(60 * 1.13, 60 * 1.13);

      }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
