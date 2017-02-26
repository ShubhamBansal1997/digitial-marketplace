<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use App\Payments;
use App\Payouts;
use App\Coupons;
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
 	public function addeditcoupon(Request $request)
    {
    	//dd($request);
        $this->validate($request, [
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
            'coupon_type' => 'required',
            'coupon_category' => 'required',
            'coupon_minimumamount' => 'required',
            'coupon_valid_date' => 'required',

                    ]);
    	
    	
    	if($request->input('id')==NULL)
    	  	$coupon = new Coupons;
    	else
    	{
    		$id = $request->input('id');
			$coupon = Coupons::where('id',$id)->first();	
    	}
    	$coupon->coupon_name = $request->input('coupon_name');
    	$coupon->coupon_code = strtoupper($request->input('coupon_code'));
    	$coupon->coupon_amount = $request->input('coupon_amount');
    	$coupon->coupon_type = $request->input('coupon_type');
    	$coupon->coupon_category = $request->input('coupon_category');
    	$coupon->coupon_minimumamount = $request->input('coupon_minimumamount');
        //dd()
        
        $date = $request->coupon_valid_date;
       
        $time = strtotime($date);

        $newformat = date('Y-m-d',$time);
        //dd($newformat);
        //$date = date_create_from_format('M/d/Y:H:i:s', $request->coupon_valid_date);
        $coupon->coupon_valid_date = $newformat;
    	$coupon->coupon_active = TRUE;
    	$coupon->coupon_delete = FALSE;
    	$coupon->save();
    	return redirect('admin/coupon');

    }
    public function viewaddeditcoupon($id=NULL)
    {
    	if($id!=NULL)
    	{
    		$coup = Coupons::where('id',$id)->first();
    		return view('admin.pages.addeditcoupon',compact('coup'));
    	}
    	else
    	{
    		return view('admin.pages.addeditcoupon');	
    	}
    	
    }
    public function deletecoupon($id)
    {
    	$coup = Coupons::where('id',$id)->first();
    	$coup->coupon_active = FALSE;
    	$coup->coupon_delete = TRUE;
    	$coup->save();
    	return Redirect::back();
    }
    public function activeinactivecoupon($id)
    {
    	$coup = Coupons::where('id',$id)->first();
    	//dd($category);
    	if($coup->coupon_active==FALSE)
    		$coup->coupon_active=TRUE;
    	else
    		$coup->coupon_active=FALSE;
    	$coup->save();
    	return Redirect::back();
    }   
}
