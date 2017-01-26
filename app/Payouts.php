<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payouts extends Model
{
    protected $table_name = 'payouts';
	public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payout_trid', 'payout_status', 'payout_mode', 'payout_acc_no','payout_acc_ifsc_code','payout_email','payout_amount','payout_vendor_id','payout_note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
