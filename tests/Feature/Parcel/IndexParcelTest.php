<?php

use function Pest\Laravel\get;

 it('asserts we cannot see index unauthenticated', function () {
     get(route('parcels.index'))
         ->assertRedirect(route('login'))
    ;
 });

 it('asserts admin can see index', function () {
     actingAsAdmin()
         ->get(route('parcels.index'))
         ->assertOk()
    ;
 });

 it('asserts employee cannot see index', function () {
     actingAsEmployee()
         ->get(route('parcels.index'))
         ->assertForbidden()
    ;
 });
