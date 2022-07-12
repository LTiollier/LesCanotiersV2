<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\put;

$data = [
    'name' => 'fake',
    'vegetable_category_id' => 1,
];

it('asserts we cannot update unauthenticated', function () {
    put(route('vegetables.update', ['vegetable' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can update', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('vegetables.update', ['vegetable' => 1]), $data)
        ->assertOk();

    $this->assertDatabaseHas('vegetables', $data);
});

it('asserts employee cannot update', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('vegetables.update', ['vegetable' => 1]), $data)
        ->assertForbidden();
});
