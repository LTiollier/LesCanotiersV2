<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\put;

$data = [
    'name' => 'eee',
];

it('asserts we cannot update unauthenticated', function () {
    put(route('parcels.update', ['parcel' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can update', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('parcels.update', ['parcel' => 1]), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('parcels', [
        'name' => 'eee',
    ]);
});

it('asserts employee cannot update', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('parcels.update', ['parcel' => 2]), $data)
        ->assertForbidden()
    ;
});
