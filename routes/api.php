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

//Apply a namespace for api authentication. All controllers are placed in Controllers\Auth
Route::namespace('Auth')->group(function () {
    Route::post('login', 'ApiLoginController@login');
    Route::middleware('auth:api')->get('/user/info', 'ApiLoginController@user');
});
//Apply a namespace for all api. All controllers are placed in Controllers\Api
Route::namespace('Api')->group(function () {

    //Secure all api through auth:api middleware
    Route::middleware('auth:api')->group(function () {

        //Post related routes
        Route::get('posts', 'PostApiController@index');
        Route::get('post/{id}', 'PostApiController@show');
        Route::get('post/{id}/comments', 'PostApiController@comments');
        Route::get('post/{id}/images', 'PostApiController@images');
        Route::get('post/{id}/details', 'PostApiController@details');

        Route::post('post/{id}/view', 'PostApiController@addView');
        Route::post('post/{id}/comment', 'PostApiController@addComment');
        Route::post('post/{id}/favorite', 'PostApiController@changeFavorite');
        Route::post('post/{id}/status', 'PostApiController@updatePostStatus');

        //Dashboard related routes
        Route::get('dashboard/years', 'DashboardController@historyYears');
        Route::get('dashboard/{year}/summary', 'DashboardController@summary');
        Route::get('dashboard/{year}/monthly-statistic', 'DashboardController@monthlyStatistic');
        Route::get('dashboard/{year}/rating-statistic', 'DashboardController@ratingStatistic');

        //User related routes
        Route::get('users/{id}', 'UserApiController@index');
        Route::get('/user', 'ApiLoginController@user');
    });

});
