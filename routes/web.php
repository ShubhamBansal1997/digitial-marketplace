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
//use Session;
use App\Products;
use App\Users;
use App\Custom_Order;
use Redirect as Redirect;
Route::get('/', function () {
    return view('pages.home');
});
Route::post('/login','LoginRegisterController@login')->middleware('web');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
	
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
		Route::get('/banners',function(){
			return view('admin.pages.banner');
		});
		Route::get('/editbanner/{id}','SettingController@editbanner');
		Route::post('/editbanner','SettingController@posteditbanner')->middleware('web');

		Route::get('/admin',function() {
			return view('admin.pages.admin');
		});
		Route::get('addeditadmin/{id?}','VendorController@addeditadmin');
		Route::get('/product',function() {
			return view('admin.pages.product');
		});
		Route::get('/activeinactiveproduct/{id}','ProductController@activeinactiveproduct');
		Route::get('/activeinactivefeaturedproduct/{id}','ProductController@activeinactivefeaturedproduct');
		Route::get('/addeditproduct/{id?}','ProductController@viewaddeditproduct');
		Route::get('/deleteproduct/{id}','ProductController@deleteproduct');
		Route::post('/addeditproduct','ProductController@addeditproduct')->middleware('web');

		Route::get('/customization',function() {
			return view('admin.pages.customizations');
		});
		Route::get('/activeinactivecustomization/{id}','ProductController@activeinactivecustomization');
		Route::get('/addeditcustomization/{id?}','ProductController@viewaddeditcustomization');
		Route::get('/deletecustomization/{idaddeditcustomization}','ProductController@deletecustomization');
		Route::post('/addeditcustomization','ProductController@addeditcustomization')->middleware('web');

		Route::get('/coupon',function() {
			return view('admin.pages.coupon');
		});
		Route::get('/activeinactivecoupon/{id}','PaymentController@activeinactivecoupon');
		Route::get('/addeditcoupon/{id?}','PaymentController@viewaddeditcoupon');
		Route::get('/deletecoupon/{id}','PaymentController@deletecoupon');
		Route::post('/addeditcoupon','PaymentController@addeditcoupon')->middleware('web');

		

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
		Route::get('/users',function(){
			return view('admin.pages.users');
		});
		Route::get('/subscribers',function(){
			return view('admin.pages.subscribers');
		});
		Route::get('/activeinactiveuser/{id}','UserController@activeinactiveuser');
		Route::get('/blockunblockuser/{id}','UserController@blockunblockuser');

		// route to show the list of all the custom-orders
		Route::get('/custom-order',function(){
			return view('admin.pages.custom_order');
		});
		Route::get('/completeincompleteorder',function($id){
			$order = Custom_Order::where('id',$id)->first();
			if($order->order_completed==TRUE)
				$order->order_completed==FALSE;
			else
				$order->order_completed==TRUE;
			$order->save();
			return Redirect::back();
		});
		


	
	
});
Route::get('search/{searchterm}','HomeController@search');
Route::post('searchterm','HomeController@searchterm')->middleware('web');
Route::get('user/account','HomeController@account')->middleware('user');
Route::post('user/updateprofile','HomeController@updateprofile')->middleware(['web','user']);
Route::post('user/updatepassword','HomeController@updatepassword')->middleware(['web','user']);

Route::get('/product/{productnameslug}/{productid}','HomeController@product');


Route::get('/home',function(){
	return view('pages.home');
});
Route::post('/login','LoginRegisterController@login')->middleware('web');
Route::post('/register','LoginRegisterController@register')->middleware('web');
// Route to redirect to facebook login
Route::get('/redirect', 'LoginRegisterController@redirect');
// Route to handle the callback of facebook login
Route::get('/callback', 'LoginRegisterController@callback');

Route::post('subscribe','HomeController@subscribe')->middleware('web');
//Route::get('admin')
// testing routes
Route::get('products',function(){
	$products = Products::where('prod_delete',false)->where('prod_status',true)->where('is_service',false)->get();
	$name = 'All Products';
	return view('pages.products',compact('name','products'));
});
Route::get('services',function(){
	$products = Products::where('prod_delete',false)->where('prod_status',true)->where('is_service',true)->get();
	$name = 'All Services';
	return view('pages.products',compact('name','products'));
});
Route::get('category/{categoryname}/{subcatname}','HomeController@category');
Route::get('/vendor/{vendorname}/{id}','HomeController@vendor');
Route::get('/addtocart/{id}','HomeController@addtocart');
Route::get('/removefromcart/{id}','HomeController@removefromcart');
Route::get('/directcheckout/{id}','HomeController@directcheckout');
Route::get('/cart',function(){
	return view('pages.cart');
});
Route::get('/checkout',function(){
	return view('pages.checkout');
});

Route::get('/logout',function(){
	Session::flush();
	return redirect('/');
});

// Route for custom order page
Route::get('/custom-order',function(){
	if(Session::get(login)==true)
		return view('pages.custom_order');
});
/** the route is for the custom order */
Route::post('/custom-order','HomeController@custom_order')->middleware('web');
/** the route is for the thankyou page of custom order */
Route::get('/thankyou-custom',function(){
	return view('pages.thankyou_custom');
});

Route::get('/testing12345','HomeController@search');