<?php

namespace Tests\Feature\Livewire;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Currencies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('currencies'))
            ->assertSeeLivewire(Currencies::class);
    }

    public function test_currency_list_page_is_displayed_and_displays_currencies(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $currency = Currency::factory()->create();

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->assertSee($currency->name)
            ->assertStatus(200);
    }

    public function test_create_currency_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->call('create')
            ->assertSee(__('Create new currency'))
            ->assertStatus(200);
    }

    public function test_store_currency(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->set('name', 'Nuevo')
            ->set('iso_4', '1244')
            ->set('symbol', '12')
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/currency');

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->assertSee('Nuevo')
            ->assertStatus(200);
    }

    public function test_edit_currency_modal_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $currency = Currency::factory()->create();

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->call('edit', $currency->id)
            ->assertSee($currency->name)
            ->assertStatus(200);
    }

    public function test_update_currency(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $currency = Currency::factory()->create();

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->set('currency_id', $currency->id)
            ->set('name', 'Nuevo')
            ->set('iso_4', '1244')
            ->set('symbol', '12')
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/currency');

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->call('edit', $currency->id)
            ->assertSee('name', 'Nuevo')
            ->assertSee('iso_4', '1244')
            ->assertSee('symbol', '12')
            ->assertStatus(200);
    }

    public function test_delete_currency(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $currency = Currency::factory()->create();

        Livewire::actingAs($user)
            ->test(Currencies::class)
            ->set('currency_id', $currency->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/currency');
    }
}