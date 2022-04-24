<?php

use App\Models\User;
use function Pest\Laravel\put;

$data = [
    'name' => 'John Doe',
    'email' => 'johndoe@gmail.com',
    'password' => 'secret',
    'password_confirmation' => 'secret',
    'role' => User::EMPLOYEE_ROLE,
];

it('asserts we cannot update unauthenticated', function () {
    put(route('users.update', ['user' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can update other', function () use ($data) {
    actingAsAdmin()
        ->put(route('users.update', ['user' => 2]), $data)
        ->assertRedirect(route('users.edit', ['user' => 2]))
    ;

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
});

it('asserts admin can self update', function () use ($data) {
    actingAsAdmin()
        ->put(route('users.update', ['user' => 1]), $data)
        ->assertRedirect(route('users.edit', ['user' => 1]))
    ;

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
});

it('asserts employee cannot update other', function () use ($data) {
    actingAsEmployee()
        ->put(route('users.update', ['user' => 1]), $data)
        ->assertForbidden()
    ;
});

it('asserts employee can self update', function () use ($data) {
    actingAsEmployee()
        ->put(route('users.update', ['user' => 2]), $data)
        ->assertRedirect(route('users.edit', ['user' => 2]))
    ;

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
});

it('asserts employee cannot update role', function () use ($data) {
    $data['role'] = User::ADMIN_ROLE;

    actingAsEmployee()
        ->put(route('users.update', ['user' => 2]), $data)
        ->assertRedirect(route('users.edit', ['user' => 2]))
    ;

    $this->assertTrue(employee()->hasExactRoles([User::EMPLOYEE_ROLE]));
});
