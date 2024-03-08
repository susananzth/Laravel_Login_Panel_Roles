<?php

namespace Tests\Feature\Auth;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Http\Livewire\Auth\RegisterUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertSeeLivewire(RegisterUser::class);
    }

    public function test_new_users_can_register(): void
    {
        Livewire::test(RegisterUser::class)
            ->set('first_name', fake()->firstName())
            ->set('last_name', fake()->lastName())
            ->set('document_type_id', DocumentType::inRandomOrder()->first()->id)
            ->set('document_number', strval(fake()->randomNumber(8, true)))
            ->set('phone_code_id', Country::inRandomOrder()->first()->id)
            ->set('phone', strval(fake()->randomNumber(8, true)))
            ->set('email', 'nuevo@gmail.com')
            ->set('city_id', City::inRandomOrder()->first()->id)
            ->set('address', fake()->streetAddress())
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('store')
            ->assertStatus(200)
            ->assertHasNoErrors()
            ->assertRedirect(RouteServiceProvider::HOME);
    }
}