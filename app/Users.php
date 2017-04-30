<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Config;
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
        'user_profile_image','user_fname', 'user_lname', 'user_email', 'user_mobile', 'user_address', 'user_country', 'user_state', 'user_city', 'user_zip', 'user_status', 'user_accesslevel','user_slug'
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
        //dd($id);
        $user = Users::where('id',$id)->first();
        $username = $user->user_fname . ' ' . $user->user_lname;
        return $username;
    }
    public static function get_email($id)
    {
        $user = User::where('id',$id)->first();
        return $user->user_email;
    }
    public static function get_slug($id)
    {
        $user = User::where('id',$id)->first();
        return $user->user_slug;
    }
    public static function profile_image($key)
    {
         
        if($key==NULL)
            return 'test';
        //dd($key);
        //$key = 'profile_images/1513653268678033.jpg';
        $s3 = Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $bucket = Config::get('filesystems.disks.s3.bucket');

        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key
        ]);

        $request = $client->createPresignedRequest($command, '+10 minutes');

        return (string) $request->getUri();
    }
}
