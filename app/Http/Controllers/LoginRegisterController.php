<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Redirect;
use Session;
use Socialite;
use Storage;
use Config;

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
        if($user==NULL)
            return Redirect::back();
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
            Session::put('email',$email);
            Session::put('login',true);
            //dd($user);
            $accesslevel = $user->user_accesslevel;
            if($accesslevel==1)
            {
                //dd("HELLO");
                Session::put('login_type','admin');
                return redirect('admin/dashboard');
            }
            else if($accesslevel==2)
            {
                Session::put('login_type','vendor');
                return redirect('vendor/account');
            }
            else if($accesslevel==3)
            {
                Session::put('login_type','user');
                return redirect('user/account');
            }
        }



    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'user_fname' => 'required',
            'user_lname' => 'required',
            'user_email' => 'required|unique:users',
            'user_pwd' => 'required',
            ]);
        $user = new Users;
        $user->user_fname = $request->input('user_fname');
        $user->user_lname = $request->input('user_lname');
        $user->user_email = $request->input('user_email');
        $user->user_pwd = bcrypt($request->input('user_pwd'));
        $user->user_accesslevel = 3;
        $user->save();
        Session::put('email',$request->input('user_email'));
        Session::put('login_type','user');
        Session::put('login',true);
        return redirect('user/account');

    }
    public function redirect()
    {
        return Socialite::with('facebook')->redirect(); 
    }
    public function callback()
    {
        try {

            $socialUser = Socialite::with('facebook')->stateless()->user();

        } 

        catch (Exception $e) {
            
            return redirect ('/');
        }

        $fullname = $socialUser->getName();
        $name = explode(" ", $fullname);
        $firstname = $name[0];
        $lastname = $name[1];
        $email = $socialUser->getEmail();
        $name_slug = str_replace(' ', '-', $fullname);
        $pwd = mt_rand(100000, 999999);
        $pwd = bcrypt($pwd);
        $profile_pic = file_get_contents($socialUser->getAvatar());
        $filename = $socialUser->getId(). ".jpg";
        file_put_contents($filename, $profile_pic);
        if ($profile_pic!=NULL) {
            $filename = $socialUser->getId(). ".jpg";
            //$filename = time() .'_' . $profile_pic->getClientOriginalName();
            $key = 'profile_images/' . $filename;
            Storage::disk('s3')->put($key, file_get_contents($filename));
            $profile_pic = $key;
            
        }

        $user = Users::where('user_email',$email)->first();
        if($user==NULL)
        {
            $user = new Users;
            $user->user_accesslevel = 3;
            $user->user_pwd = $pwd;
        }
        $user->user_fname = $firstname;
        $user->user_lname = $lastname;
        $user->user_profile_image = $profile_pic;
        $user->user_slug = $name_slug;
        $user->user_email = $email;
        $user->save();
        $user = Users::where('user_email',$email)->first();

        $accesslevel = $user->user_accesslevel;
        Session::put('email',$email);
        Session::put('login',true);
        if($accesslevel==1)
        {
            //dd("HELLO");
            Session::put('login_type','admin');
            return redirect('admin/dashboard');
        }
        else if($accesslevel==2)
        {
            Session::put('login_type','vendor');
            return redirect('vendor/dashboard');
        }
        else if($accesslevel==3)
        {
            Session::put('login_type','user');
            return redirect('user/account');
        }
    }
}
