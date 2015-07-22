<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Defaul routes.
|--------------------------------------------------------------------------
|
| Controlls routes to:
| - "/".
|
*/
Route::get('/', function () {
    return redirect('auth/login');
});

/*
|--------------------------------------------------------------------------
| Authorization and registration routes.
|--------------------------------------------------------------------------
|
| Controlls routes to:
| - "/auth/login";
| - "/auth/register".
|
*/
Route::get('auth/verify/{confirmationCode}', 'Auth\AuthController@verify');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


/*
|--------------------------------------------------------------------------
| Routes to Startpage.
|--------------------------------------------------------------------------
|
| Controlls routes to:
| - "/home".
|
*/
Route::get('home', ['middleware' => 'auth', function() {
	return view('posts');
}]);

/*
|--------------------------------------------------------------------------
| Routes to get social feeds.
|--------------------------------------------------------------------------
|
| Controlls routes to:
| - "/posts";
| - "/posts/facebook";
| - "/posts/twitter";
| - "/posts/vk";
| - "/posts/google";
| - "/posts/facebook/callback";
| - "/posts/twitter/callback";
| - "/posts/vk/callback";
| - "/posts/google/oauth2callback";
| - "/posts/updateDB";
|
*/
Route::get('posts', ['middleware' => 'auth', function() {
	return view('posts');
}]);
Route::get('posts/{provider?}', 'PostsController@provider');
Route::get('posts/{provider}/callback', 'PostsController@providerCallback');
Route::get('posts/google/oauth2callback', 'PostsController@googleCallback');
Route::post('posts/updateDB', 'PostsController@updateDB');