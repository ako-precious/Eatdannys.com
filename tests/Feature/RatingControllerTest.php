<?php

namespace Tests\Feature;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
     use WithFaker;

     public function test_rate_meal(): void
    {
        $user = User::factory()->create();
        $meal = Meal::factory()->create();
        $rating = $this->faker->numberBetween(1, 5);
        $this->actingAs($user);
        $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $rating,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('meal_ratings', [
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $rating,
        ]);

    }

    public function test_update_rating(): void
    {
        $user = User::factory()->create();
        $meal = Meal::factory()->create();
        $rating = $this->faker->numberBetween(1, 5);
        $this->actingAs($user);
        $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $rating,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('meal_ratings', [
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $rating,
        ]);
        $newRating = $this->faker->numberBetween(1, 5);
        $response = $this->postJson("/meals/{$meal->id}/rate", [
            'rating' => $newRating,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('meal_ratings', [
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $newRating,
        ]);
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
