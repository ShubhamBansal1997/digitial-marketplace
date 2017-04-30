<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customizations extends Model
{
    protected $table = 'customizations';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customization_name', 'customization_price','customizations_time'
    ];

    public static function cust_name($id)
    {
        $cust = Customizations::where('id',$id)->first();
        return $cust->customization_name;
    }
    public static function cust_price($id)
    {
        $cust = Customizations::where('id',$id)->first();
        return $cust->customization_price;
    }
}
