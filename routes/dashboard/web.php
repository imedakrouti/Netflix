<?php

Route::prefix('dashbord')
->name('dashboard.')
->middleware(['auth','role:super_admin|admin'])
->group(function(){

    Route::get('/','welcomeController@index')->name('welcome');//dashboard.welcome
    Route::resource('category', 'categoryController');
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');

});
/*
Route::prefix('admin')
->name('admin.')
->middleware(['auth:admin'])
->group(function(){

    Route::get('/','welcomeController@index')->name('dashboard');//dashboard.welcome
    //Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');

     Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
    Route::resource('category', 'categoryController');
    Route::resource('role', 'RoleController');

});
*/
