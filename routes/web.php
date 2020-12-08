<?php

use Illuminate\Support\Facades\Route;

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
Route::get('list', 'V1\TicketSearchController@getSearchTypeList');
Route::get('fields', 'V1\TicketSearchController@getSearchFieldListForSearchType');
Route::get('search', 'V1\TicketSearchController@searchResults');
