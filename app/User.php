<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
}
