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
		Route::get('/service',function() {
			return view('admin.pages.service');
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
		// route to show the list of all product custom order
		Route::get('/product-custom-order',function(){
			return view('admin.pages.product_custom_order');
		});
		// route to show the list of all service order
		Route::get('/service-order',function(){
			return view('admin.pages.service_order');
		});
		// route to show the list of all simple order
		Route::get('/simple-order',function(){
			return view('admin.pages.simple_order');
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
		Route::get('/editserviceorder','PaymentController@editserviceorder');
		Route::post('/editserviceorder','PaymentController@posteditserviceorder')->middleware('web');
		Route::get('/editproductorder','PaymentController@editproductorder');
		Route::post('/editproductorder','PaymentController@posteditproductorder')->middleware('web');
		Route::get('/user/order/{id}',function($id){
			return view('admin.pages.user_order',compact('id'));
		});
		Route::get('/settings','SettingController@setting');
		Route::post('/settings','SettingController@postsetting')->middleware('web');
		


	
	
});
Route::get('search/{searchterm}','HomeController@search');
Route::post('searchterm','HomeController@searchterm')->middleware('web');
Route::get('user/account','HomeController@account')->middleware('user');
Route::post('user/updateprofile','HomeController@updateprofile')->middleware(['web','user']);
Route::post('user/updatepassword','HomeController@updatepassword')->middleware(['web','user']);


//Route to display the single product 
Route::get('/product/{productnameslug}/{productid}','HomeController@product');

// Route to display the single service
Route::get('/service/{servicenameslug}/{serviceid}','HomeController@service');


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


//Route to display all products
Route::get('products',function(){
	$products = Products::where('prod_delete',false)->where('prod_status',true)->where('is_service',false)->get();
	$name = 'All Products';
	return view('pages.products',compact('name','products'));
});

//Route to display all services
Route::get('services',function(){
	$products = Products::where('prod_delete',false)->where('prod_status',true)->where('is_service',true)->get();
	$name = 'All Services';
	return view('pages.services',compact('name','products'));
});

/** Route to display the products of a particular category */
Route::get('product/{categoryname}','HomeController@productcategory');

/** Route to order the service */
Route::get('serviceorder/{serviceid}','HomeController@orderservice')->middleware('login');

/** Route to add service order info */
Route::post('serviceordercheckout','HomeController@orderserviceinfo')->middleware(['web','login']);

/** Route to add service order info */
Route::post('productordercheckout','HomeController@productorder')->middleware(['web','login']);




/** Route to display the services of a particular category */
Route::get('service/{categoryname}','HomeController@servicecategory');

/** Route to buy product directly  */
Route::get('buynowproduct/{id}','HomeController@buynowproduct')->middleware('login');

// Route to display and product and services of a vendor 
Route::get('/vendor/{vendorname}/{id}','HomeController@vendor');

// Route to add the uncustomized product from the cart 
Route::get('/addtocart/{id}','HomeController@addtocart');
// Route to remove the uncustomized product  from the cart
Route::get('/removefromcart/{id}','HomeController@removefromcart');

Route::get('/directcheckout/{id}','HomeController@directcheckout');

Route::post('/productbuy_customizations','HomeController@productbuy_customizations')->middleware(['web','login']);

Route::get('/cart',function(){
	return view('pages.cart');
})->middleware('user');
Route::get('/checkout',function(){
	return view('pages.checkout');
})->middleware('login');

Route::get('/logout',function(){
	Session::flush();
	return redirect('/');
});




// Route for custom order page
Route::get('/custom-order',function(){
	if(Session::get('login')==true)
		return view('pages.custom_order');
});
/** the route is for the custom order */
Route::post('/custom-order','HomeController@custom_order')->middleware('web');
/** the route is for the thankyou page of custom order */
Route::get('/thankyou-custom',function(){
	return view('pages.thankyou_custom');
});
Route::group(['middleware' => ['web']], function () {
    Route::get('payPremium', ['as'=>'payPremium','uses'=>'PaypalController@payPremium']);
    Route::get('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);
    Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
    Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
});
Route::get('testing-123','PaypalController@getCheckout');


Route::get('/testing12345','HomeController@search');