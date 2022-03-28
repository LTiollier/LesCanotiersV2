<?php

const LOGIN = 'login';
const DASHBOARD = 'times.create';

it('asserts we can access to login page', function () {
    $this->get(route('login'))
        ->assertSuccessful()
    ;
});

it('asserts we receive session errors', function () {
    $this->post(route('login'))
        ->assertSessionHasErrors(['email', 'password'])
    ;

    $this->assertGuest();
});

it('asserts we receive cannot login with wrong password', function () {
    $this->post(route('login'), ['email' => 'admin@gmail.com', 'password' => 'wrong'])
        ->assertSessionHasErrorsIn('email')
    ;

    $this->assertGuest();
});

it('asserts we can login and redirect to dashboard', function () {
    $this->post(route('login'), ['email' => 'admin@gmail.com', 'password' => 'password'])
        ->assertRedirect(route(DASHBOARD))
    ;

    $this->assertAuthenticated();
});
