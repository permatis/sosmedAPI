<?php
Route::get('/', function(){
	return view('welcome');
});

Route::get('posts', function() {
    return view('posts');
});

Route::post('posts', function() {
    dd(request()->all());
});

Route::group(['prefix' => '/setting/accounts'], function() {
	Route::get('/', 'AccountController@facebook_setting');
	Route::get('/facebook_callback', 'AccountController@facebook_callback');
	Route::get('/facebook_connect', 'AccountController@facebook_connect');
	Route::get('/facebook_disconnect', 'AccountController@facebook_disconnect');
});