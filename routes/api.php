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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'Api\EmployeesController@index');
        Route::get('{id}/jobs', 'Api\EmployeesController@fetchAssignedJobs');
        Route::delete('{id}', 'Api\EmployeesController@destroy');

    });


    Route::group(['prefix' => 'areas'], function () {
        Route::get('/', 'Api\AreasController@index');
        Route::delete('{id}', 'Api\AreasController@destroy');
    });

    Route::group(['prefix' => 'wastes'], function () {
        Route::get('/', 'Api\WastesController@index');
        Route::delete('{id}', 'Api\WastesController@destroy');
    });

    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', 'Api\InvoicesController@index');
        Route::post('{id}/payments', 'Api\InvoicePaymentsController@store');
    });

    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', 'Api\InvoicePaymentsController@index');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'Api\CategoriesController@index');
        Route::delete('{id}', 'Api\CategoriesController@destroy');
    });

    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/', 'Api\VehiclesController@index');
        Route::delete('{id}', 'Api\VehiclesController@destroy');
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', 'Api\CustomersController@index');
        Route::get('{id}/waste-items', 'Api\CustomersController@getWasteItems');
        Route::delete('{id}', 'Api\CustomersController@destroy');
    });

    Route::group(['prefix' => 'jobs'], function () {
        Route::get('/', 'Api\JobsController@index');
        Route::post('{id}/complete-assignment', 'Api\JobsController@completeAssignment');
        Route::get('/find-available-drivers','Api\JobsController@findAvailableDriversBasedOnCollectionDate');
        Route::post('{id}/collection/record','Api\JobsController@recordCollection');
        Route::post('{id}/collection/verify','Api\JobsController@verifyCollection');

    });

    Route::group(['prefix' => 'pricelists'], function () {
        Route::get('/', 'Api\PricelistsController@index');
        Route::delete('{id}', 'Api\PricelistsController@destroy');
    });


});
