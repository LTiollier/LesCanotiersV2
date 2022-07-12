<?php

use function Pest\Laravel\get;

it('asserts we cannot see index unauthenticated', function () {
    get(route('times.index'))
        ->assertRedirect(route('login'));
});

it('asserts admin can see index', function () {
    actingAsAdmin()
        ->get(route('times.index'))
        ->assertOk();
});

it('asserts employee can see index', function () {
    actingAsEmployee()
        ->get(route('times.index'))
        ->assertOk();
});
