<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$data = [
    'name' => 'fake',
    'vegetable_category_id' => 1,
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('vegetables.store'), $data)
        ->assertRedirect(route('login'));
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('vegetables.store'), $data)
        ->assertOk();

    $this->assertDatabaseHas('vegetables', $data);
});

it('asserts employee cannot store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('vegetables.store'), $data)
        ->assertForbidden();
});
