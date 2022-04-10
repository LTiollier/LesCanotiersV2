<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$dataAdmin = [
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

$dataEmployee = $dataAdmin;
$dataEmployee['user']['id'] = 2;

it('asserts we cannot see store unauthenticated', function () use ($dataAdmin) {
    post(route('times.store'), $dataAdmin)
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can store', function () use ($dataAdmin) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('times.store'), $dataAdmin)
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

it('asserts employee can store', function () use ($dataEmployee) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('times.store'), $dataEmployee)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'minutes' => 125,
        'date' => '1111-01-01',
        'quantity' => 20,
        'cycle_id' => 1,
        'activity_id' => 1,
        'user_id' => 2,
    ]);
});

it('asserts admin can store other', function () use ($dataEmployee) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('times.store'), $dataEmployee)
        ->assertOk()
    ;

    $this->assertDatabaseHas('times', [
        'minutes' => 125,
        'date' => '1111-01-01',
        'quantity' => 20,
        'cycle_id' => 1,
        'activity_id' => 1,
        'user_id' => 2,
    ]);
});

it('asserts employee cannot store other', function () use ($dataAdmin) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('times.store'), $dataAdmin)
        ->assertForbidden()
    ;
});
