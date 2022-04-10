<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\put;

$data = [
    'minutes' => 1,
    'date' => '1111-01-02',
    'quantity' => 1,
];

it('asserts we cannot update unauthenticated', function () {
    put(route('times.update', ['time' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can update', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('times.update', ['time' => 1]), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'id' => 1,
        'minutes' => 1,
        'date' => '1111-01-02',
        'quantity' => 1,
    ]);
});

it('asserts employee can update', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('times.update', ['time' => 2]), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'id' => 2,
        'minutes' => 1,
        'date' => '1111-01-02',
        'quantity' => 1,
    ]);
});

it('asserts admin can update other', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('times.update', ['time' => 2]), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'id' => 2,
        'minutes' => 1,
        'date' => '1111-01-02',
        'quantity' => 1,
    ]);
});

it('asserts employee cannot update other', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('times.update', ['time' => 1]), $data)
        ->assertForbidden()
    ;
});
