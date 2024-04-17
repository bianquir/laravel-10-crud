<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'=>fake()->unique()->numberBetween(1000, 9000),
            'name'=>fake()->unique()->word(),
            'quantity'=>fake()->numberBetween(1, 1000),
            'price'=>fake()->numberBetween(1000, 10000),
            'description'=>fake()->paragraph(),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
