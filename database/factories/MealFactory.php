<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Meal::class;
    public function definition(): array
    {
        return [
            //
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'prices' => json_encode([
                ['size' => '2L', 'price' => 10],
                ['size' => '3L', 'price' => 15],
                ['size' => '6L', 'price' => 25],
            ]),
        ];
    }
}
