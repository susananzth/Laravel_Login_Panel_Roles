<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'        => fake()->firstName(),
            'last_name'         => fake()->lastName(),
            'document_type_id'  => DocumentType::inRandomOrder()->first()->id,
            'document_number'   => strval(fake()->randomNumber(8, true)),
            'city_id'           => City::inRandomOrder()->first()->id,
            'address'           => fake()->streetAddress(),
            'phone_code_id'     => Country::inRandomOrder()->first()->id,
            'phone'             => strval(fake()->randomNumber(9, true)),
            'email'             => Str::random(10).'@gmail.com',
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
            'status'            => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
