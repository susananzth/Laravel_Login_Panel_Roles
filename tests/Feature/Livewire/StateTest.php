<?php

namespace Tests\Feature\Livewire;

use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\States;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StateTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('states'))
            ->assertSeeLivewire(States::class);
    }

    public function test_state_list_page_is_displayed_and_displays_states(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        State::factory()->create();
        $state = State::orderBy('name')->first();

        Livewire::actingAs($user)
            ->test(States::class)
            ->assertSee($state->name)
            ->assertStatus(200);
    }

    public function test_create_state_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(States::class)
            ->call('create')
            ->assertSee(__('Create new state'))
            ->assertStatus(200);
    }

    public function test_store_state(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();

        Livewire::actingAs($user)
            ->test(States::class)
            ->set('name', 'Nuevo')
            ->set('country_id', $country->id)
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/state');
    }

    public function test_edit_state_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $state = State::factory()->create();

        Livewire::actingAs($user)
            ->test(States::class)
            ->call('edit', $state->id)
            ->assertSee($state->name)
            ->assertStatus(200);
    }

    public function test_update_state(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $country = Country::factory()->create();
        State::factory()->create();
        $state = State::orderBy('name')->first();

        Livewire::actingAs($user)
            ->test(States::class)
            ->set('state_id', $state->id)
            ->set('name', 'Nuevo')
            ->set('country_id', $country->id)
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/state');

        Livewire::actingAs($user)
            ->test(States::class)
            ->call('edit', $state->id)
            ->assertSee('name', 'Nuevo')
            ->assertStatus(200);
    }

    public function test_delete_state(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $state = State::factory()->create();

        Livewire::actingAs($user)
            ->test(States::class)
            ->set('state_id', $state->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/state');
    }
}