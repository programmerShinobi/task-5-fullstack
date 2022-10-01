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
            'title' => $this->faker->text(100),
            'content' => $this->faker->paragraphs(25, true),
            'image' => "default.jpg",
            'status' => $this->faker->randomElement(['publish', 'draft', 'trash']),
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'user_id' => $this->faker->numberBetween(1, User::count())
        ];
    }
}
