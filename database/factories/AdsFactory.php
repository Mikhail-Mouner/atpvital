<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['free', 'paid']),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'start_date' => $this->faker->dateTime(),
            'advertiser' => User::inRandomOrder()->first()->id,
        ];
    }
}
