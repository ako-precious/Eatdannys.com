<?php

namespace Tests\Feature;

use App\Models\Meal;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MealTest extends TestCase
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
    public function test_get_meals(): void
    {
        $this->actingAs(User::factory()->create());
        $category = Category::factory()->create(['order_type' => 'bulk']);
        Meal::factory()->count(3)->create(['category_id' => $category->id]);

        $response = $this->getJson('/api/meals?per_page=2');

        $response->assertStatus(200)
            ->assertJsonStructure(['meals' => ['data']]);
    }
   
    public function test_search_meals(): void
    {
        $response = $this->get('/api/meal?search=chicken');

        $response->assertStatus(200);
    }
}
