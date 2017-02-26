<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;

class UserController extends Controller
{
    public function activeinactiveuser($id)
    {
    	$user = Users::where('id',$id)->first();
    	if($user->user_state==FALSE)
    		$user->user_state = FALSE;
    	else
    		$user->user_state = TRUE;
    	$user->save();
    	return Redirect::back();
    }
    public function blockunblockuser($id)
    {
    	$user = Users::where('id',$id)->first();
    	if($user->user_delete==FALSE)
    	{
    		$user->user_delete = TRUE;
    	}
    	else
    	{
    		$user->user_state = TRUE;
    		$user->user_delete = FALSE;
    	}
    	$user->save();
    	return Redirect::back();
    }
}
