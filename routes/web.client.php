<?php

Auth::routes();

Route::view('{any}', 'layouts.client')->where('any', '.*');
