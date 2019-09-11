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
    return view('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'Web\HomeController@index')->name('home');
    Route::get('help-centre', function () {
        return view('help-centre');
    });

    Route::group(['prefix' => 'jobs'], function () {
        Route::get('/', 'Web\JobsController@index')->name('jobs');
        Route::get('create', 'Web\JobsController@create')->name('jobs.create');
        Route::post('create', 'Web\JobsController@store')->name('jobs.store');
        Route::get('{id}', 'Web\JobsController@show')->name('jobs.show'); 
        Route::get('{id}/assign', 'Web\JobsController@assign')->name('jobs.assign'); 
        Route::post('{id}/assign', 'Web\JobsController@storeAssignment')->name('jobs.assign.store'); 
        Route::get('{id}/collection/record','Web\JobsController@collect');
        Route::post('{id}/collection/record','Web\JobsController@recordCollection')->name('jobs.collection.store');
        
    });

    Route::group(['prefix' => 'billing'], function () {
        Route::get('/', 'Web\BillingsController@index')->name('billing');

        Route::group(['prefix' => 'invoices'], function () {
            Route::get('/', 'Web\InvoicesController@index')->name('invoices');
            Route::get('create', 'Web\InvoicesController@create')->name('invoices.create');
            Route::post('create', 'Web\InvoicesController@store')->name('invoices.store');
        });

        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', 'Web\InvoicePaymentsController@index')->name('payments');
        });
    });

    

    Route::group(['prefix' => 'settings'], function () {

        Route::get('/', 'Web\SettingsController@index')->name('settings');
        Route::post('/', 'Web\SettingsController@store')->name('settings.store');

        Route::group(['prefix' => 'employees'], function () {
            Route::get('/', 'Web\EmployeesController@index')->name('settings.employees');
            Route::get('create', 'Web\EmployeesController@create')->name('settings.employees.create');
            Route::post('create', 'Web\EmployeesController@store')->name('settings.employees.store');
            Route::get('{id}/edit', 'Web\EmployeesController@edit')->name('settings.employees.edit');
            Route::put('{id}/edit', 'Web\EmployeesController@update')->name('settings.employees.update');
        });

        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', 'Web\CustomersController@index')->name('settings.customers');
            Route::get('create', 'Web\CustomersController@create')->name('settings.customers.create');
            Route::post('create', 'Web\CustomersController@store')->name('settings.customers.store');
            Route::get('{id}', 'Web\CustomersController@show')->name('settings.customers.show');
            Route::get('{id}/waste-items/create', 'Web\CustomerWastesController@create')->name('settings.customers.wastes.create');
            Route::post('{id}/waste-items/create', 'Web\CustomerWastesController@store')->name('settings.customers.wastes.store');
            Route::get('{id}/workshops/create', 'Web\WorkshopsController@create')->name('settings.customers.workshops.create');
            Route::post('{id}/workshops/create', 'Web\WorkshopsController@store')->name('settings.customers.workshops.store');
            Route::get('{id}/edit', 'Web\CustomersController@edit')->name('settings.customers.edit');
            Route::put('{id}/edit', 'Web\CustomersController@update')->name('settings.customers.update');
        });

        Route::group(['prefix' => 'vehicles'], function () {
            Route::get('/', 'Web\VehiclesController@index')->name('settings.vehicles');
            Route::get('create', 'Web\VehiclesController@create')->name('settings.vehicles.create');
            Route::post('create', 'Web\VehiclesController@store')->name('settings.vehicles.store');
            Route::get('{id}/edit', 'Web\VehiclesController@edit')->name('settings.vehicles.edit');
            Route::put('{id}/edit', 'Web\VehiclesController@update')->name('settings.vehicles.update');
        });

        Route::group(['prefix' => 'pricelists'], function () {
            Route::get('/', 'Web\PricelistsController@index')->name('settings.pricelists');
            Route::get('create', 'Web\PricelistsController@create')->name('settings.pricelists.create');
            Route::post('create', 'Web\PricelistsController@store')->name('settings.pricelists.store');
            Route::get('{id}', 'Web\PricelistsController@show')->name('settings.pricelists.show');
            Route::get('{id}/edit', 'Web\PricelistsController@edit')->name('settings.pricelists.edit');
            Route::put('{id}/edit', 'Web\PricelistsController@update')->name('settings.pricelists.update');
        });

        Route::group(['prefix' => 'wastes'], function () {
            Route::get('/', 'Web\WastesController@index')->name('settings.wastes');
            Route::get('create', 'Web\WastesController@create')->name('settings.wastes.create');
            Route::post('create', 'Web\WastesController@store')->name('settings.wastes.store');
            Route::get('{id}/edit', 'Web\WastesController@edit')->name('settings.wastes.edit');
            Route::put('{id}/edit', 'Web\WastesController@update')->name('settings.wastes.update');

        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('create', 'Web\CategoriesController@create')->name('settings.categories.create');
            Route::post('create', 'Web\CategoriesController@store')->name('settings.categories.store');
            Route::get('{id}/edit', 'Web\CategoriesController@edit')->name('settings.categories.edit');
            Route::put('{id}/edit', 'Web\CategoriesController@update')->name('settings.categories.update');
        });

        Route::group(['prefix' => 'areas'], function () {
            Route::get('/', 'Web\AreasController@index')->name('settings.areas');
            Route::get('create', 'Web\AreasController@create')->name('settings.areas.create');
            Route::post('create', 'Web\AreasController@store')->name('settings.areas.store');
            Route::get('{id}/edit', 'Web\AreasController@edit')->name('settings.areas.edit');
            Route::put('{id}/edit', 'Web\AreasController@update')->name('settings.areas.update');
        });
        
        Route::group(['prefix' => 'processing-centres'], function () {
            Route::get('/', 'Web\ProcessingCentresController@index')->name('settings.processing-centres');
            Route::get('create', 'Web\ProcessingCentresController@create')->name('settings.processing-centres.create');
            Route::post('create', 'Web\ProcessingCentresController@store')->name('settings.processing-centres.store');
        });
    });
});



