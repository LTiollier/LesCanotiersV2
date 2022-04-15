<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('vegetableCategories.destroy', ['vegetableCategory' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('vegetableCategories.destroy', ['vegetableCategory' => 1]))
        ->assertRedirect(route('vegetableCategories.index'))
    ;
});

it('asserts employee cannot delete', function () {
    actingAsEmployee()
        ->delete(route('vegetableCategories.destroy', ['vegetableCategory' => 1]))
        ->assertForbidden()
    ;
});
