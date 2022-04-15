<?php

use function Pest\Laravel\get;

 it('asserts we cannot see index unauthenticated', function () {
     get(route('vegetables.index'))
         ->assertRedirect(route('login'))
    ;
 });

 it('asserts admin can see index', function () {
     actingAsAdmin()
         ->get(route('vegetables.index'))
         ->assertOk()
    ;
 });

 it('asserts employee cannot see index', function () {
     actingAsEmployee()
         ->get(route('vegetables.index'))
         ->assertForbidden()
    ;
 });
