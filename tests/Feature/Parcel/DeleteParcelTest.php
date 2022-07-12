<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('parcels.destroy', ['parcel' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('parcels.destroy', ['parcel' => 1]))
        ->assertRedirect(route('parcels.index'));
});

it('asserts employee cannot delete', function () {
    actingAsEmployee()
        ->delete(route('parcels.destroy', ['parcel' => 1]))
        ->assertForbidden();
});
