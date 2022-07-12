<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('cycles.destroy', ['cycle' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('cycles.destroy', ['cycle' => 1]))
        ->assertRedirect(route('cycles.index'));
});

it('asserts employee cannot delete', function () {
    actingAsEmployee()
        ->delete(route('cycles.destroy', ['cycle' => 1]))
        ->assertForbidden();
});
