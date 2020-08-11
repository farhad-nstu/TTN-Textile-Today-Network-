<?php

// Route::get('/email', 'UsersController@register');





Route::get('/test', function () {
    return view('test');

})->name('user.mail');



Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

