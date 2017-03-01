<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'administrator'], function () {
        Route::group(['prefix' => 'modules'], function () {
            Route::resource('business-types', 'Administrator\Modules\BusinessTypeController');
            Route::resource('cities', 'Administrator\Modules\CityProvinceController');
            Route::resource('departments', 'Administrator\Modules\DepartmentController');
            Route::resource('functions', 'Administrator\Modules\FunctionController');
        });
    });
});