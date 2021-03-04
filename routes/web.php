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

Route::get('/', 'ConverterController@index');
Route::get('/index', 'ConverterController@index')->name('index');
Route::post('/to-json', 'ConverterController@toJSON')->name('to-json');
Route::post('/to-csv', 'ConverterController@toCSV')->name('to-csv');