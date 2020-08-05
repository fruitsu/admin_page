<?php

use Illuminate\Support\Facades\Route;

Route::get('/careers', 'Api\CareersController@index');
Route::get('/careers/{career}', 'Api\CareersController@show');

Route::get('/pages', 'Api\PagesController@index');
Route::get('/pages/{page}', 'Api\PagesController@show');

Route::get('/portfolios', 'Api\PortfoliosController@index');
Route::get('/portfolios/{portfolio}', 'Api\PortfoliosController@show');


