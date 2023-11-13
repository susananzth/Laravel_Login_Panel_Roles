<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => fake()->text(25),
            'iso_2'      => fake()->text(2),
            'iso_3'      => fake()->text(3),
            'iso_number' => fake()->randomNumber(2, true),
            'phone_code' => fake()->randomNumber(2, true),
        ];
    }
}
