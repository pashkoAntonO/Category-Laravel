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


Route::get('/', 'TreeController@main')->name('/');
Route::get('/create', 'BranchController@create')->name('create');
Route::get('/edit', 'BranchController@edit')->name('edit');
Route::post('/update', 'BranchController@update')->name('update');
Route::post('/store', 'BranchController@store')->name('store');

Route::get('/catalog/{path}', 'BranchController@show')->where('path', '[a-zA-Z0-9/_-]+');
Route::get('{path}/{slug}', 'ProductController@product')->where('path', '[a-zA-Z0-9/_-]+');
