<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Users;
use App\Products;
use App\Category;
use Redirect;
use Session;
use Cart;

class HomeController extends Controller
{
    public function subscribe(Request $request)
    {
    	$this->validate($request, [
            'email' => 'required|email|unique:subscribers']);
    	$subscribers = new Subscriber;
    	$subscribers->email = $request->input('email');
    	$subscribers->save();
    	return Redirect::back();
    }
    public function account()
    {
    	$email = Session::get('email');
    	$user = Users::where('user_email',$email)->first();
    	return view('pages.account',compact('user'));


    }
    public function updateprofile(Request $request)
    {
    	$this->validate($request, [
    		'user_fname' => 'required',
    		'user_lname' => 'required',
    		'user_email' => 'required',
    		]);
    	if(Session::get('email')!=$request->input('user_email'))
    	{
    		$this->validate($request, [
    			'user_email' => 'require|unique:users',
    			]);
    	}
    	$user = Users::where('user_email',Session::get('email'))->first();
    	$user->user_fname = $request->input('user_fname');
    	$user->user_lname = $request->input('user_lname');
    	$user->user_email = $request->input('user_email');
    	Session::put('email',$request->input('user_email'));
    	$user->save();
    	return Redirect::back();
    }
    public function updatepassword(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'new_password' => 'required',
    		'new_password1' => 'required',
    		]);
    	if($request->input('new_password')!=$request->input('new_password1'))
    	{
    		return Redirect::back();
    	}
    	else 
    	{
    		$user = Users::where('user_email',Session::get('email'))->first();
    		if(\Hash::check($request->input('old_password'), $user->user_pwd)==FALSE)
    		{
    			return Redirect::back();
    		}
    		else
    		{
    			$user->user_pwd = bcrypt($request->input('new_password'));
    			$user->save();
    			return Redirect::back();
    		}
    	}
    }
    public function product($productnameslug, $productid)
    {
    	$product = Products::where('prod_slug',$productnameslug)->where('id',$productid)->first();
    	return view('pages.product',compact('product'));
    }
    public function vendor($vendorname,$id)
    {
    	$vendor = Users::where('user_slug',$vendorname)->where('id',$id)->first();
    	if($vendor==NULL)
    		return Redirect::back();
    	if(Session::get('range')==NULL)
    		Session::put('range','high');
    	if(Session::get('range')=='high')
    	{
    		$products = Products::where('prod_vendor_id',$id)->orderBy('prod_price','DESC')->get();	
    	}
    	else
    	{
    		$products = Products::where('prod_vendor_id',$id)->orderBy('prod_price','ASC')->get();
    	}
    	return view('pages.vendorproduct',compact('vendor','products'));
    	
    }
    public function addtocart($id)
    {	
    	$product = Products::where('id',$id)->first();
    	$url = Products::getFileUrl($product->prod_image);
    	$vendor_name = Users::username($product->prod_vendor_id);
    	//dd(Cart::content());
    	foreach(Cart::content() as $row)
    	{
    		if($row->id == $id)
    			return Redirect::back();
    	}

    	Cart::add(['id' => $product->id, 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'options' => ['pic' => $url, 'vendor_name' => $vendor_name,'is_service' => $product->is_service, 'prod_slug' => $product->prod_slug ]]);
    	return Redirect::back();
    }
    public function removefromcart($id)
    {
    	Cart::remove($id);
    	return Redirect::back();
    }
    public function directcheckout($id)
    {
        $product = Products::where('id',$id)->first();
        $url = Products::getFileUrl($product->prod_image);
        $vendor_name = Users::username($product->prod_vendor_id);
        //dd(Cart::content());
        foreach(Cart::content() as $row)
        {
            if($row->id == $id)
                return Redirect::back();
        }

        Cart::add(['id' => $product->id, 'name' => $product->prod_name, 'qty' => 1, 'price' => $product->prod_price, 'options' => ['pic' => $url, 'vendor_name' => $vendor_name,'is_service' => $product->is_service, 'prod_slug' => $product->prod_slug ]]);
        return redirect('checkout');
    }
    public function category($categoryname, $subcatname)
    {
        
        $catname = str_replace('-', ' ', $categoryname);
        $subcatname = str_replace('-', ' ', $subcatname);
        //$array = array();
        $cat = Category::where('category_name',$subcatname)->first();
        
        //$array = array($cat->id);
        if($cat==NULL)
            return Redirect::back();

        $id = $cat->id;
        
        $products = Products::where('prod_categories', 'LIKE', "%$id%")->where('prod_delete',false)->where('prod_status',true)->get();
        // dd("shubham");
        // dd($products);
        $name = $subcatname;
        return view('pages.products',compact('name','products','catname'));

    }
}
