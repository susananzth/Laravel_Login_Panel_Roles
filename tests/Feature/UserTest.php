<?php

use App\Http\Livewire\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;

test('it shows user list', function () {
    $this->actingAs(User::find(1));

    $response = $this->get(route('users'));

    $response->assertOk();
});
/*
test('it can create a user', function () {
    $this->actingAs(User::find(1));

    $email = Str::random(10).'@gmail.com';

    $response = Livewire::test(Users::class)
        ->set('name', fake()->name())
        ->set('email', $email)
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('store');

    $this->assertTrue(User::where('email', $email)->exists());
});

test('it can update a user', function () {
    $this->actingAs(User::find(1));

    $user  = user::inRandomOrder()->first();
    $email = Str::random(10).'@gmail.com';

    Livewire::test(Users::class)
        ->set('user_id', $user->id)
        ->set('name', fake()->name())
        ->set('email', $email)
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('update');

    $this->assertTrue(User::whereEmail($email)->exists());
});

test('it can delete a user', function () {
    $this->actingAs(User::find(1));

    $user = User::latest()->first();
    Livewire::test(Users::class)
        ->set('user_id', $user->id)
        ->call('setDeleteId')
        ->call('delete');
});*/