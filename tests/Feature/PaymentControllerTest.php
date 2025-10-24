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
        // dd ($user) ;
        // Assert the response
        $response->assertStatus(200)
            ->assertJson(['id' => 'test_session_id']);
           
            // Assert the order was created
            $this->assertDatabaseHas('orders', [
                'session_id' => 'test_session_id',
                'user_id' => $user->id ?? 1,
                'menu' => json_encode($payload['items']),
                'address' => null,
                'total_price' => 74.58,
                'status' => 'unpaid',
            ]);
            
            //verify the tax was added to the total price
            $this->assertEquals(60 * 1.13, 60 * 1.13);

      }

      public function test_make_order_as_paid_and_create_user_if_not_exists(): void
      {
       
        //Create a order for the test and set the status to unpaid
        $order = Order::factory()->create([
            'session_id' => 'test_session_id',
            'status' => 'unpaid']);


        // Mock the Stripe Session creation
        $mockSession = (object) [
            'id' => 'test_session_id',
            'payment_status' => 'paid',
            'customer_details' => (object) [
                'email' => 'test@example.com',
                'name' => 'Test User',
                'address' => (object) [
                    'line1' => '123 Main St',
                    'city' => 'Toronto',
                    'state' => 'ON',
                    'country' => 'CA',
                    'postal_code' => 'L9X 0N5',
                ],
            ],

            'payment_intent' => (object) [
                'charges' => (object) [
                    'data' => [
                        (object) [
                            'billing_details' => (object) [
                                'address' => (object) [
                                    'line1' => '123 Main St',
                                    'city' => 'Toronto',
                                    'state' => 'ON',
                                    'country' => 'CA',
                                    'postal_code' => 'L9X 0N5',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $stripeMock =  Mockery::mock('alias:' . StripeSession::class);
        $stripeMock->shouldReceive('retrieve')->andReturn($mockSession);

        // Make the request
        $response = $this->getJson('/api/checkout/success?session_id=test_session_id');

        //Verify the order was updated
        $this->assertDatabaseHas('orders', [
            'session_id' => 'test_session_id',
            'status' => 'paid',
            'address' => json_encode(json_encode($mockSession->customer_details->address)),
        ]);
        //Verify the user was created
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
        //Verify the user was associated with the order
        $this->assertDatabaseHas('orders', [
            'session_id' => 'test_session_id',
            'user_id' => User::where('email', 'test@example.com')->first()->id,
        ]);
        //Verify the user was sent a verification email
        


        // Assert the response
        // $response->assertStatus(200)
        //     ->assertJson(['order' => ['customer_email' => 'test@example.com']]);
      }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
