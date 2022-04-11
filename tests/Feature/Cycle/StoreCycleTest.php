<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$data = [
    'starts_at' => '2019-01-01',
    'ends_at' => '2020-02-02',
    'vegetable' => ['id' => 1],
    'parcel' => ['id' => 1],
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('cycles.store'), $data)
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('cycles.store'), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('cycles', [
        'starts_at' => '2019-01-01',
        'ends_at' => '2020-02-02',
        'vegetable_id' => 1,
        'parcel_id' => 1,
    ]);
});

it('asserts employee cannot store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('cycles.store'), $data)
        ->assertForbidden()
    ;
});
