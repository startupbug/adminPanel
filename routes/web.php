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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	//User Home page.
	Route::get('/', 'Admin\AdminController@index')->name('admin-index');

	//User management Route.
	Route::get('/user-management', 'Admin\AdminController@usermanagement_index')->name('user-management');

	//User Resource Controller
	Route::resource('users', 'Admin\UserController');

	//Role Resource Controller
	Route::resource('roles', 'Admin\RoleController');

	//Permission Resource Controller
	Route::post('/assign-permission', 'Admin\PermissionController@assign_permission_post')->name('assign-permission-post');
	
	Route::post('/assign-permission-del', 'Admin\PermissionController@assign_permission_del')->name('assign-permission-del');

	Route::resource('permissions', 'Admin\PermissionController');

	/* Pages resource */
	Route::resource('pages', 'Admin\PageController');	

	Route::get('analytics', 'Admin\AnalyticsController@analytics')->name('analytics');
	Route::get('calender', 'Admin\GoogleCalender@all_events')->name('all_events');
});

	//Admin Login Authentication
	Route::get('/login', 'Admin\AuthController@login_index')->name('login_index');
	Route::post('/login', 'Admin\AuthController@login_post')->name('login_post');

	//Logout	
	Route::get('/logout', 'Admin\AuthController@logout')->name('logout');
