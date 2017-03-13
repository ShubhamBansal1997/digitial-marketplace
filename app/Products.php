<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Storage;
use Config;

class Products extends Model
{
    protected $table_name = 'products';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prod_name', 'prod_slug', 'prod_image', 'prod_image_alt', 'prod_image1', 'prod_image_alt1', 'prod_image2', 'prod_image_alt2', 'prod_image3', 'prod_image_alt3', 'prod_image4', 'prod_image_alt4', 'prod_image5', 'prod_image_alt5', 'prod_image6', 'prod_image_alt6', 'prod_tags', 'prod_descrption', 'prod_demourl', 'prod_categories', 'prod_price', 'prod_customize_price', 'prod_status', 'prod_delete', 'prod_vendor_id', 'prod_download', 'prod_featured','prod_file','prod_meta_descrption','prod_meta_title','is_service'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
    public static function product_name($id)
    {
        $prod = Products::where('id',$id)->first();
        return $prod->prod_name;
    }
    public static function getCategory($id)
    {
        $prod = Products::where('id',$id)->first();
        $prod_categories = $prod->prod_categories;
        $category = array(); 
        foreach($prod_categories as $prod_category)
        {
            array_push($category,Category::cat_name($prod_category));
        }
        return $category;
    }
}
