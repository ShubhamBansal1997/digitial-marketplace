<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_trid', 'payment_status', 'payment_mode', 'payment_amount','payment_email','payment_admin_commission','payment_vendor_commission','payment_discount','payment_base','payment_discount_code','payment_prod_id','payment_vendor_id','payment_user_id','payment_order_type'
            // 1=> simple order
            // 2=> service order
            // 3=> product custom order
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
