<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $x = fake()->numberBetween(1, 10000);
        return [
            'title' => "Post " . $x,
            'desc' => "Desc " . $x,
            'user_id' => fake()->numberBetween(1, 5),
        ];
    }
}
