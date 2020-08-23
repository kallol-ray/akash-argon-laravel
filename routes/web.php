<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('product/entry', ['as'=>'product.entry', 'uses'=>'ProductController@index']);
	Route::post('product/entry', ['as'=>'product.entry', 'uses'=>'ProductController@product_save']);

	Route::get('product/view', ['as'=>'product.view', 'uses'=>'ProductController@product_view']);
	Route::get('product/update/{id}', ['as'=>'product.update', 'uses'=>'ProductController@product_update_process']);
	Route::post('product/update', ['as'=>'product.update', 'uses'=>'ProductController@update_product']);
	
	Route::post('product/entry/delete', ['as'=>'product.entry.delete', 'uses'=>'ProductController@product_delete']);
});

