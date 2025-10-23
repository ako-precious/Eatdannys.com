<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  protected $model = \App\Models\Order::class;

    public function definition(): array
    {
        return [
            //

            'session_id' => fake()->unique()->word(),
            'menu' => json_encode([
                ['name' => 'Jollof Rice', 'unit_price' => 10, 'quantity' => 1],
                ['name' => 'Semo A Dozen', 'unit_price' => 14, 'quantity' => 4],
                ['name' => 'Fried Rice', 'unit_price' => 13, 'quantity' => 3],
                ['name' => 'Efo Riro with Assorted', 'unit_price' => 12, 'quantity' => 4],
                ['name' => 'Ogbono Soup', 'unit_price' => 16, 'quantity' => 5],
                ['name' => 'Amala A Dozen', 'unit_price' => 12, 'quantity' => 3],
            ]),
            'total_price' => $this->faker->randomFloat(2, 10, 200),
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
