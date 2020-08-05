<?php

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['register' => false]);

require_once('web.admin.php');
require_once('web.client.php');
