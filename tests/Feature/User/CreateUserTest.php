<?php

use function Pest\Laravel\get;

it('asserts we cannot see create unauthenticated', function () {
    get(route('users.create'))
        ->assertRedirect(route('login'));
});

it('asserts admin can see create', function () {
    actingAsAdmin()
        ->get(route('users.create'))
        ->assertOk();
});

it('asserts employee cannot see create', function () {
    actingAsEmployee()
        ->get(route('users.create'))
        ->assertForbidden();
});
