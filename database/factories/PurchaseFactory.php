<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'amount' => fake()->numberBetween(10000, 2500000),
            'purchase_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'provider' => fake()->optional()->company(),
            'payment_method' => fake()->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
        ];
    }
}
