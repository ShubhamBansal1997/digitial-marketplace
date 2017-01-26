<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use App\Payments;
use App\Payouts;
use Session;
use Redirect;
class PaymentController extends Controller
{
 	public function makepayout(Request $request)
 	{
 		$this->validate($request, [
            'payout_mode' => 'required',
            'payout_acc_no' => 'required',
            'payout_acc_ifsc_code' =>'required',
            'payout_amount' => 'required',
            'payout_vendor_id' => 'required',
            'payoutd_note' => 'required',
            'payout_email' => 'required',
            'id' => 'required'
                    ]);
 		$payout = new Payouts;
 		$payout->payout_trid = sha1(md5(time()));
 		$payout->payout_status = TRUE;
 		$payout->payout_mode = $request->input('payout_mode');
 		$payout->payout_acc_no = $request->input('payout_acc_no');
 		$payout->payout_acc_ifsc_code = $request->input('payout_acc_ifsc_code');
 		$payout->payout_amount = $request->input('payout_amount');
 		$payout->payout_vendor_id = $request->input('id');
 		$payout->payout_note = $request->input('payout_note');
 		$payout->payout_email = $request->input('payout_email');
 		$payout->save();
 	}   
}
