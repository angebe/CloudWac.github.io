<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/',  'FileController@Index');
Route::post('/uploadFiles', 'FileController@uploadFiles');
Route::get('uploadfiles/edit/{id}', 'FileController@edit');
Route::post('uploadfiles/edit/{id}', 'FileController@update');
Route::get('uploadfiles/info/{id}', 'FileController@show');
Route::get('uploadfiles/delete/{id}', 'FileController@destroy');

Route::get('admin', 'AdminController@store');
Route::get('admin/edit/{id}' , 'AdminController@showfileadmin');
Route::get('admin/delete/{id}' , 'AdminController@destroy');
Route::get('admin/file' , 'AdminController@file');
Route::get('admin/users', 'AdminController@user');
Route::get('admin/deleteuser/{id}' , 'AdminController@destroyuser');
Route::get('mine/source/{id}', 'UploadController@show');
Route::get('admin/block/{id}',  'AdminController@adminblock');
Route::get('admin/unblock/{id}',  'AdminController@adminunblock');
Route::post('admin/edit/{id}', ['as' => 'edit', 'uses' => 'AdminController@fileadmin']);

Route::resource('user', 'UserController', ['except' => ['create', 'store', 'index']]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Password reset link request routes...
// Route::get('password/email', 'Auth\PasswordController@getEmail');
// Route::post('password/email', 'Auth\PasswordController@postEmail');

// // Password reset routes...
// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
// Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('contact', 'ContactController@getForm');
Route::post('contact', 'ContactController@postForm');

Route::get('activate/{code}', 'Auth\AuthController@activateAccount');
