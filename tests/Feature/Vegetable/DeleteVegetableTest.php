<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('vegetables.destroy', ['vegetable' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('vegetables.destroy', ['vegetable' => 1]))
        ->assertRedirect(route('vegetables.index'))
    ;
});

it('asserts employee cannot delete', function () {
    actingAsEmployee()
        ->delete(route('vegetables.destroy', ['vegetable' => 1]))
        ->assertForbidden()
    ;
});
