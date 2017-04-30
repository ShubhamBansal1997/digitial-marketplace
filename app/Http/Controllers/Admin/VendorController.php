<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use App\Users;
use App\Products;
use Storage;
use Config;
//use helpers;
class VendorController extends Controller
{
    public function addeditvendor(Request $request)
    {
        
        //dd($request);
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'user_email' => 'required|email',
            'mobile' => 'required|max:10'
                    ]);
        $id = $request->input('id'); 
        if($id==NULL)
        {
            $this->validate($request, [
                'user_email' => 'unique:users|required|email' ]);
        }

        $user = new Users;
        if($id!=NULL)
        {
            $user = Users::where('id',$id)->first();
        }
        $user->user_fname = $request->input('f_name');
        $user->user_lname = $request->input('l_name');
        $user_name = $user->user_fname . ' ' . $user->user_lname;
        $file = $request->file('profile_image');
        if ($file!=NULL) {
            $name = time() .'_' . $file->getClientOriginalName();
            $key = 'profile_images/' . $name;
            Storage::disk('s3')->put($key, file_get_contents($file));
            $user->user_profile_image = $key;
            
        }
        
        
        $user->user_email = $request->input('user_email');
        if($request->input('pwd')!=NULL)
            $user->user_pwd = \Hash::make($request->input('pwd'));
        $user->user_slug = str_replace(' ', '-', $user_name);
        $user->user_mobile = $request->input('mobile');
        $user->user_address = $request->input('address');
        $user->user_country = $request->input('country');
        $user->user_state = $request->input('country');
        $user->user_city = $request->input('city');
        $user->user_zip = $request->input('zip');
        $user->user_state = TRUE;
        $user->user_delete = FALSE;
        $user->user_descrption = $request->input('user_descrption');
        $user->user_meta_title = $request->input('user_meta_title');
        $user->user_meta_descrption = $request->input('user_meta_descrption');
        $user->user_payment_details = $request->input('user_payment_details');
        if($request->input('admin')==1)
        {
            $user->user_accesslevel = 1;
            $user->save();
            return redirect('admin/vendor');    
        }
        else
        {
            $user->user_accesslevel = 2;
            $user->save();
            return redirect('admin/admin');
        }
        

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
    public function addeditadmin($id=NULL)
    {
        if($id!=NULL)
        {
            $ved = Users::where('id',$id)->first();
            return view('admin.pages.addeditadmin',compact('ved'));
        }
        else
        {
            return view('admin.pages.addeditadmin');   
        }
    }
    public function deletevendor($id)
    {
        $vendor = Users::where('id',$id)->first();
        $vendor->user_state = FALSE;
        $vendor->user_delete = TRUE;
        $vendor->save();
        Products::where('prod_vendor_id', '=', $vendor->id)
            ->update(['prod_delete' => '1'])
            ->update(['prod_status' => '0']);
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
