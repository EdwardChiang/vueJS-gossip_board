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
		Route::post('create', 'replyController@create');
	});
});

Route::filter('maxUploadFileSize', function()
{
	// Check if upload has exceeded max size limit
	if (! (Request::isMethod('POST') or Request::isMethod('PUT'))) { return; }
	// Get the max upload size (in Mb, so convert it to bytes)
	$maxUploadSize = 1024 * 1024 * ini_get('post_max_size');
	$contentSize = 0;
	if (isset($_SERVER['HTTP_CONTENT_LENGTH']))
	{
		$contentSize = $_SERVER['HTTP_CONTENT_LENGTH'];
	}
	elseif (isset($_SERVER['CONTENT_LENGTH']))
	{
		$contentSize = $_SERVER['CONTENT_LENGTH'];
	}
	// If content exceeds max size, throw an exception
	if ($contentSize > $maxUploadSize)
	{
		throw new GSVnet\Core\Exceptions\MaxUploadSizeException;
	}
});

Route::filter('csrf', function() {
	if (Session::token() != Input::get('_token'))
	{
		if (empty($_POST)) {
			$post_size = trim(ini_get('post_max_size'));
			$post_size = substr($post_size, 0, -1);
			$post_size = ($post_size * 1024) * 1024;

			if ($post_size < Request::header('Content-Length')) {
				$validator = Validator::make(Input::all(), []);

				$messages = $validator->errors();
				$messages->add('file size', 'Files Cannot Exceed ' . ini_get('upload_max_filesize'));

				return Redirect::back()->withErrors($messages);
			}
		}

		throw new Illuminate\Session\TokenMismatchException;
	}
});
