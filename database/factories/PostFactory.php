<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'content' => $this->faker->paragraphs(25, true),
            'category' => $this->faker->unique()->streetSuffix(10),
            'status' => $this->faker->randomElement(['publish', 'draft', 'trash']),
        ];
    }
}
