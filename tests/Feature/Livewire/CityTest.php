<?php

namespace Tests\Feature\Livewire;

use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Cities;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('cities'))
            ->assertSeeLivewire(Cities::class);
    }

    public function test_city_list_page_is_displayed_and_displays_cities(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        City::factory()->create();
        $city = City::orderBy('name')->first();

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->assertSee($city->name)
            ->assertStatus(200);
    }

    public function test_create_city_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->call('create')
            ->assertSee(__('Create new city'))
            ->assertStatus(200);
    }

    public function test_store_city(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $state = State::factory()->create();

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->set('name', 'Nuevo')
            ->set('state_id', $state->id)
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/city');
    }

    public function test_edit_city_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $city = City::factory()->create();

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->call('edit', $city->id)
            ->assertSee($city->name)
            ->assertStatus(200);
    }

    public function test_update_city(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $state = State::factory()->create();
        City::factory()->create();
        $city = City::orderBy('name')->first();

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->set('city_id', $city->id)
            ->set('name', 'Nuevo')
            ->set('state_id', $state->id)
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/city');

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->call('edit', $city->id)
            ->assertSee('name', 'Nuevo')
            ->assertStatus(200);
    }

    public function test_delete_city(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $city = City::factory()->create();

        Livewire::actingAs($user)
            ->test(Cities::class)
            ->set('city_id', $city->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/city');
    }
}