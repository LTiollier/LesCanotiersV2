<?php

const LOGIN = 'login';

it('asserts we can access to login page', function () {
    $this->get(route('login'))
        ->assertSuccessful();
});
