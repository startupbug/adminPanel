<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* Admin Panel Routes */
Route::group(['prefix' => 'admin'], function () {

	//User Home page.
	Route::get('/', 'AdminController@index')->name('admin-index');

	//User management Route.
	Route::get('/user-management', 'AdminController@usermanagement_index')->name('user-management');

	//User Resource Controller
	Route::resource('users', 'UserController');

	//Role Resource Controller
	Route::resource('roles', 'RoleController');

	//Permission Resource Controller
	Route::get('/assign-permission', 'PermissionController@assign_permission')->name('assign_permission_index');
	Route::post('/assign-permission', 'PermissionController@assign_permission_post')->name('assign-permission-post');
	Route::resource('permissions', 'PermissionController');	
});
