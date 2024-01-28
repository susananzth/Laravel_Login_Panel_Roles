<?php

namespace Tests\Feature\Livewire;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Roles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_exists_on_the_page()
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $this->actingAs($user);
        $this->get(route('roles'))
            ->assertSeeLivewire(Roles::class);
    }

    public function test_role_list_page_is_displayed_and_displays_roles(): void
    {
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $user->roles()->attach(1);

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->assertSee($role->title)
            ->assertStatus(200);
    }

    public function test_create_role_modal_is_displayed_with_permission(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $permission =  Permission::inRandomOrder()->first();

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->call('create')
            ->assertSee($permission->menu)
            ->assertStatus(200);
    }

    public function test_store_role_with_permission(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $permission =  Permission::inRandomOrder()->first();

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->set('title', 'Super super Admin')
            ->set('selectedPermissions', [$permission->id])
            ->call('store')
            ->assertStatus(200)
            ->assertRedirect('/role');

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->assertSee('Super super Admin')
            ->assertStatus(200);
    }

    public function test_edit_role_modal_is_displayed_with_permission(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $role = Role::factory()->create();
        $permission =  Permission::inRandomOrder()->first();

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->call('edit', $role->id)
            ->assertSee($role->title)
            ->assertSee($permission->menu)
            ->assertStatus(200);
    }

    public function test_update_role_with_permission(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $role = Role::factory()->create();
        $permission =  Permission::inRandomOrder()->first();

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->set('role_id', $role->id)
            ->set('title', 'Super super Admin')
            ->set('selectedPermissions', [$permission->id])
            ->set('status', true)
            ->call('update')
            ->assertStatus(200)
            ->assertRedirect('/role');

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->call('edit', $role->id)
            ->assertSee('title', 'Super super Admin')
            ->assertSee($permission->menu)
            ->assertStatus(200);
    }

    public function test_delete_role(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(1);

        $role = Role::factory()->create();

        Livewire::actingAs($user)
            ->test(Roles::class)
            ->set('role_id', $role->id)
            ->call('delete')
            ->assertStatus(200)
            ->assertRedirect('/role');
    }
}