<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;
use Storage;
class Banners extends Model
{
    protected $table_name = 'banners';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_name', 'banner_image', 'banner_url', 'banner_size', 'banner_alt'
    ];

    public static function getFileUrl($key) {
        if($key==NULL)
            return "test";
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
    public static function bdet($key)
    {
    	$banner = Banners::where('banner_name',$key)->get();
    	return $banner;
    }
    
}
