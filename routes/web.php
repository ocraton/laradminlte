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

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('items','ItemsController')->middleware(['auth','role:operator|admin']);
Route::get('/itemdatatable', 'ItemsController@getItemList')->name('itemdatatable')
        ->middleware(['auth','role:operator|admin']);

Route::resource('clienti', 'ClientiController')->middleware(['auth','role:admin']);
Route::get('/clientidatatable', 'ClientiController@getClientiList')->name('clientidatatable')
        ->middleware(['auth','role:admin']);

Route::resource('locazioni', 'LocazioniController')->middleware(['auth','role:admin']);
Route::get('/locazionidatatable', 'LocazioniController@getLocazioniList')->name('locazionidatatable')
        ->middleware(['auth','role:admin']);        


Route::get('ups', 'UpsController@index')->name('ups.index')->middleware(['auth','role:admin']);     
Route::post('ups', 'UpsController@store')->name('ups.store')->middleware(['auth','role:admin']);
Route::get('ups/create', 'UpsController@create')->name('ups.create')->middleware(['auth','role:admin']);
Route::get('ups/{ups}', 'UpsController@show')->name('ups.show')->middleware(['auth','role:admin']);
Route::put('ups/{ups}', 'UpsController@update')->name('ups.update')->middleware(['auth','role:admin']);
Route::delete('ups/{ups}', 'UpsController@destroy')->name('ups.destroy')->middleware(['auth','role:admin']);
Route::get('ups/{ups}/edit', 'UpsController@edit')->name('ups.edit')->middleware(['auth','role:admin']);
Route::get('/upsdatatable', 'UpsController@getUpsList')->name('upsdatatable')
        ->middleware(['auth','role:admin']);        