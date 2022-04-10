<?php

use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('activities.destroy', ['activity' => 1]))
        ->assertRedirect(route('login'))
    ;
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('activities.destroy', ['activity' => 1]))
        ->assertRedirect(route('activities.index'))
    ;
});

it('asserts employee cannot delete', function () {
    actingAsEmployee()
        ->delete(route('activities.destroy', ['activity' => 1]))
        ->assertForbidden()
    ;
});
