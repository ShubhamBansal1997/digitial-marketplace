<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use App\Users;
use App\Products;
class VendorController extends Controller
{
    public function addeditvendor(Request $request)
    {
    	
    	$this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'user_email' => 'required|email',
            'mobile' => 'required|max:10',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required'
                    ]);
    	$id = $request->input('id'); 
    	if($id==NULL)
    	{
    		$this->validate($request, [
    			'user_email' => 'unique:users|required|email' ]);
    	}

    	$category_name = $request->input('category_name');
    	$user = new Users;
    	if($id!=NULL)
    	{
    	  	$user = Users::where('id',$id)->first();
    	}
    	$user->user_fname = $request->input('f_name');
    	$user->user_lname = $request->input('l_name');
    	$user_name = $user->user_fname . ' ' . $user->user_lname;
    	$user->user_email = $request->input('user_email');
    	if($request->input('pwd')!=NULL)
    		$user->user_pwd = \Hash::make($request->input('pwd'));
    	$category->user_slug = str_replace(' ', '-', $user->user_name);
    	$user->user_mobile = $request->input('mobile');
    	$user->user_address = $request->input('address');
    	$user->user_country = $request->input('country');
    	$user->user_state = $request->input('country');
    	$user->user_city = $request->input('city');
    	$user->user_zip = $request->input('zip');
    	$user->user_state = TRUE;
    	$user->user_delete = FALSE;
    	$user->user_accesslevel = 2;
    	$user->save();
    	return redirect('admin/vendor');

    }
    public function viewaddeditvendor($id=NULL)
    {
    	if($id!=NULL)
    	{
    		$ved = Users::where('id',$id)->first();
    		return view('admin.pages.addeditvendor',compact('ved'));
    	}
    	else
    	{
    		return view('admin.pages.addeditvendor');	
    	}
    	
    }
    public function deletevendor($id)
    {
    	$vendor = Users::where('id',$id)->first();
    	$vendor->user_state = FALSE;
    	$vendor->user_delete = TRUE;
    	$vendor->save();
    	Products::where('prod_vendor_id', '=', $vendor->id)
    		->update(['prod_delete' => '1']);
    	/** also delete the product associated with the vendor **/
    	return Redirect::back();
    }
    public function activeinactivevendor($id)
    {
    	$vendor = Users::where('id',$id)->first();
    	//dd($category);
    	if($vendor->user_state==FALSE)
    	{
    		$vendor->user_state=TRUE;

    	}
    	else
    	{
    		Products::where('prod_vendor_id', '=', $vendor->id)
    		->update(['prod_status' => '0']);
    		$vendor->user_state=FALSE;
    		/* also deactivate the product associated with the vendor**/
    	}
    	$vendor->save();
    	return Redirect::back();
    }
}
