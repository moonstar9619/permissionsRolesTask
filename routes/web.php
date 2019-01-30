<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Post Routes
Route::get('/post/list','PostsController@index')->middleware('auth')->name('post.list');
Route::get('/post/show/{post_id}','PostsController@show')->middleware('auth')->name('post.show');
Route::get('/post/create','PostsController@create')->middleware('auth','isAdmin')->name('post.create');
Route::post('/post/create','PostsController@store')->middleware('auth','isAdmin')->name('post.store');
Route::get('/post/edit/{post_id}','PostsController@edit')->middleware('auth','isAdmin')->name('post.edit');
Route::post('/post/edit/{post_id}','PostsController@update')->middleware('auth','isAdmin')->name('post.update');
Route::get('/post/delete/{post_id}','PostsController@destroy')->middleware('auth','isAdmin')->name('post.delete');

// User Routes
Route::get('/user/list','UsersController@index')->middleware('auth','isAdmin')->name('user.list');
Route::get('/user/create','UsersController@create')->middleware('auth','isAdmin')->name('user.create');
Route::post('/user/create','UsersController@store')->middleware('auth','isAdmin')->name('user.store');
Route::get('/user/edit/{user_id}','UsersController@edit')->middleware('auth','isAdmin')->name('user.edit');
Route::post('/user/edit/{user_id}','UsersController@update')->middleware('auth','isAdmin')->name('user.update');
Route::get('/user/delete/{user_id}','UsersController@destroy')->middleware('auth','isAdmin')->name('user.delete');

// Permission Routes
Route::get('/permission/list','PermissionsController@index')->middleware('auth','role:Editor|Admin')->name('permission.list');
Route::get('/permission/create','PermissionsController@create')->middleware('auth','isAdmin')->name('permission.create');
Route::post('/permission/create','PermissionsController@store')->middleware('auth','isAdmin')->name('permission.store');
Route::get('/permission/edit/{permission_id}','PermissionsController@edit')->middleware('auth','role:Editor|Admin')->name('permission.edit');
Route::post('/permission/edit/{permission_id}','PermissionsController@update')->middleware('auth','role:Editor|Admin')->name('permission.update');
Route::get('/permission/delete/{permission_id}','PermissionsController@destroy')->middleware('auth','role:Editor|Admin')->name('permission.delete');

// Role Routes
Route::get('/role/list','RolesController@index')->middleware('auth','role:Editor|Admin')->name('role.list');
Route::get('/role/create','RolesController@create')->middleware('auth','isAdmin')->name('role.create');
Route::post('/role/create','RolesController@store')->middleware('auth','isAdmin')->name('role.store');
Route::get('/role/edit/{role_id}','RolesController@edit')->middleware('auth','role:Editor|Admin')->name('role.edit');
Route::post('/role/edit/{role_id}','RolesController@update')->middleware('auth','role:Editor|Admin')->name('role.update');
Route::get('/role/delete/{role_id}','RolesController@destroy')->middleware('auth','role:Editor|Admin')->name('role.delete');
