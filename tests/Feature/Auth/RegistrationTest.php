<?php

namespace Tests\Feature\Auth;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'first_name'       => 'Test',
            'last_name'        => 'User',
            'document_type_id' => DocumentType::inRandomOrder()->first()->id,
            'document_number'  => strval(fake()->randomNumber(8, true)),
            'city_id'          => City::inRandomOrder()->first()->id,
            'address'          => fake()->streetAddress(),
            'phone_code_id'    => Country::inRandomOrder()->first()->id,
            'phone'            => strval(fake()->randomNumber(9, true)),
            'email'            => 'test@example.com',
            'password'         => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}