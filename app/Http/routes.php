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

Route::get('/testt', 'home@test');

Route::get('/', 'home@index');
Route::get('/article/{id}', 'home@article');
Route::get('/login/{status?}', 'home@login');
Route::get('/register/{status?}', 'home@register');
Route::get('/recentArticle', 'home@recent');

Route::group(['prefix' => 'auth'], function() {
	Route::post('login', 'Auth\authController@login');
	Route::post('register', 'Auth\authController@register');
	Route::get('logout', 'Auth\authController@logout');
});

Route::group(['prefix' => 'api'], function() {
	Route::get('getAccount', 'Auth\authController@getAccount');

	Route::group(['prefix' => 'article'], function() {
		Route::post('create', 'articleController@create');
		Route::get('create', 'articleController@create');
		Route::post('update', 'articleController@update');
		Route::post('delete', 'articleController@delete');
	});

	Route::group(['prefix' => 'reply'], function() {
		Route::get('get', 'replyController@getOne');
		Route::post('create', 'replyController@create');
	});
});