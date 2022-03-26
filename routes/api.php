<?php

use Illuminate\Http\Request;

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
    return $request->user();
});


Route::group(['namespace' => 'Api'], function(){
    Route::post('login', 'LoginController@login')->name('api-login');

    Route::group(['namespace' => 'Student', 'middleware' => 'auth:api'], function(){
        Route::get('teachers', 'WorksheetController@teachers')->name('api-teachers');
        Route::get('my-worksheets/{teacher_id}', 'WorksheetController@myWorksheets')->name('api-my-worksheets');
    });
});
