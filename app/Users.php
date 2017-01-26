<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //use Notifiable;
	protected $table_name = 'users';
	public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_fname', 'user_lname', 'user_email', 'user_mobile', 'user_address', 'user_country', 'user_state', 'user_city', 'user_zip', 'user_status', 'user_accesslevel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_pwd',
    ];

    public static function username($id)
    {
        $user = Users::where('id',$id)->first();
        $username = $user->user_fname . ' ' . $user->user_lname;
        return $username;
    }
}
