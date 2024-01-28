<?php

namespace Tests\Feature\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Profiles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        $this->actingAs($user);
        $this->get(route('profiles'))
            ->assertSeeLivewire(Profiles::class);
    }

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->assertSee($user->first_name)
            ->assertStatus(200);
    }

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->set('user_id', $user->id)
            ->set('current_password', 'password')
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('passwordUpdate')
            ->assertStatus(200)
            ->assertRedirect('/profiles');
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->set('user_id', $user->id)
            ->set('current_password', 'wrong-password')
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('passwordUpdate')
            ->assertStatus(200)
            ->assertHasErrors('current_password');
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->set('user_id', $user->id)
            ->set('first_name', 'Nuevo')
            ->set('last_name', 'Nuevo')
            ->set('document_type_id', DocumentType::inRandomOrder()->first()->id)
            ->set('document_number', '23423423')
            ->set('phone_code_id', Country::inRandomOrder()->first()->id)
            ->set('phone', '23423423')
            ->set('email', $user->email)
            ->set('city_id', City::inRandomOrder()->first()->id)
            ->set('address', 'asdasdas')
            ->call('update')
            ->assertStatus(200)
            ->assertHasNoErrors();

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->assertSee('Nuevo')
            ->assertStatus(200);
    }

    public function test_delete_account(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->set('user_id', $user->id)
            ->set('password_delete', 'password')
            ->call('delete')
            ->assertHasNoErrors()
            ->assertRedirect('/');
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(3);

        Livewire::actingAs($user)
            ->test(Profiles::class)
            ->set('user_id', $user->id)
            ->set('password_delete', 'wrong-password')
            ->call('delete')
            ->assertHasErrors('password_delete');
    }
}