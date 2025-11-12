<?php

namespace Tests\Feature;
use App\Models\Rating;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class RatingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
     use WithFaker;

     public function test_create_update_rating(): void
    {
        $user = User::factory()->create();
        $meal = Meal::factory()->create();
        $ratings = $this->faker->numberBetween(1, 5);
        $this->actingAs($user);

        $rating = Rating::updateOrCreate(
            ['user_id' => $user->id, 'meal_id' => $meal->id],
            ['rating' => $ratings]
        );
        $rating->save();
        $this->assertDatabaseHas('ratings', [
            'id' => $rating->id,
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $rating->rating,
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $ratings,
        ]);
        $response->assertStatus(200);


    

    }
 public function test_create_rating_without_hitting_database()
{
    // Arrange
    $user = User::factory()->create();
    $meal = Meal::factory()->create();
    $ratingValue = $this->faker->numberBetween(1, 5);
    $this->actingAs($user);
$existingRating = null; 

    // Mock static Eloquent call
    $mock = Mockery::mock('overload:App\\Models\\Rating');
    $mock->shouldReceive('updateOrCreate')
        ->once()
        ->with(
            ['user_id' => $user->id, 'meal_id' => $meal->id],
            ['rating' => $ratingValue]
        )
        ->andReturn((object)['rating' => $ratingValue]);

    // Act
    //  dd( "/meals/{$meal->id}/ {$user->id}");
  
    // Assert
      $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $ratingValue,
        ]);
        $response->assertStatus(200);
}

  

    public function test_rating_must_be_between_1_and_5(): void
    {
        $user = User::factory()->create();
        $meal = Meal::factory()->create();
        $rating = $this->faker->numberBetween(6, 10);
        $this->actingAs($user);
        $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $rating,
        ]);
        $response->assertStatus(422);
    }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
