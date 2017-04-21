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

Route::get('/', 'ZoneController@index');
Route::get('/zones', 'ZoneController@index')->name('list_zones');
Route::group(['prefix' => 'zones'], function () {

    Route::get('/show/{id}', 'ZoneController@show')
        ->name('show_zone');
    Route::get('/create', 'ZoneController@create')
        ->name('create_zone')
        ->middleware('can:create-zones');
    Route::post('/create', 'ZoneController@store')
        ->name('store_zone')
        ->middleware('can:create-zones');
    Route::get('/edit/{zone}', 'ZoneController@edit')
        ->name('edit_zone')
        ->middleware('can:update-zones,zone');
    Route::post('/edit/{zone}', 'ZoneController@update')
        ->name('update_zone')
        ->middleware('can:update-zones,zone');

});
