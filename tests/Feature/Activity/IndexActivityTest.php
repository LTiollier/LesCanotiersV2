<?php

use function Pest\Laravel\get;

 it('asserts we cannot see index unauthenticated', function () {
     get(route('activities.index'))
         ->assertRedirect(route('login'))
    ;
 });

 it('asserts admin can see index', function () {
     actingAsAdmin()
         ->get(route('activities.index'))
         ->assertOk()
    ;
 });

 it('asserts employee cannot see index', function () {
     actingAsEmployee()
         ->get(route('activities.index'))
         ->assertForbidden()
    ;
 });
