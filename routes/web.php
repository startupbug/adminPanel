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
Route::group(['prefix' => 'admin',  'middleware' => 'isAdmin'], function () {

	//User Home page.
	Route::get('/', 'AdminController@index')->name('admin-index');

	//User management Route.
	Route::get('/user-management', 'AdminController@usermanagement_index')->name('user-management');

	//User Resource Controller
	Route::resource('users', 'UserController');

	//Role Resource Controller
	Route::resource('roles', 'RoleController');

	//Permission Resource Controller
	Route::post('/assign-permission', 'PermissionController@assign_permission_post')->name('assign-permission-post');
	
	Route::post('/assign-permission-del', 'PermissionController@assign_permission_del')->name('assign-permission-del');

	Route::resource('permissions', 'PermissionController');

});

	//Admin Login Authentication
	Route::get('/login', 'AuthController@login_index')->name('login_index');
	Route::post('/login', 'AuthController@login_post')->name('login_post');

	//Logout	
	Route::get('/logout', 'AuthController@logout')->name('logout');
