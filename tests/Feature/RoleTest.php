<?php

use App\Http\Livewire\Roles;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;

test('it shows role list', function () {
    $this->actingAs(User::find(1));

    $response = $this->get(route('roles'));

    $response->assertOk();
});

test('it can create a role', function () {
    $this->actingAs(User::find(1));

    $title = fake()->text(15);

    $response = Livewire::test(Roles::class)
        ->set('selectedPermissions', Permission::inRandomOrder()->take(5)->pluck('id')->all())
        ->set('title', $title)
        ->call('store');

    $this->assertTrue(Role::where('title', $title)->exists());
});

test('it can update a role', function () {
    $this->actingAs(User::find(1));

    $role = Role::where('id', '<>', 2)->inRandomOrder()->first();
    $title = fake()->text(15);

    Livewire::test(Roles::class)
        ->set('role_id', $role->id)
        ->set('selectedPermissions', Permission::inRandomOrder()->take(5)->pluck('id')->all())
        ->set('title', $title)
        ->call('update');

    $this->assertTrue(Role::where('title', $title)->exists());
});

test('it can delete a role', function () {
    $this->actingAs(User::find(1));

    $role = Role::latest()->first();
    Livewire::test(Roles::class)
        ->set('role_id', $role->id)
        ->call('setDeleteId', $role->id)
        ->call('delete');

    $this->assertModelMissing($role);
});