<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */ 
    

    public function definition(): array
    {
        return [
            //
            'name' => fake()->word(),
            'order_type' => fake()->randomElement(['bulk', 'dine-in']),            
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
