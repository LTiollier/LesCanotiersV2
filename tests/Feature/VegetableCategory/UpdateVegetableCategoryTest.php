<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\put;

$data = [
    'name' => 'Solar',
];

it('asserts we cannot update unauthenticated', function () {
    put(route('vegetableCategories.update', ['vegetableCategory' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can update', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->put(route('vegetableCategories.update', ['vegetableCategory' => 1]), $data)
        ->assertOk();

    $this->assertDatabaseHas('vegetable_categories', $data);
});

it('asserts employee cannot update', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->put(route('vegetableCategories.update', ['vegetableCategory' => 1]), $data)
        ->assertForbidden();
});
