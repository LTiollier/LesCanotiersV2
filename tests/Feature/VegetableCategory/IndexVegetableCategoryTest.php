<?php

use function Pest\Laravel\get;

 it('asserts we cannot see index unauthenticated', function () {
     get(route('vegetableCategories.index'))
         ->assertRedirect(route('login'))
    ;
 });

 it('asserts admin can see index', function () {
     actingAsAdmin()
         ->get(route('vegetableCategories.index'))
         ->assertOk()
    ;
 });

 it('asserts employee cannot see index', function () {
     actingAsEmployee()
         ->get(route('vegetableCategories.index'))
         ->assertForbidden()
    ;
 });
