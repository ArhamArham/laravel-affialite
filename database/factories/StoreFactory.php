<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class StoreFactory extends Factory
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
            'category_id'       => Category::inRandomOrder()->first()->id,
            'name'              => $this->faker->name,
            'heading'           => $this->faker->paragraph(1),
            'short_description' => $this->faker->text,
            'long_description'  => $this->faker->paragraph(5, 12),
            'image'             => "faker",
            'image_alt'         => $this->faker->text(10),
            'direct_url'        => $this->faker->url(),
            'tracking_url'      => $this->faker->url(),
        ];
    }
}
