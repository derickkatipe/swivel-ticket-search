<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
});
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('list', 'V1\TicketSearchController@getSearchTypeList');
    Route::get('fields', 'V1\TicketSearchController@getSearchFieldListForSearchType');
    Route::get('search', 'V1\TicketSearchController@searchResults');
    Route::get('logout', 'Auth\AuthController@logout');
});
Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@authenticate');



