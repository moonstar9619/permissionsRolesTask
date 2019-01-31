<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Post Routes
Route::group(['prefix' => 'post'], function (){
    Route::get('/list','PostsController@index')->middleware('auth')->name('post.list');
    Route::get('/show/{post_id}','PostsController@show')->middleware('auth')->name('post.show');
    Route::get('/create','PostsController@create')->middleware('auth','permission:Create Post|AllPermission')->name('post.create');
    Route::post('/create','PostsController@store')->middleware('auth','permission:Create Post|AllPermission')->name('post.store');
    Route::get('/edit/{post_id}','PostsController@edit')->middleware('auth','permission:Edit Post|AllPermission')->name('post.edit');
    Route::post('/edit/{post_id}','PostsController@update')->middleware('auth','permission:Edit Post|AllPermission')->name('post.update');
    Route::get('/delete/{post_id}','PostsController@destroy')->middleware('auth','permission:Delete Post|AllPermission')->name('post.delete');

});

// User Routes
Route::group(['prefix' => 'user'], function () {
    Route::get('/list','UsersController@index')->middleware('auth','permission:Edit User|Delete User|AllPermission')->name('user.list');
    Route::get('/create','UsersController@create')->middleware('auth','permission:Create User|AllPermission')->name('user.create');
    Route::post('/create','UsersController@store')->middleware('auth','permission:Create User|AllPermission')->name('user.store');
    Route::get('/edit/{user_id}','UsersController@edit')->middleware('auth','permission:Edit User|AllPermission')->name('user.edit');
    Route::post('/edit/{user_id}','UsersController@update')->middleware('auth','permission:Edit User|AllPermission')->name('user.update');
    Route::get('/delete/{user_id}','UsersController@destroy')->middleware('auth','permission:Delete User|AllPermission')->name('user.delete');

});

// Permission Routes
Route::group(['prefix' => 'permission'], function () {
Route::get('/list','PermissionsController@index')->middleware('auth','permission:Edit Permission|Delete Permission|AllPermission')->name('permission.list');
Route::get('/create','PermissionsController@create')->middleware('auth','permission:Create Permission|AllPermissionn')->name('permission.create');
Route::post('/create','PermissionsController@store')->middleware('auth','permission:Create Permission|AllPermission')->name('permission.store');
Route::get('/edit/{permission_id}','PermissionsController@edit')->middleware('auth','permission:Edit Permission|AllPermission')->name('permission.edit');
Route::post('/edit/{permission_id}','PermissionsController@update')->middleware('auth','permission:Edit Permission|AllPermission')->name('permission.update');
Route::get('/delete/{permission_id}','PermissionsController@destroy')->middleware('auth','permission:Delete Permission|AllPermission')->name('permission.delete');
});

// Role Routes
Route::group(['prefix' => 'role'], function () {
Route::get('/list','RolesController@index')->middleware('auth','permission:Edit Role|Delete Role|AllPermission')->name('role.list');
Route::get('/create','RolesController@create')->middleware('auth','permission:Create Role|AllPermission')->name('role.create');
Route::post('/create','RolesController@store')->middleware('auth','permission:Create Role|AllPermission')->name('role.store');
Route::get('/edit/{role_id}','RolesController@edit')->middleware('auth','permission:Edit Role|AllPermission')->name('role.edit');
Route::post('/edit/{role_id}','RolesController@update')->middleware('auth','permission:Edit Role|AllPermission')->name('role.update');
Route::get('/delete/{role_id}','RolesController@destroy')->middleware('auth','permission:Delete Role|AllPermission')->name('role.delete');
});