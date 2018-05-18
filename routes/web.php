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

	/* Pages resource */	Route::resource('pages', 'PageController');	
	Route::resource('pages', 'PageController');	

	/* Activity Log Routes */
	Route::get('/activity-log', 'AdminController@activitylog_index')->name('activitylog_index');

	/* Todo List Routes */
	//Todo custom update
	Route::post('/todos_update', 'admin\TodoController@todos_update')->name('todos_update');
	
	//Todo custom delete
	
	Route::post('/todos_delete', 'admin\TodoController@todos_delete')->name('todos_delete');

	//Task done undone, change status
	Route::post('/task_status', 'admin\TodoController@task_status')->name('task_status');

	Route::resource('todos', 'admin\TodoController');

});

	//Admin Login Authentication
	Route::get('/login', 'AuthController@login_index')->name('login_index');
	Route::post('/login', 'AuthController@login_post')->name('login_post');

	//Logout	
	Route::get('/logout', 'AuthController@logout')->name('logout');
