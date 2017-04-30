<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;
use App\Settings;
use Storage;

class SettingController extends Controller
{
    public function editbanner($id)
    {
    	$banner = Banners::where('id',$id)->first();
    	return view('admin.pages.editbanner',compact('banner'));
    }
    public function posteditbanner(Request $request)
    {
    	$this->validate($request, [
            
            'banner_url' => 'required',
            'banner_alt' => 'required',
            'id' => 'required'
            ]);
    	$banner = Banners::where('id',$request->input('id'))->first();
    	//$banner->banner_name  = $request->input('banner_name');
    	$banner->banner_url = $request->input('banner_url');
    	//$banner->banner_size = $request->input('banner_size');
    	$banner->banner_alt = $request->input('banner_alt');
    	$file = $request->file('banner_image');
    	if($file!=NULL)
    	{
    		if ($file->isValid()) {
            	$name = time() .'_' . $file->getClientOriginalName();
            	$key = 'banners/' . $name;
            	Storage::disk('s3')->put($key, file_get_contents($file));
            	$banner->banner_image = $key;
        	}	
    	}    	
    	$banner->save();
    	return redirect('admin/banners');


    }
    public function setting()
    {
        $set = Settings::where('id',1)->first();
        return view('admin.pages.settings',compact('set'));
    }
    public function postsetting(Request $request)
    {
        $setting = Settings::where('id',1)->first();
        $setting->homepage_meta_title = $request->input('homepage_meta_title');
        $setting->homepage_meta_descrption = $request->input('homepage_meta_descrption');
        $setting->homepage_keywords = $request->input('homepage_keywords');
        $setting->save();
        return redirect('admin/dashboard');
    }
    
}
