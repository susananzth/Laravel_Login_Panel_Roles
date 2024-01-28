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
            'iso_2'      => fake()->randomNumber(2, true),
            'iso_3'      => fake()->randomNumber(3, true),
            'iso_number' => fake()->randomNumber(2, true),
            'phone_code' => fake()->randomNumber(2, true),
        ];
    }
}
