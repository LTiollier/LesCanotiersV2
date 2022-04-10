<?php

use function Pest\Laravel\get;

it('asserts we cannot see edit unauthenticated', function () {
    get(route('times.edit', ['time' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can see edit', function () {
    actingAsAdmin()
        ->get(route('times.edit', ['time' => 1]))
        ->assertOk()
    ;
});

it('asserts employee can see edit', function () {
    actingAsEmployee()
        ->get(route('times.edit', ['time' => 2]))
        ->assertOk()
    ;
});

it('asserts admin can see edit other', function () {
    actingAsAdmin()
        ->get(route('times.edit', ['time' => 2]))
        ->assertOk()
    ;
});

it('asserts employee cannot see edit other', function () {
    actingAsEmployee()
        ->get(route('times.edit', ['time' => 1]))
        ->assertForbidden()
    ;
});
