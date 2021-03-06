<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('times.destroy', ['time' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('times.destroy', ['time' => 1]))
        ->assertRedirect(route('times.index'));
});

it('asserts employee can delete', function () {
    actingAsEmployee()
        ->delete(route('times.destroy', ['time' => 2]))
        ->assertRedirect(route('times.index'));
});

it('asserts admin can delete other', function () {
    actingAsAdmin()
        ->delete(route('times.destroy', ['time' => 2]))
        ->assertRedirect(route('times.index'));
});

it('asserts employee cannot delete other', function () {
    actingAsEmployee()
        ->delete(route('times.destroy', ['time' => 1]))
        ->assertForbidden();
});
