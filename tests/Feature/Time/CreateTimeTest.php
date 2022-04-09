<?php

use function Pest\Laravel\get;

it('asserts we cannot see create unauthenticated', function () {
    get(route('times.create'))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can see create', function () {
    actingAsAdmin()
        ->get(route('times.create'))
        ->assertOk()
    ;
});

it('asserts employee can see create', function () {
    actingAsEmployee()
        ->get(route('times.create'))
        ->assertOk()
    ;
});
