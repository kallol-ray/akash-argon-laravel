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


	Route::get('product/entry', ['as'=>'product.entry', 'uses'=>'ProductController@product_info_entry']);
	Route::post('product/entry', ['as'=>'product.entry', 'uses'=>'ProductController@product_save']);


	Route::get('product/view', ['as'=>'product.view', 'uses'=>'ProductController@product_view']);
	Route::get('product/update/{id}', ['as'=>'product.update', 'uses'=>'ProductController@product_update_process']);
	Route::post('product/update', ['as'=>'product.update', 'uses'=>'ProductController@update_product']);	
	Route::post('product/entry/delete', ['as'=>'product.entry.delete', 'uses'=>'ProductController@product_delete']);


	Route::get('product/purchase_order/entry', ['as'=>'product.purchase_order.entry', 'uses'=>'ProductController@purchase_order_entry']);
	Route::post('product/purchase_order/entry', ['as'=>'product.purchase_order.entry', 'uses'=>'ProductController@purchase_order_save']);
	Route::get('product/purchase_order/view', ['as'=>'product.purchase_order.view', 'uses'=>'ProductController@purchase_order_view']);
	Route::get('product/purchase_order/update/{po_info_id}', ['as'=>'product.purchase_order.update', 'uses'=>'ProductController@purchase_order_update_process']);
	Route::post('product/purchase_order/update', ['as'=>'product.purchase_order.update', 'uses'=>'ProductController@update_purchase_order']);
	Route::get('product/purchase_order/stop_entry/{po_info_id}', ['as'=>'product.purchase_order.stop_entry', 'uses'=>'ProductController@po_stop_entry']);
	Route::post('product/purchase_order/delete', ['as'=>'product.purchase_order.delete', 'uses'=>'ProductController@purchase_order_delete']);


	Route::get('supplier/entry', ['as'=>'supplier.entry', 'uses'=>'SupplyController@supplier_info_entry']);
	Route::post('supplier/entry', ['as'=>'supplier.entry', 'uses'=>'SupplyController@supplier_save']);	
	Route::get('supplier/view', ['as'=>'supplier.view', 'uses'=>'SupplyController@supplier_view']);


	Route::get('product/store_in/entry', ['as'=>'product.store_in.entry', 'uses'=>'ProductController@store_in_entry']);
	Route::post('product/store_in/entry', ['as'=>'product.store_in.entry', 'uses'=>'ProductController@store_in_entry_save']);
	Route::get('product/store_in/view', ['as'=>'product.store_in.view', 'uses'=>'ProductController@store_in_view']);



	Route::get('customer/entry', ['as'=>'customer.entry', 'uses'=>'CustomerController@ready_entry']);
	Route::post('customer/entry', ['as'=>'customer.entry', 'uses'=>'CustomerController@save_entry']);
	Route::get('customer/view', ['as'=>'customer.view', 'uses'=>'CustomerController@view_entry']);


	Route::get('order_place/entry', ['as'=>'order_place.entry', 'uses'=>'SaleController@order_entry']);
	Route::post('order_place/entry', ['as'=>'order_place.entry', 'uses'=>'SaleController@order_save']);
	Route::get('order_place/view', ['as'=>'order_place.view', 'uses'=>'SaleController@order_view']);

	Route::get('brand/entry', ['as'=>'brand.entry', 'uses'=>'BrandController@brand_entry_form']);
	Route::post('brand/entry', ['as'=>'brand.entry', 'uses'=>'BrandController@brand_save']);

	

	// ajax call
	Route::post('/single-product-info', 'ProductController@get_single_product_info');
	Route::post('/invoice-wise-product', 'ProductController@get_invoice_wise_product');
	Route::post('/invoice-product-count', 'ProductController@get_product_count');
	Route::get('/invoice-product-count/{auto_invoice}', 'ProductController@get_product_count');

	Route::post('/entry-count', 'ProductController@get_entry_count');
	Route::get('/entry-count/{invoice}/{product_id}', 'ProductController@get_entry_count');

});

