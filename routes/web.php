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

//Route::get('/', 'ZoneController@index');


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
        ->name('list_users');


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