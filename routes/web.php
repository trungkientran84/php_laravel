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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::namespace('User')->group(function () {
    Route::get('/dashboard', 'UserDashboardController@index')->name('user.dashboard');
    Route::get('/public-post', 'MyPostController@publicPost')->name('user.public-post');
    Route::get('/pending-post', 'MyPostController@pendingPost')->name('user.pending-post');
    Route::get('/closed-post', 'MyPostController@closedPost')->name('user.closed-post');
    Route::get('/draft-post', 'MyPostController@draftPost')->name('user.draft-post');
    Route::get('/favorite-post', 'MyPostController@favoritePost')->name('user.favorite-post');
    Route::view('/messages', 'user.messages')->name('user.messages');
    Route::view('/profile', 'user.profile')->name('user.profile');
});

//Route::view('/messages','user.message.index')->name('user.message.index');
//Route::view('/messages', 'user.message.index')->name('user.messages');
Route::resource('/messages','MessageController');
Route::post('/messagesread/{id}', 'MessageController@read')->name('messages.read');
Route::get('/messagesreply/{id}', 'MessageController@reply')->name('messages.reply');

Route::get('/','HomeController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pages/{id}','HomeController@toPage');
Route::get('/posts/{id}', 'HomeController@addPost');
Route::post('/posts','HomeController@storePost');
Route::get('/posts/{id}/edit','HomeController@editPost');
Route::put('/posts/{id}','HomeController@updatePost');
Route::delete('/posts/{id}','HomeController@destroy');

Route::get('/search','HomeController@search');

//pradeep
Route::get('/addPost','AddPostController@addPost');
Route::post('/addNew','AddPostController@store');
Route::post('/addAttributes','AddPostController@addAttributes');
Route::get('/editPost/{id}','AddPostController@editPost');
Route::post('/editAttributes','AddPostController@editAttributes');
Route::get('/deletePost/{id}','AddPostController@deletePost');
Route::get('/displayPost/{id}','AddPostController@displayPost');
Route::get('/help','AddPostController@help');
Route::get('/promotePost/{id}','AddPostController@promotePost');
Route::post('/checkout','AddPostController@checkout');



//Route::view('/messages','user.message.index')->name('user.message.index');
//Route::view('/messages', 'user.message.index')->name('user.messages');
Route::resource('/messages','MessageController');
Route::post('/messagesread/{id}', 'MessageController@read')->name('messages.read');
Route::get('/messagesreply/{id}', 'MessageController@reply')->name('messages.reply');
