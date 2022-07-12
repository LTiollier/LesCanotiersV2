<?php

use function Pest\Laravel\get;

it('asserts we cannot see edit unauthenticated', function () {
    get(route('users.edit', ['user' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can see edit', function () {
    actingAsAdmin()
        ->get(route('users.edit', ['user' => 1]))
        ->assertOk();
});

it('asserts employee can see self edit', function () {
    actingAsEmployee()
        ->get(route('users.edit', ['user' => 2]))
        ->assertOk();
});

it('asserts employee cannot see other edit', function () {
    actingAsEmployee()
        ->get(route('users.edit', ['user' => 1]))
        ->assertForbidden();
});
