<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'       => $uId = User::inRandomOrder()->first()->id,
            'store_id'      => Store::where('user_id', $uId)->inRandomOrder()->first()->id,
            'offer_box'     => $this->faker->name,
            'offer_details' => $this->faker->text,
            'tracking_link' => $this->faker->url,
            'expiry_date'   => $this->faker->date(),
            'type'          => $type = $this->faker->randomElement(['deal', 'code']),
            'code'          => $type == 'code' ? Str::random() : null,
        ];
    }
}
