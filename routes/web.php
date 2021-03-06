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



Route::group(['middleware'=>'auth'], function (){
    Route::get('/', 'TreeController@main')->name('/');
    Route::get('/create', 'BranchController@create')->name('create');
    Route::get('/edit', 'BranchController@edit')->name('edit');
    Route::post('/update', 'BranchController@update')->name('update');
    Route::post('/store', 'BranchController@store')->name('store');
});



Route::group(['middleware' => ['role:admin|owner|moderator'],'namespace' => 'Admin' ], function (){
    Route::get('admin', 'AdminPanelController@admin')->name('admin');
    Route::get('product/create', ['middleware' => ['permission:create-product'], 'uses'=>'ManageProductsController@create'])->name('product/create');
    Route::post('product/store', 'ManageProductsController@store')->name('product/store');
    Route::get('product/edit/{id}', ['middleware' => ['permission:edit-product'], 'uses'=>'ManageProductsController@edit'])->name('product/edit');
    Route::post('product/update/{id}',  ['middleware' => ['check'], 'uses'=>'ManageProductsController@update'])->name('product/update');
    Route::get('product/show', 'ManageProductsController@show')->name('product/show');
    Route::get('product/index', 'ManageProductsController@index')->name('product/index');
    Route::get('product/destroy/{id}',   ['middleware' => ['permission:delete-product'], 'uses'=>'ManageProductsController@destroy'])->name('product/destroy');
});

Route::get('/catalog/{path}', 'BranchController@show')->where('path', '[a-zA-Z0-9/_-]+');
Route::get('{path}/{slug}', 'ProductController@product')->where('path', '[a-zA-Z0-9/_-]+');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
