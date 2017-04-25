<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom_Order extends Model
{
    protected $table_name = 'custom_orders';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_work', 'order_descrption', 'order_price','order_sample_file','order_completed'
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
}
