<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'           => User::inRandomOrder()->first()->id,
            'blog_category_id'  => BlogCategory::inRandomOrder()->first()->id,
            'title'             => $this->faker->title,
            'short_description' => $this->faker->text,
            'long_description'  => $this->faker->paragraph(5, 12),
            'image'             => "faker",
            'image_alt'         => $this->faker->text(10),
        ];
    }
}
