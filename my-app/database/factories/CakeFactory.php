<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->unique()->word(),
            'price' => fake()->numberBetween(1000, 3000)
        ];
    }
}
