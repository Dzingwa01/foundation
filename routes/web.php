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



Auth::routes();
Route::get('/', function () {
    return redirect('login');
});
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Branches Controller
 */
Route::resource('branches','BranchController');
Route::get('get-branches','BranchController@getBranches')->name('get-branches');
Route::get('branch/edit/{branch}','BranchController@edit');
Route::get('branch/delete/{branch}','BranchController@destroy');
Route::post('branch/update/{branch}','BranchController@update');
/**
 * Users Controller
 */
Route::resource('users','UsersController');
Route::get('get-users','UsersController@getUsers')->name('get-users');
Route::get('user/edit/{user}','UsersController@edit');
Route::get('/user/delete/{user}','UsersController@destroy');
Route::get('account-activation/{user}','RegisterController@verifyEmail');
Route::get('user-profile','UsersController@getUserProfile');
Route::get('employee-create','UsersController@create');
Route::post('user/update/{user}','UsersController@update');
Route::get('user/block/{user}','UsersController@blockEmployee');

Route::get('clerk-profile','UsersController@getUserProfile');

/**
 * Roles Controller
 */
Route::resource('roles','RoleController');
Route::get('get-roles','RoleController@getRoles')->name('get-roles');
Route::get('role/delete/{role}','RoleController@destroy');
Route::get('role/edit/{role}','RoleController@edit');
Route::post('role/update/{role}','RoleController@update');


