<?php

use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\delete;

it('asserts we cannot delete unauthenticated', function () {
    delete(route('users.destroy', ['user' => 1]))
        ->assertRedirect(route('login'));
});

it('asserts admin can self delete', function () {
    actingAsAdmin()
        ->delete(route('users.destroy', ['user' => 1]))
        ->assertRedirect(route('users.index'));

    $this->assertFalse(Auth::check());
});

it('asserts admin can delete', function () {
    actingAsAdmin()
        ->delete(route('users.destroy', ['user' => 2]))
        ->assertRedirect(route('users.index'));

    $this->assertTrue(Auth::check());
});

it('asserts employee can self delete', function () {
    actingAsEmployee()
        ->delete(route('users.destroy', ['user' => 2]))
        ->assertRedirect(route('users.index'));

    $this->assertFalse(Auth::check());
});

it('asserts employee cannot delete other', function () {
    actingAsEmployee()
        ->delete(route('users.destroy', ['user' => 1]))
        ->assertForbidden();
});
