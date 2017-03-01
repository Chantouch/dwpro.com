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

Auth::routes();

Route::get('/home', 'HomeController@index');

//Admin Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.post');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('modules/business-types', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/city-provinces', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/departments', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/functions', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/industries', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/qualifications', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/levels', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/languages', 'AdminController@getBusinessType')->name('admin.modules.business-types');
    Route::get('modules/positions', 'AdminController@getBusinessType')->name('admin.modules.business-types');

});

//Employee Route
Route::group(['prefix' => 'employee'], function () {
    Route::get('login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('login', 'Auth\EmployeeLoginController@login')->name('employee.login.post');
    Route::post('logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    Route::get('home', 'EmployeeController@index')->name('employee.home');
});
