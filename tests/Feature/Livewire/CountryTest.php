<?php

namespace Tests\Feature\Livewire;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Countries;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('countries'))
            ->assertSeeLivewire(Countries::class);
    }

    public function test_country_list_page_is_displayed_and_displays_countries(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->assertSee($country->name)
            ->assertStatus(200);
    }

    public function test_create_country_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->call('create')
            ->assertSee(__('Create new country'))
            ->assertStatus(200);
    }

    public function test_store_country(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->set('name', 'Nuevo')
            ->set('iso_2', '12')
            ->set('iso_3', '12')
            ->set('iso_number', '123')
            ->set('phone_code', '123')
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/country');

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->assertSee('Nuevo')
            ->assertStatus(200);
    }

    public function test_edit_country_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->call('edit', $country->id)
            ->assertSee($country->name)
            ->assertStatus(200);
    }

    public function test_update_country(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->set('country_id', $country->id)
            ->set('name', 'Nuevo')
            ->set('iso_2', '12')
            ->set('iso_3', '12')
            ->set('iso_number', '123')
            ->set('phone_code', '123')
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/country');

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->call('edit', $country->id)
            ->assertSee('name', 'Nuevo')
            ->assertSee('iso_2', '12')
            ->assertSee('iso_3', '12')
            ->assertSee('iso_number', '123')
            ->assertSee('phone_code', '123')
            ->assertStatus(200);
    }

    public function test_delete_country(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();

        Livewire::actingAs($user)
            ->test(Countries::class)
            ->set('country_id', $country->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/country');
    }
}