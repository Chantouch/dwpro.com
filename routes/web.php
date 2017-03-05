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
    Route::prefix('modules')->name('admin.modules.')->middleware('auth:admin')->group(function () {

        Route::resource('business-types', 'Administrator\Modules\BusinessTypeController');
        Route::resource('industries', 'Administrator\Modules\IndustryController');
        Route::get('city-provinces', 'AdminController@getCityProvince')->name('city-provinces');
        Route::get('departments', 'AdminController@getDepartment')->name('departments');
        Route::get('functions', 'AdminController@getFunction')->name('functions');
        Route::get('industries', 'AdminController@getIndustry')->name('industries');
        Route::get('qualifications', 'AdminController@getQualification')->name('qualifications');
        Route::get('levels', 'AdminController@getLevel')->name('levels');
        Route::get('languages', 'AdminController@getLanguage')->name('languages');
        Route::get('positions', 'AdminController@getPosition')->name('positions');

    });
});

//Employee Route
Route::prefix('employee')->group(function () {
    Route::get('login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('login', 'Auth\EmployeeLoginController@login')->name('employee.login.post');
    Route::post('logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    Route::get('home', 'EmployeeController@index')->name('employee.home');
});
