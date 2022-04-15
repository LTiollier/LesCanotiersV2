<?php

use function Pest\Laravel\followingRedirects;
use function Pest\Laravel\post;

$data = [
    'name' => 'Solar',
];

it('asserts we cannot see store unauthenticated', function () use ($data) {
    post(route('vegetableCategories.store'), $data)
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can store', function () use ($data) {
    followingRedirects();

    actingAsAdmin()
        ->post(route('vegetableCategories.store'), $data)
        ->assertOk()
    ;

    $this->assertDatabaseHas('vegetable_categories', $data);
});

it('asserts employee cannot store', function () use ($data) {
    followingRedirects();

    actingAsEmployee()
        ->post(route('vegetableCategories.store'), $data)
        ->assertForbidden()
    ;
});
