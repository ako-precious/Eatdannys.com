<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use App\Models\Meal;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
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
   

    public function test_bulk_meals()
    {
        $category = Category::factory()->create(['order_type' => 'bulk']);
        Meal::factory()->count(3)->create(['category_id' => $category->id]);

        $response = $this->getJson('/api/meal?per_page=2');

        $response->assertStatus(200)
            ->assertJsonStructure(['meals' => ['data']]);
    }
    public function test_get_dine_in_meals(): void
    {
        $category = Category::factory()->create(['order_type' => 'dine-in']);
        Meal::factory()->count(3)->create(['category_id' => $category->id]);

        $response = $this->getJson('/api/meal?per_page=2');

        $response->assertStatus(200)
            ->assertJsonStructure(['meals' => ['data']]);
    }

    public function test_edit_meal(): void
    {
        $category = Category::factory()->create();
        $meal = Meal::factory()->create(['category_id' => $category->id]);
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->postJson("/meals/{$meal->id}", [
            'name' => 'test',
            'category_id' => $category->id,
            'description' => 'test',
            'prices' => json_encode([['size' => 'test', 'price' => 10]]),
            'images' => [$file],
        ]);



        $response = $this->getJson("/meals/{$meal->id}/edit");


        $response->assertStatus(200);
        // Storage::disk('public')->assertExists('mealimages/' . $file->hashName());
    }
    public function testonly_admin_can_create_meal(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $category = Category::factory()->create(['order_type' => 'bulk']);
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->postJson("/meals", [
            'name' => 'test',
            'category_id' => $category->id,
            'description' => 'test',
            'prices' => json_encode([['size' => 'test', 'price' => 10]]),
            'images' => [$file],
        ]);

        $response->assertStatus(200);
        Storage::disk('public')->assertExists('meal_images/' . $file->hashName());
    }

    public function testonly_admin_can_delete_meal(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));
        $category = Category::factory()->create();
        $meal = Meal::factory()->create(['category_id' => $category->id]);
        $response = $this->deleteJson("/meals/{$meal->id}");
        $response->assertStatus(200);
    }

    public function test_user_cannot_delete_meal(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'user']));
        $category = Category::factory()->create();
        $meal = Meal::factory()->create(['category_id' => $category->id]);
        $response = $this->deleteJson("/meals/{$meal->id}");
        $response->assertStatus(403);
    }
}
