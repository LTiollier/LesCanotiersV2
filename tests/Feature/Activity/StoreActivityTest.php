<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$data = [
    'name' => 'eee',
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('activities.store'), $data)
        ->assertRedirect(route('login'));
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('activities.store'), $data)
        ->assertOk();

    $this->assertDatabaseHas('activities', [
        'name' => 'eee',
    ]);
});

it('asserts employee cannot store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('activities.store'), $data)
        ->assertForbidden();
});
