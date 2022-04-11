<?php

use function Pest\Laravel\get;

it('asserts we cannot see create unauthenticated', function () {
    get(route('cycles.create'))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can see create', function () {
    actingAsAdmin()
        ->get(route('cycles.create'))
        ->assertOk()
    ;
});

it('asserts employee cannot see create', function () {
    actingAsEmployee()
        ->get(route('cycles.create'))
        ->assertForbidden()
    ;
});
