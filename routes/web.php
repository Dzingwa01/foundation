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
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /**\
     * Nominee Routes
     */

    Route::resource('nominees','NomineeController');
    Route::get('dependants-details/{policy}','PolicyController@dependantsDetails');
    Route::post('nominees/update/{nominee}','NomineeController@update');
    Route::get('funeral-cover-edit/{policy}','PolicyController@funeralCoverEdit');
    /**
     * Policies Routes
     */
    Route::resource('policies','PolicyController');
    Route::get('get-policies','PolicyController@getPolicies')->name('get-policies');
    Route::get('policy-create','PolicyController@create');
    Route::get('nominee-details/{policy}','PolicyController@nomineeDetails');
    Route::get('policy-create-back/{policy}','PolicyController@policyCreateBack');
    Route::get('funeral-cover-details/{policy}','PolicyController@funeralPlanDetails');
    Route::get('policy/delete/{policy}','PolicyController@destroy');
    Route::get('policy/edit/{policy}','PolicyController@edit');
    Route::get('banking-details/{policy}','PolicyController@bankindDetails');
    Route::post('clients/update/{client}','ClientController@update');
    Route::get('nominee-details-edit/{policy}','PolicyController@nomineeEdit');
    Route::get('funeral-cover-edit/{policy}','PolicyController@funeralCoverEdit');
    Route::post('funeral-plan/policy-save/{policy}','PolicyController@savePolicyPlan');
    Route::post('save-policy-children/{policy}','PolicyController@savePolicyChildren');

    /**
     * Funeral Plan Routes
     */
    Route::resource('funeral-plans','FuneralPlanController');
    Route::get('get-funeral-plans','FuneralPlanController@getFuneralPlans')->name('get-funeral-plans');
    Route::get('get-funeral-plans-policies','FuneralPlanController@getFuneralPlansForPolicies')->name('get-funeral-plans-policies');
    Route::get('get-funeral-plans-policies-edit/{policy}','FuneralPlanController@getFuneralPlansForPoliciesEdit');

    Route::get('funeral-plan-create','FuneralPlanController@create');
    Route::get('funeral-plan/delete/{funeral_plan}','FuneralPlanController@destroy');
    Route::get('funeral-plan/edit/{funeral_plan}','FuneralPlanController@edit');
    Route::post('funeral-plan-update/{funeral_plan}','FuneralPlanController@update');
    Route::get('funeral-plan/show/{funeral_plan}','FuneralPlanController@show');
    /**
     * Branches Controller
     */
    Route::resource('branches', 'BranchController');
    Route::get('get-branches', 'BranchController@getBranches')->name('get-branches');
    Route::get('branch/edit/{branch}', 'BranchController@edit');
    Route::get('branch/delete/{branch}', 'BranchController@destroy');
    Route::post('branch/update/{branch}', 'BranchController@update');
    /**
     * Users Controller
     */
    Route::resource('users', 'UsersController');
    Route::get('get-users', 'UsersController@getUsers')->name('get-users');
    Route::get('user/edit/{user}', 'UsersController@edit');
    Route::get('/user/delete/{user}', 'UsersController@destroy');
    Route::get('account-activation/{user}', 'RegisterController@verifyEmail');
    Route::get('user-profile', 'UsersController@getUserProfile');
    Route::get('employee-create', 'UsersController@create');
    Route::post('user/update/{user}', 'UsersController@update');
    Route::get('user/block/{user}', 'UsersController@blockEmployee');

    Route::get('clerk-profile', 'UsersController@getUserProfile');

    /**
     * Roles Controller
     */
    Route::resource('roles', 'RoleController');
    Route::get('get-roles', 'RoleController@getRoles')->name('get-roles');
    Route::get('role/delete/{role}', 'RoleController@destroy');
    Route::get('role/edit/{role}', 'RoleController@edit');
    Route::post('role/update/{role}', 'RoleController@update');
});


