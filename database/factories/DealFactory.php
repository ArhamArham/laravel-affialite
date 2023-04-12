<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class DealFactory extends Factory
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
            'title'             => $this->faker->title,
            'short_description' => $this->faker->text,
            'long_description'  => $this->faker->paragraph(5, 12),
        ];
    }
}
