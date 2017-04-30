<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Users;
use App\Products;
use App\Category;
use App\Custom_Order;
use App\Service_Order;
use App\Product_Custom_Order;
use App\Customizations;
use Redirect;
use Session;
use Cart;
use Storage;

class HomeController extends Controller
{
    public function custom_order(Request $request)
    {
        $this->validate($request,[
            'order_work' => 'required',
            'order_descrption' => 'required',
            'order_price' => 'required',
            'order_sample_file' => 'required'
            ]);
        $custom_order = new Custom_Order;
        $user = Users::where('user_email',Session::get('email'))->first();
        $custom_order->user_id = $user->id;
        $custom_order->order_work = $request->input('order_work');
        $custom_order->order_descrption = $request->input('order_descrption');
        $custom_order->order_price = $request->input('order_price');
        if($request->file('order_sample_file')!=NULL)
            $custom_order->order_sample_file = $this->uploadfile($request->file('order_sample_file'));

        $custom_order->order_completed = 0;
        $custom_order->save();
        return redirect('thankyou-custom');
    }
    /** The function is used to upload file to s3 bucket */

    public function uploadfile($file)
    {
        
        if($file!=NULL)
        {
            if ($file->isValid()) {
                $name = time() .'_' . $file->getClientOriginalName();
                $key = 'custom_order/' . $name;
                Storage::disk('s3')->put($key, file_get_contents($file));
                return $key;
            }
        }
    }

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
    /** The function is used to update the profile in the account section in the hompage */
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
        if($user->user_pwd!=null)
            $user->user_pwd = bcrypt($request->input('user_pwd'));
        Session::put('email',$request->input('user_email'));
        $user->save();
        return Redirect::back();
    }
    /** The function is disposed of due to change in design */
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

    /** end of the function  */


    /** function to display the single product 
    Route linked ==> /product/{productnameslug}/{productid}
    */
    public function product($productnameslug, $productid)
    {
        $product = Products::where('prod_slug',$productnameslug)->where('id',$productid)->where('is_service',false)->first();
        return view('pages.product',compact('product'));
    }
    /** end of the function */


    /** function to display the single service 
    Route linked ==> /service/{productnameslug}/{productid}
    */
    public function service($servicenameslug, $serviceid)
    {
        $product = Products::where('prod_slug',$servicenameslug)->where('id',$serviceid)->where('is_service',true)->first();
        return view('pages.service',compact('product'));
    }
    /** end of the function */

    /** function to display the services and products of a vendor */
    public function vendor($vendorname,$id)
    {
        $vendor = Users::where('user_slug',$vendorname)->where('id',$id)->first();
        if($vendor==NULL)
            return Redirect::back();
        $products = Products::where('prod_vendor_id',$id)->orderBy('prod_price','DESC')->get(); 
        return view('pages.vendorproduct',compact('vendor','products'));
        
    }
    /** end of the function  */

    /** function to add product without customization to cart */
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
    /** end of cart */

    /** function to order a service */
    public function orderservice($serviceid)
    {
        
            if(Session::get('login')!=true)
                return Redirect::back();
            $service = Products::where('id',$serviceid)->first();
            //dd($service);
            return view('pages.serviceorder',compact('service'));    
        
    }
    /** end of the function */

    /** function to add the service order info */
    public function orderserviceinfo(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'reference_file' => 'file',
            ]);
        //$service = 
        $service_order = new Service_Order;
        $email = Session::get('email');
        //dd($email);
        $user = Users::where('user_email',$email)->first();
        $service_order->user_id = $user->id;
        $service_order->service_id = $request->input('service_id');
        $service_order->service_message1 =  $request->input('message1');
        $service_order->service_name = $request->input('name');
        if($request->file('order_sample_file')!=NULL)
            $custom_order->order_sample_file = $this->uploadfile($request->file('order_sample_file'));
        $service_order->service_completed = false;
        $service_order->save();
        return redirect('/checkout'); 
    }
    /** end of the function */

    /** function to add the service order info */
    public function productorder(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'reference_file' => 'file',
            ]);
        //$service = 
        $service_order = new Product_Custom_Order;
        $email = Session::get('email');
        //dd($email);
        $user = Users::where('user_email',$email)->first();
        $service_order->user_id = $user->id;
        $service_order->product_id = $request->input('product_id');
        $service_order->product_message1 =  $request->input('message1');
        $service_order->product_name = $request->input('name');
        if($request->file('order_sample_file')!=NULL)
            $custom_order->product_sample_file = $this->uploadfile($request->file('order_sample_file'));
        $service_order->product_completed = false;
        $service_order->product_customizations = $request->input('custom');
        $service_order->save();
        return redirect('/checkout'); 
    }
    /** end of the function */

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
        return redirect('/cart');
    }

    /** function to display the products of a category  */
    public function productcategory($categoryname)
    {
        
        $catname = str_replace('-', ' ', $categoryname);
        //$array = array();
        $cat = Category::where('category_name',$catname)->first();
        
        //$array = array($cat->id);
        if($cat==NULL)
            return Redirect::back();

        $id = $cat->id;
        
        $products = Products::where('prod_categories', 'LIKE', "%$id%")->where('prod_delete',false)->where('prod_status',true)->where('is_service',false)->get();
        // dd("shubham");
        // dd($products);
        $name = $categoryname;
        return view('pages.productcategory',compact('name','products'));

    }
    /** function end here */

    /** function to display the services of a category  */
    public function servicecategory($categoryname)
    {
        
        $catname = str_replace('-', ' ', $categoryname);
        //$array = array();
        $cat = Category::where('category_name',$catname)->first();
        
        //$array = array($cat->id);
        if($cat==NULL)
            return Redirect::back();

        $id = $cat->id;
        
        $products = Products::where('prod_categories', 'LIKE', "%$id%")->where('prod_delete',false)->where('prod_status',true)->where('is_service',true)->get();
        // dd("shubham");
        // dd($products);
        $name = $categoryname;
        return view('pages.servicecategory',compact('name','products'));

    }
    /** function end here */

    public function productbuy_customizations(Request $request)
    {
        if($request->input('customizations')==NULL)
        {
            if($request->input('buy_now')=='true')
            {
                $url = '/directcheckout/' . $request->input('product_id');
                return redirect($url);
            }
            elseif($request->input('add_to_cart')=='true')
            {
                $url = '/addtocart/' . $request->input('product_id');
                return redirect($url);
            }
        }
        else
        {
            $sum = 0;
            $customs = implode(",", $request->input('customizations'));
            foreach($request->input('customizations') as $customization)
            {   
                $custom = Customizations::where('id',$customization)->first();
                $sum = $sum + $custom->customization_price;
            }
            $product = Products::where('id',$request->input('product_id'))->first();
            $sum = $sum + $product->prod_price;
            $price = $sum;


            return view('pages.productorder',compact('customs','price','product'));
        }
    }

    public function searchterm(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            ]);
        $redirect = 'search/' . $request->search;
        return redirect($redirect);
    }
    public function search($searchterm)
    {
        $products = Products::where('prod_delete',false)
            ->where('prod_status',true)
            ->search($searchterm)
            ->with('users')
            ->get();
            $name = $searchterm;
        return view('pages.search',compact('products','name'));
    }
    
}