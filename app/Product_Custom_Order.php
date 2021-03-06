<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customizations;

class Product_Custom_Order extends Model
{
    public $table = "product_custom_orders";
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'product_message1', 'product_message2', 'product_name','product_sample_file','product_completed','product_active','product_customization','product_payment_id','product_file'
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
    public static function Customizations($key)
    {
        $value = array();
        foreach(explode(",", $key) as $id)
        {
            array_push($value, Customizations::cust_name($id));
        }
        $custom = implode(",", $value);
        return $custom
    }
}
