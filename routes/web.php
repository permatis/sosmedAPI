<?php

Route::get('posts', function() {
    return view('posts');
});

Route::post('posts', function() {
    dd(request()->all());
});

Route::get('setting/accounts', function() {
    return view('settings/social_media');
});