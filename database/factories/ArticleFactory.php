<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'author' => $this->faker->name,
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'marks' => $this->faker->randomNumber(3),
            'published' => $this->faker->boolean
        ];
    }
}
