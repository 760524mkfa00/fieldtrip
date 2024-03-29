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
Route::get('/overtime', 'DriverController@status');
Route::get('/overtime-by-adjustment-date/{date}', 'DriverController@currentOvertimeAdjustment')
    ->name('ot_report');

Route::group(['prefix' => 'zones'], function () {

    Route::get('/', 'ZoneController@index')->name('list_zones');

    Route::get('/show/{id}', 'ZoneController@show')
        ->name('show_zone');
    Route::get('/create', 'ZoneController@create')
        ->name('create_zone')
        ->middleware('can:create,Fieldtrip\Zone');
    Route::post('/create', 'ZoneController@store')
        ->name('store_zone')
        ->middleware('can:create,Fieldtrip\Zone');
    Route::get('/edit/{zone}', 'ZoneController@edit')
        ->name('edit_zone')
        ->middleware('can:update,zone');
    Route::post('/edit/{zone}', 'ZoneController@update')
        ->name('update_zone')
        ->middleware('can:update,zone');
    Route::get('/remove/{zone}', 'ZoneController@destroy')
        ->name('remove_zone')
        ->middleware('can:update,zone');

});

Route::group(['prefix' => 'routes'], function () {

    Route::get('/', 'RouteController@index')->name('list_routes');

    Route::get('/show/{id}', 'RouteController@show')
        ->name('show_route');
    Route::get('/create', 'RouteController@create')
        ->name('create_route')
        ->middleware('can:create,Fieldtrip\Route');
    Route::post('/create', 'RouteController@store')
        ->name('store_route')
        ->middleware('can:create,Fieldtrip\Route');
    Route::get('/edit/{route}', 'RouteController@edit')
        ->name('edit_route')
        ->middleware('can:update,route');
    Route::post('/edit/{route}', 'RouteController@update')
        ->name('update_route')
        ->middleware('can:update,route');
    Route::get('/remove/{route}', 'RouteController@destroy')
        ->name('remove_route')
        ->middleware('can:update,route');
});

Route::group(['prefix' => 'users'], function () {

    Route::get('/', 'UserController@index')
        ->name('list_users')
        ->middleware('can:update,Fieldtrip\User');


    // TODO: Replace with the register URL

    Route::get('/edit/{user}', 'UserController@edit')
        ->name('edit_user')
        ->middleware('can:update,user');
    Route::post('/edit/{user}', 'UserController@update')
        ->name('update_user')
        ->middleware('can:update,user');
    Route::get('/remove/{user}', 'UserController@destroy')
        ->name('remove_user')
        ->middleware('can:update,user');
});

Route::group(['prefix' => 'users/roles'], function () {

    Route::get('/', 'RoleController@index')
        ->name('list_role')
        ->middleware('can:view,Fieldtrip\Role');

    Route::get('/create', 'RoleController@create')
        ->name('create_role')
        ->middleware('can:create,Fieldtrip\Role');

    Route::post('/store', 'RoleController@store')
        ->name('store_role')
        ->middleware('can:create,Fieldtrip\Role');

    Route::get('/create/{role}', 'RoleController@createPermission')
        ->name('create_permission')
        ->middleware('can:createPermission,Fieldtrip\Role');;

    Route::post('/store/{role}', 'RoleController@storePermission')
        ->name('store_permission')
        ->middleware('can:createPermission,role');;

    Route::get('/remove/{role}/{key}', 'RoleController@destroyPermission')
        ->name('remove_permission')
        ->middleware('can:removePermission,role');;
});


Route::group(['prefix' => 'trips'], function () {

    Route::get('/', 'TripController@index')
        ->name('list_trips')
        ->middleware('can:view,Fieldtrip\Trip');

    Route::get('/create', 'TripController@create')
        ->name('create_trip')
        ->middleware('can:create,Fieldtrip\Trip');

    Route::post('/store', 'TripController@store')
        ->name('store_trip')
        ->middleware('can:create,Fieldtrip\Trip');

    Route::get('/edit/{trip}', 'TripController@edit')
        ->name('edit_trip')
        ->middleware('can:update,trip');

    Route::post('/update/{trip}', 'TripController@update')
        ->name('update_trip')
        ->middleware('can:update,trip');

    Route::get('/remove/{trip}', 'TripController@destroy')
        ->name('remove_trip')
        ->middleware('can:delete,trip');

    // This is the email communication to driver
        Route::get('/mailable/{trip}', 'DriverEmail@sendOffer')
            ->name('email_driver');

        Route::get('/response/{serial}', 'DriverEmail@response')
            ->name('response_trip');

        Route::post('/response/store/{id}', 'DriverEmail@storeResponse')
            ->name('store_response');

        Route::get('/submit/hours/{serial}', 'DriverEmail@submitHours')
            ->name('submit_hours');

        Route::post('/submit/hours/store/{id}', 'DriverEmail@storeHours')
            ->name('submit_hours');
    // End of communication

});

Route::group(['prefix' => 'drivers'], function () {

    Route::get('/{trip}', 'DriverController@assign')
        ->name('assign_driver')
        ->middleware('can:update,trip');

    Route::get('/{trip}/{user}', 'DriverController@assignToTrip')
        ->name('assign_trip')
        ->middleware('can:update,trip');

    Route::put('/{user}', 'DriverController@storeTripHours')
        ->name('store_hours')
        ->middleware('can:update,Fieldtrip\Trip');



});


Route::group(['prefix' => 'adjustments'], function () {



    Route::get('/', 'AdjustmentController@index')
        ->name('list_adjustments')
        ->middleware('can:create,Fieldtrip\Adjustment');

    Route::get('/create', 'AdjustmentController@create')
        ->name('create_adjustment')
        ->middleware('can:create,Fieldtrip\Adjustment');

    Route::post('/store', 'AdjustmentController@store')
        ->name('store_adjustment')
        ->middleware('can:create,Fieldtrip\Adjustment');

    Route::get('/{adjustment}', 'AdjustmentController@show')
        ->name('show_adjustment')
        ->middleware('can:update,adjustment');

    Route::get('/hours/{adjustment}', 'AdjustmentController@hours')
        ->name('edit_adjustment')
        ->middleware('can:update,adjustment');

    Route::post('/store/hours/{adjustment}', 'AdjustmentController@storeHours')
        ->name('store_hours')
        ->middleware('can:update,adjustment');

});