<?php

use App\Models\User;
use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$data = [
    'name' => 'John Doe',
    'email' => 'johndoe@gmail.com',
    'password' => 'secret',
    'password_confirmation' => 'secret',
    'role' => User::EMPLOYEE_ROLE,
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('users.store'), $data)
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('users.store'), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
});

it('asserts employee cannot store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('users.store'), $data)
        ->assertForbidden()
    ;
});
