<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Order extends Model
{
    public $table = "service_orders";
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_id', 'service_message1', 'service_message2', 'service_name','service_sample_file','service_completed','service_payment_id','service_file'
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
    public static function completed($id)
    {   
        $service = Service_Order::where('service_payment_id',$id)->first();
        return $service->service_completed;
    }
    public static function get_id($id)
    {
        $service = Service_Order::where('service_payment_id',$id)->first();
        return $service->id;
    }
}
