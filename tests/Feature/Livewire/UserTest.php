<?php

namespace Tests\Feature\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        $this->actingAs($admin);
        $this->get(route('users'))
            ->assertSeeLivewire(Users::class);
    }

    public function test_user_list_page_is_displayed_and_displays_users(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        $user = User::factory()->create([
            'first_name' => 'Aanna'
        ]);

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->assertSee($user->first_name)
            ->assertStatus(200);
    }

    public function test_create_user_modal_is_displayed(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->call('create')
            ->assertSee(__('Create new user'))
            ->assertStatus(200);
    }

    public function test_store_user(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->set('first_name', fake()->firstName())
            ->set('last_name', fake()->lastName())
            ->set('image', '')
            ->set('document_type_id', DocumentType::inRandomOrder()->first()->id)
            ->set('document_number', strval(fake()->randomNumber(8, true)))
            ->set('city_id', City::inRandomOrder()->first()->id)
            ->set('address', fake()->streetAddress())
            ->set('phone_code_id', Country::inRandomOrder()->first()->id)
            ->set('phone', strval(fake()->randomNumber(8, true)))
            ->set('email', 'nuevo@gmail.com')
            ->set('password', 'password')
            ->call('store')
            ->assertStatus(200);
    }

    public function test_edit_user_modal_is_displayed(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->call('edit', $user->id)
            ->assertSee($user->first_name)
            ->assertStatus(200);
    }

    public function test_update_user(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->set('user_id', $user->id)
            ->set('first_name', 'Aana')
            ->set('last_name', 'Nuevo')
            ->set('image', '')
            ->set('document_type_id', 1)
            ->set('document_number', '123123123')
            ->set('city_id', 1)
            ->set('address', 'Calle')
            ->set('phone_code_id', 1)
            ->set('phone', '123123')
            ->set('email', 'nuevo@gmail.com')
            ->set('password', 'password')
            ->set('status', true)
            ->call('update')
            ->assertStatus(200);

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->call('edit', $user->id)
            ->assertSee('first_name', 'Aana')
            ->assertSee('last_name', 'Nuevo')
            ->assertSee('image', '')
            ->assertSee('document_type_id', 1)
            ->assertSee('document_number', '123123123')
            ->assertSee('city_id', 1)
            ->assertSee('address', 'Calle')
            ->assertSee('phone_code_id', 1)
            ->assertSee('phone', '123123')
            ->assertSee('email', 'nuevo@gmail.com')
            ->assertSee('status', true)
            ->assertStatus(200);
    }

    public function test_delete_user(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(1);

        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->set('user_id', $user->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/user');
    }
}