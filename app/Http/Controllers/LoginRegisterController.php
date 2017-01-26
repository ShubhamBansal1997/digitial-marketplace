<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Redirect;
use Session;
class LoginRegisterController extends Controller
{
    public function login(Request $request)
    {	
    	$this->validate($request, [
            'email' => 'required',
            'password' => 'required'
                    ]);
    	$email = $request->input('email');
    	$password = $request->input('password');
    	//$password = \Hash::make($password);
    	//dd($password);
    	$user = Users::where('user_email',$email)->first();
    	$test = \Hash::check($password, $user->user_pwd);
    	//dd($test);
    		
    	if(\Hash::check($password, $user->user_pwd)==FALSE)
    	{
    		Session::flash('wrong_cred', 'Wrong Email or Password');
    		return Redirect::back();
    	}
    	else
    	{
    		//$user = $user->first();
    		$email = $user->user_email;
    		Session::set('email',$email);
    		//dd($user);
    		$accesslevel = $user->user_accesslevel;
    		if($accesslevel==1)
    		{
    			//dd("HELLO");
    			Session::set('login_type','user');
    			return redirect('admin/dashboard');
    		}
    		else if($accesslevel==2)
    		{
    			Session::set('login_type','vendor');
    			return redirect('vendor/dashboard');
    		}
    		else if($accesslevel==3)
    		{
    			Session::set('login_type','admin');
    			return redirect('admin/dashboard');
    		}
    	}



    }
}
