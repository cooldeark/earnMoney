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

Route::get('/testImplements','testImplementController@getFuck');
Route::get('/stockCalculator','stockController@calculator');
Route::get('/stockDetail','stockController@calculatorPost')->name('stockDetail');
