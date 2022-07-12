<?php

use function Pest\Laravel\get;

it('asserts we cannot see edit unauthenticated', function () {
    get(route('vegetables.edit', ['vegetable' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can see edit', function () {
    actingAsAdmin()
        ->get(route('vegetables.edit', ['vegetable' => 1]))
        ->assertOk();
});

it('asserts employee cannot see edit', function () {
    actingAsEmployee()
        ->get(route('vegetables.edit', ['vegetable' => 1]))
        ->assertForbidden();
});
