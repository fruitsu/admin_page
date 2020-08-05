<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

require_once('web.admin.php');
require_once('web.client.php');
