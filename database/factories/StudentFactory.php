<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni'=>fake()->unique()->numberBetween(20000000, 50000000),
            'name'=>fake()->name(),
            'lastname'=>fake()->lastName(),
            'Birthdate'=>fake()->date(),
            'cluster'=>fake()->randomElement(['A', 'B']),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
