<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'coupons';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_name', 'coupon_code', 'coupon_amount', 'coupon_type','coupon_active','coupon_category','coupon_minimumamount','coupon_delete', 'coupon_valid_date'
    ];
}
