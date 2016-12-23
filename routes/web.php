<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/search', 'SearchController@products');
Route::get('/autocomplete', 'SearchController@suggestion');
Route::get('/dictionary_cron', 'CronController@dictionary');
Route::get('/{id?}', 'SearchController@index');
