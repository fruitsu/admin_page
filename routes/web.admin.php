<?php

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => ['auth'],
    'namespace' => 'Admin',
], function () {
    Route::get('/', function () {
        return redirect()->route('admin.users.index');
    });

    Route::resource('users', 'UsersController')->except('show');

    Route::resource('careers', 'CareersController')->except('show');

    Route::resource('pages', 'PagesController')->except('show');

    Route::resource('portfolios', 'PortfoliosController')->except('show');

    Route::delete('/media/{media}', 'MediaController@destroy')->name('name.destroy');

});
