<?php

use function Pest\Laravel\post;
use function Pest\Laravel\followingRedirects;

$data = [
    'minutes' => 125,
    'date' => '1111-01-01',
    'quantity' => 20,
    'cycle' => [
        'id' => 1,
    ],
    'activity' => [
        'id' => 1,
    ],
    'user' => [
        'id' => 1,
    ],
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('times.store'), $data)
        ->assertRedirect(route('login'));
    ;
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('times.store'), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'minutes' => 125,
        'date' => '1111-01-01',
        'quantity' => 20,
        'cycle_id' => 1,
        'activity_id' => 1,
        'user_id' => 1,
    ]);
});

it('asserts employee can store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('times.store'), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'minutes' => 125,
        'date' => '1111-01-01',
        'quantity' => 20,
        'cycle_id' => 1,
        'activity_id' => 1,
        'user_id' => 1,
    ]);
});
