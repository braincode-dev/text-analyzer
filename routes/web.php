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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'MainController@index');

Route::post('/text-analyze', 'MainController@analyzeText')->name('text-analyze');
Route::post('/file-analyze', 'MainController@analyzeFile')->name('file-analyze');
Route::get('/download/{type}/{id}', 'MainController@download')->name('download');