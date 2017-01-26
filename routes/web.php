<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',function() {
	return view('pages.login');
});
Route::post('/login','LoginRegisterController@login')->middleware('web');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', ['middleware' => 'admin']], function () {
	
		Route::get('/dashboard',function() {
			return view('admin.pages.home');
		});
		Route::get('/category',function() {
			return view('admin.pages.category');
		});
		Route::get('/activeinactivecategory/{id}','ProductController@activeinactivecategory');
		Route::get('/addeditcategory/{id?}','ProductController@viewaddeditcategory');
		Route::get('/deletecategory/{id}','ProductController@deletecategory');
		Route::post('/addeditcategory','ProductController@addeditcategory')->middleware('web');

		Route::get('/vendor',function() {
			return view('admin.pages.vendor');
		});
		Route::get('/activeinactivevendor/{id}','VendorController@activeinactivevendor');
		Route::get('/addeditvendor/{id?}','VendorController@viewaddeditvendor');
		Route::get('/deletevendor/{id}','VendorController@deletevendor');
		Route::post('/addeditvendor','VendorController@addeditvendor')->middleware('web');
		Route::get('/vendor/{id}',function($id){
			return view('admin.pages.vendordet',compact('id'));
		});

		Route::get('/product',function() {
			return view('admin.pages.product');
		});
		Route::get('/activeinactiveproduct/{id}','ProductController@activeinactiveproduct');
		Route::get('/activeinactivefeaturedproduct/{id}','ProductController@activeinactivefeaturedproduct');
		Route::get('/addeditproduct/{id?}','ProductController@viewaddeditproduct');
		Route::get('/deleteproduct/{id}','ProductController@deleteproduct');
		Route::post('/addeditproduct','ProductController@addeditproduct')->middleware('web');

		Route::post('/makepayout','PaymentController@makepayout');
		Route::get('/sale',function() {
			return view('admin.pages.sale');
		});
		Route::get('/payment',function(){
			return view('admin.pages.payment');
		});
		Route::get('/coupon',function(){
			return view('admin.pages.coupon');
		});


	
	
});
//Route::get('admin')
