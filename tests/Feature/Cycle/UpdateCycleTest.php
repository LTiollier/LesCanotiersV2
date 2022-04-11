<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\put;

$data = [
    'starts_at' => '2019-01-01',
    'ends_at' => '2020-02-02',
    'vegetable' => ['id' => 1],
    'parcel' => ['id' => 1],
];

it('asserts we cannot update unauthenticated', function () {
    put(route('cycles.update', ['cycle' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can update', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('cycles.update', ['cycle' => 1]), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('cycles', [
        'starts_at' => '2019-01-01',
        'ends_at' => '2020-02-02',
        'vegetable_id' => 1,
        'parcel_id' => 1,
    ]);
});

it('asserts employee cannot update', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('cycles.update', ['cycle' => 1]), $data)
        ->assertForbidden()
    ;
});
