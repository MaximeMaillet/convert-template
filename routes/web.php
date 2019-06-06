<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

Route::prefix('templates')->group(function () {
    Route::get('/', 'TemplateController@list')->name('template.list');
    Route::match(['get', 'post'], '/create', 'TemplateController@create')->name('template.create');
    Route::match(['get', 'post'], '/{name}', 'TemplateController@edit')->name('template.edit');
});

Route::prefix('converts')->group(function () {
    Route::match(['get', 'post'], '/', 'ConvertController@make')->name('convert.make');
});
