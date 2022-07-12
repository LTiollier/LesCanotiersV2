<?php

use function Pest\Laravel\get;

it('asserts we cannot see edit unauthenticated', function () {
    get(route('parcels.edit', ['parcel' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can see edit', function () {
    actingAsAdmin()
        ->get(route('parcels.edit', ['parcel' => 1]))
        ->assertOk();
});

it('asserts employee cannot see edit', function () {
    actingAsEmployee()
        ->get(route('parcels.edit', ['parcel' => 1]))
        ->assertForbidden();
});
