<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
	    $this->theme = $this->ts_functions->current_theme();
	}

    /*********** Check Product Plan and User's Membership  STARTS *******************/

    function checkmembership($prodid='') {
        if($prodid != '') {
            if( isset($this->session->userdata['ts_uid']) ) {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$this->session->userdata('ts_uid')));

                if( $userDetail[0]['user_plans'] == 0 ) {
                    // No plan selected by user
                    $this->session->set_flashdata('plan_message', 'Upgrade your plan to access this product.');
                    redirect(base_url().'home/plans_pricing');
                }

                $prodDetail = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodid,'prod_status'=>1));
                if(!empty($prodDetail)) {
                    redirect(base_url().'dashboard/purchased');
                }
                else {
                    redirect(base_url());
                }
            }
            else {
                redirect(base_url().'home/plans_pricing');
            }
        }
        else {
            redirect(base_url());
        }
    }

    /*********** Check Product Plan and User's Membership ENDS *******************/

    /*********** Add Products to Cart STARTS *******************/
    function add_to_cart($type='',$id = ''){
        if($type == 'plan') {
            $details = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$id,'plan_status'=>1));
        }
        elseif($type == 'vendor_plan') {
            $details = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$id,'vplan_status'=>1));
        }
        else {
            $details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$id,'prod_status'=>1));
        }
        if( !empty($details) ) {

            /***** check for FREE products STARTS *******/

            if( isset($details[0]['prod_free']) && $details[0]['prod_free'] == '1' ) {
                if( isset($this->session->userdata['ts_uid']) ) {
                    redirect(base_url().'dashboard/free_downloads');
                }
                else {
                    redirect(base_url().'authenticate/login');
                }
            }
            /***** check for FREE products ENDS *******/

            /***** check for FREE products STARTS *******/

            if( isset($details[0]['prod_plan']) && $details[0]['prod_plan'] == '1' ) {
                if( isset($this->session->userdata['ts_uid']) ) {
                    redirect(base_url().'dashboard/free_downloads');
                }
                else {
                    redirect(base_url().'authenticate/login');
                }
            }
            /***** check for FREE products ENDS *******/


            if(!isset($_COOKIE['cartCookies'])){
                $cartArr = array();
                $str = base64_encode($type.'#'.$id);
                array_push($cartArr,$str);
            }
            else {
                $cartArr = json_decode($_COOKIE['cartCookies'],true);
                $err = 0;
                for($i=0;$i<count($cartArr);$i++) {
                    $prodDetails = base64_decode($cartArr[$i]);
                    $prodDetailsArr = explode('#',$prodDetails);

                    if($prodDetailsArr[1] == $id) {
                        $err++;
                    }
                }
                if( $err == '0' ) {
                    $str = base64_encode($type.'#'.$id);
                    array_push($cartArr,$str);
                }
            }
            setcookie("cartCookies", json_encode($cartArr,true) , time()+3600 * 24 * 90,'/');
            redirect(base_url().'shop/cart');
        }
        else {
            redirect(base_url());
        }
    }
    /*********** Buy plans ENDS *******************/


    /*********** Buy plans STARTS *******************/
    function cart(){
        $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;

        if(empty($cartArr)) { redirect(base_url()); }
        $data['cartArr'] = $cartArr;
        $data['basepath'] = base_url();
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/cart',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);

    }
    /*********** Buy plans ENDS *******************/

    /*********** Remove Cart STARTS *******************/
    function remove_cart($key='') {
        $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;
        if(empty($cartArr)) { redirect(base_url()); }
        $newCartArr = array();
        for($i=0;$i<count($cartArr);$i++) {
            if($i != $key) {
                array_push($newCartArr,$cartArr[$i]);
            }
        }

        setcookie("cartCookies", json_encode($newCartArr,true) , time()+3600 * 24 * 90,'/');
        redirect(base_url().'shop/cart');
    }
    /*********** Remove Cart ENDS *******************/

    /*********** Initiate payment depending on option STARTS *******************/
    function proceed_payment() {
        if( !isset($this->session->userdata['ts_uid']) ) {
            echo 'EXISTS';
            die();
        }
        if(isset($_POST['paymentmethod'])) {
            $cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;

            if(empty($cartArr)) { echo 'empty'; } else {
                $prodStr = $prodCode = '';
                $prodAmount = $prodActualCost = $prodDiscount = array();
                for($i=0;$i<count($cartArr);$i++) {
                    $prodDetails = base64_decode($cartArr[$i]);
                    $prodDetailsArr = explode('#',$prodDetails);
                    if( count($prodDetailsArr) == '2' ) {
                        $id = $prodDetailsArr[1];
                        if( $prodDetailsArr[0] == 'products' ) {
                            $details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$id,'prod_status'=>1));
                            if($details[0]['prod_uid'] == $this->session->userdata['ts_uid']){
                                // Owner's Products
                                echo 'OWNER';
                                die();
                            }

                            if(!empty($details)) {
                            	$pCode = 'prodID_'.$details[0]['prod_id'].'_products';
                            	
                            	$prodStr .= $details[0]['prod_name'].' , ';
	                            $prodCode .= $details[0]['prod_uniqid'].' , ';
	                                
                            	if( isset($_COOKIE[$pCode]) ) {
                            		$price_arr = explode('@#',$_COOKIE[$pCode]);
                            		$amnt = $price_arr[1];
                            		$discnt = $price_arr[0];
                            	}
                            	else {
	                                $amnt = $details[0]['prod_price'];
	                                $discnt = 0;
                            	}                            
                                array_push($prodAmount,$amnt);
                                array_push($prodDiscount,$discnt);
                                array_push($prodActualCost,$details[0]['prod_price']);
                                
                            }
                        }
                        elseif( $prodDetailsArr[0] == 'vendor_plan' ) {
                            $details = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$id,'vplan_status'=>1));
                            if(!empty($details)) {
                                
                                $pCode = 'prodID_'.$details[0]['vplan_id'].'_vplans';
                            	
                            	$prodStr .= $details[0]['vplan_name'].' , ';
	                            $prodCode .= $details[0]['vplan_id'].' , ';
	                                
                            	if( isset($_COOKIE[$pCode]) ) {
                            		$price_arr = explode('@#',$_COOKIE[$pCode]);
                            		$amnt = $price_arr[1];
                            		$discnt = $price_arr[0];
                            	}
                            	else {
	                                $amnt = $details[0]['vplan_amount'];
	                                $discnt = 0;
                            	}                            
                                array_push($prodAmount,$amnt);
                                array_push($prodDiscount,$discnt);
                                array_push($prodActualCost,$details[0]['vplan_amount']);
                            }
                        }
                        else {
                            $details = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$id,'plan_status'=>1));
                            if(!empty($details)) {
                            
                            	$pCode = 'prodID_'.$details[0]['plan_id'].'_plans';
                            	
                            	$prodStr .= $details[0]['plan_name'].' , ';
	                            $prodCode .= $details[0]['plan_id'].' , ';
	                                
                            	if( isset($_COOKIE[$pCode]) ) {
                            		$price_arr = explode('@#',$_COOKIE[$pCode]);
                            		$amnt = $price_arr[1];
                            		$discnt = $price_arr[0];
                            	}
                            	else {
	                                $amnt = $details[0]['plan_amount'];
	                                $discnt = 0;
                            	}                            
                                array_push($prodAmount,$amnt);
                                array_push($prodDiscount,$discnt);
                                array_push($prodActualCost,$details[0]['plan_amount']);
                            }
                        }

                    }
                }

                $finalItemName = rtrim( trim($prodStr) ,',');
                $finalItemNumber = rtrim( trim($prodCode) ,',');

                $finalItemAmount = array_sum($prodAmount);
                $finalItemDiscount = array_sum($prodDiscount);
                $finalItemActualCost = array_sum($prodActualCost);

                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$this->session->userdata('ts_uid')));

                if(!empty($userDetail)) {

                /*** Track Payment Details *****/

                    $paymentArr = array(
                        'payment_uid'   =>  $this->session->userdata('ts_uid'),
                        'payment_pid'   =>  $finalItemNumber,
                        'payment_type'   =>  $prodDetailsArr[0]
                    );
                    $checkPreviousPayment = $this->DatabaseModel->access_database('ts_paymentdetails','select','',$paymentArr);

                    if( empty($checkPreviousPayment) ) {
                        $payUniqid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                        $paymentArr['payment_uniqid'] = $payUniqid;
                        $paymentArr['payment_date'] = date('Y-m-d H:i:s');
                        $paymentArr['payment_mode'] = $_POST['paymentmethod'];
                        $paymentArr['payment_total'] = $finalItemActualCost;
                        $paymentArr['payment_discount'] = $finalItemDiscount;
                        $this->DatabaseModel->access_database('ts_paymentdetails','insert',$paymentArr,'');

                    }
                    else {

                        if( $checkPreviousPayment[0]['payment_status'] == 'no' ) {
                            //initiate payment
                            if( $_POST['paymentmethod'] == 'paypal' ) {
                                $payUniqid = $checkPreviousPayment[0]['payment_uniqid'];
                            }
                            else {
                                $payUniqid = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
                            }
                            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_date'=>date('Y-m-d H:i:s'), 'payment_uniqid'=>$payUniqid, 'payment_total'=>$finalItemActualCost, 'payment_discount'=>$finalItemDiscount, 'payment_mode'=>$_POST['paymentmethod']),array('	payment_id'=>$checkPreviousPayment[0]['payment_id']));
                        }
                        else {
                            // Already purchased
                            echo 'EXISTS';
                            die();
                        }
                    }

                    $trackingItemNumber = $payUniqid;  // UNIQUE TRANSACTION ID
                    
                    /************ Check Whether Product is of ZERO value *******************/
                    
                    	if( $finalItemAmount == 0 ) {
                    		
							$payment_uniqid = $trackingItemNumber;
                			$checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));
							$uid = $this->session->userdata['ts_uid'];

							$custom = trim($checkPaymentDetails[0]['payment_pid']);
							$customArr = explode(',',$custom);

							$emTransId = $checkPaymentDetails[0]['payment_id'];
							$admin_commission = $vendor_commission = '';
							for($i=0;$i<count($customArr);$i++) {

								$pId = trim($customArr[$i]);
								if( $checkPaymentDetails[0]['payment_type'] == 'vendor_plan' ) {
									$findPlan = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$pId,'vplan_status'=>1));
								}
								else {
									$findPlan = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$pId,'plan_status'=>1));
								}

								$findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId,'prod_status'=>1));

								if(!empty($findPlan) || !empty($findProduct)) {

									$userId = $checkPaymentDetails[0]['payment_uid'];

									if(!empty($findPlan)) {
										// Update Plan

										if( $checkPaymentDetails[0]['payment_type'] == 'vendor_plan' ) {
											$this->DatabaseModel->access_database('ts_user','update',array('user_accesslevel'=>3,'user_vplans'=>$findPlan[0]['vplan_id'] , 'user_vplansdate' => date('Y-m-d H:i:s')),array('user_id'=>$userId));
										}
										else {
											$this->DatabaseModel->access_database('ts_user','update',array('user_plans'=>$findPlan[0]['plan_id'] , 'user_plansdate' => date('Y-m-d H:i:s')),array('user_id'=>$userId));
										}
									}

									if(!empty($findProduct)) {
										// Add Products to purchase
										$prodId = $findProduct[0]['prod_id'];
										$prodOwner = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$findProduct[0]['prod_uid']));

										$purchaseRecord = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$prodId,'purrec_uid'=>$userId));
										if(empty($purchaseRecord)) {
											$purDataArr = array(
												'purrec_prodid'=>$prodId,
												'purrec_date'=>date('Y-m-d H:i:s'),
												'purrec_purcode'=>md5($payment_uniqid),
												'purrec_uid'=>$userId
											);
											$this->DatabaseModel->access_database('ts_purchaserecord','insert',$purDataArr,'');

											//$prodCost = $findProduct[0]['prod_price'];
											$prodCost = 0;
											if( $prodOwner[0]['user_accesslevel'] == '3') {
												/*if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
													$comis = $this->ts_functions->getsettings('vendor','commission');

													$v_c = ( $prodCost * $comis ) / 100;
													$v_c = round($v_c, 2);

													$a_c = $prodCost - $v_c ;
												}
												else {
													$v_c = $prodCost;
													$a_c = 0;
												}*/
												$v_c = $prodCost;
												$a_c = 0;
												/******* Wallet *******/
													$currentWallet = $this->DatabaseModel->access_database('ts_wallet','select','',array('wallet_uid'=>$prodOwner[0]['user_id']));
													if(!empty($currentWallet)) {
														$this->DatabaseModel->access_database('ts_wallet','update',array('wallet_amount'=>$v_c), array('wallet_id'=>$currentWallet[0]['wallet_id']));
													}
													else {
														$this->DatabaseModel->access_database('ts_wallet','insert',array('wallet_uid'=>$prodOwner[0]['user_id'] , 'wallet_amount'=>$v_c),'');
													}
												/******* Wallet *******/
											}
											else {
												$v_c = 0;
												$a_c = $prodCost;
											}
											$vendor_commission .= $pId.'@#'.$v_c.' , ';
											$admin_commission .= $pId.'@#'.$a_c.' , ';

										}
									}
									
								}
							}

							$payable_amount = $finalItemAmount;
							$vendor_commission = rtrim( trim($vendor_commission) ,',');
							$admin_commission = rtrim( trim($admin_commission) ,',');

							$this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_mode'=>'discounted','payment_amount'=>$finalItemAmount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

							$this->ts_functions->sendtransactionemails($emTransId);
							setcookie("cartCookies", '1' , time()-3600 * 24 * 90,'/');
							echo 'PURCHASED';
							die();
                    	}
                    	
                    	
                    /************ Check Whether Product is of ZERO value *******************/

                    /*** Track Payment Details *****/

                    if( $_POST['paymentmethod'] == 'paypal' ) {
						$formData =
							  '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pay_form_name">
							  <input type="hidden" name="business" value="'.$this->ts_functions->getsettings('paypal','email').'">
							  <input type="hidden" name="item_name" value="'.$finalItemName.'">
							  <input type="hidden" name="amount" value="'.$finalItemAmount.'">
							  <input type="hidden" name="item_number" value="'.$trackingItemNumber.'">
							  <input type="hidden" name="no_shipping" value="1">
							  <input type="hidden" name="currency_code" value="'.$this->ts_functions->getsettings('portal','curreny').'">
							  <input type="hidden" name="cmd" value="_xclick">
							  <input type="hidden" name="handling" value="0">
							  <input type="hidden" name="no_note" value="1">
							  <input type="hidden" name="cpp_logo_image" value="'.$this->ts_functions->getsettings('logo','url').'">
							  <input type="hidden" name="custom" value="'.$finalItemNumber.'">
							  <input type="hidden" name="cancel_return" value="'.base_url().'pages/canceled_payment">
							  <input type="hidden" name="return" value="'.base_url().'pages/success_payment">
								<input type="hidden" name="notify_url" value="'.base_url().'pages/notify_payment">
							 </form>';
					
                    }
                    elseif( $_POST['paymentmethod'] == 'payu' )  {
                        $portal_cur = strtolower($this->ts_functions->getsettings('portal','curreny'));
                        if( $portal_cur == 'usd' ) {

                            $url = "http://www.google.com/finance/converter?a=".$finalItemAmount."&from=USD&to=INR";
                            $request = curl_init();
                            $timeOut = 0;
                            curl_setopt ($request, CURLOPT_URL, $url);
                            curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut);
                            $response = curl_exec($request);
                            curl_close($request);
                            $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s';
                            preg_match($regularExpression, $response, $finalData);
                            $finalItemAmount = round(explode(' ',$finalData[1])[0]);
                        }

                        $MERCHANT_KEY = $this->ts_functions->getsettings('payu','merchantKey');

                        $SALT = $this->ts_functions->getsettings('payu','merchantSalt');

                        $txnid = $trackingItemNumber;

                        $hash_string = $MERCHANT_KEY.'|'.$txnid.'|'.$finalItemAmount.'|'.$finalItemName.'|'.$this->session->userdata('ts_uname').'|'.$userDetail[0]['user_email'].'|||||||||||'.$SALT;
                        $hash = strtolower(hash('sha512', $hash_string));

                    $formData =
                         '<form action="https://secure.payu.in/_payment" method="post" name="payuForm">
                          <input type="hidden" name="key" value="'.$this->ts_functions->getsettings('payu','merchantKey').'" />
                          <input type="hidden" name="hash" value="'.$hash.'"/>
                          <input type="hidden" name="txnid" value="'.$txnid.'" />
                          <input type="hidden" name="amount" value="'.$finalItemAmount.'" />
                          <input type="hidden" name="firstname" id="firstname" value="'.$this->session->userdata('ts_uname').'" />
                          <input type="hidden" name="email" id="email" value="'.$userDetail[0]['user_email'].'" />
                          <input type="hidden" name="phone" value="'.$userDetail[0]['user_mobile'].'" />
                          <input type="hidden" name="productinfo" value="'.$finalItemName.'" />
                          <input type="hidden" name="surl" value="'.base_url().'pages/payu_success_payment">
                          <input type="hidden" name="furl" value="'.base_url().'pages/canceled_payment">
                          <input type="hidden" name="curl" value="'.base_url().'pages/canceled_payment">
                          <input type="hidden" name="service_provider" value="payu_paisa">
                         </form>';
                    }
                    elseif( $_POST['paymentmethod'] == 'stripe' )  {
                        $publishableKey = $this->ts_functions->getsettings('stripe','publishableKey');
                        $finalItemAmount = $finalItemAmount.'00';

                        $_SESSION['stripeSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                    $formData =
                         '<form action="'.base_url().'pages/stripe_checkout" method="POST" name="stripe_form" id="stripe_form"><script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="'.$publishableKey.'" data-image="'.$this->ts_functions->getsettings('logo','url').'" data-name="'.$finalItemName.'" data-description="'.$finalItemName.'" data-amount="'.$finalItemAmount.'" data-locale="auto"/></script></form>';
                    }
                    elseif( $_POST['paymentmethod'] == '2checkout' )  {
                        $accountNumber = $this->ts_functions->getsettings('2checkout','acntnumber');

                        $_SESSION['2checkoutSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $formData = '<form name="2checkout" action="https://www.2checkout.com/checkout/spurchase" method="post"><input type="hidden" name="sid" value="'.$accountNumber.'"/><input type="hidden" name="mode" value="2CO"/><input type="hidden" name="li_0_name" value="'.$finalItemName.'"/><input type="hidden" name="li_0_price" value="'.$finalItemAmount.'"/><input type="hidden" name="x_receipt_link_url" value="'.base_url().'pages/checkout2_return"/></form>';
                    }
                    elseif( $_POST['paymentmethod'] == 'banktransfer' )  {
                        if( $this->ts_functions->getsettings('banktransfer','details') != '' ) {
                            $accountDetails = explode(PHP_EOL, $this->ts_functions->getsettings('banktransfer','details'));
                        }

                        $_SESSION['banktransferSession'] = $finalItemAmount.'@#'.$trackingItemNumber;

                        $detailsStr = '';

                        if( $this->ts_functions->getsettings('banktransfer','details') != '' ) {
                            for($i=0;$i<count($accountDetails);$i++) {
							    $detailsStr .= '<p>'.$accountDetails[$i].'</p>';
							}
                        }

                        $formData = '<div class="banktransfer_div"> '.$detailsStr.' <span> '. $this->ts_functions->getlanguage('banktransfernote','homepage','solo').' </span>
                        <p> <input type="checkbox" id="transactionDone" onclick="transactionDone(this)"> <label for="transactionDone">'. $this->ts_functions->getlanguage('banktransfersecond','homepage','solo').' </label></p>
                        <div class="transactionDone_div" style="display:none;">
                        <span> '. $this->ts_functions->getlanguage('banktransferthird','homepage','solo').' </span>
                        <p> <textarea class="transactionDone_textarea"></textarea> </p>
                        <a onclick="savetransactionmadedetails();" class="ts_btn pull-right"> '. $this->ts_functions->getlanguage('submittext','authentication','solo').' <i class="fa fa-spinner fa-spin ts_transactionDone_wait hideme" aria-hidden="true"></i></a>
                        </div>
                        </div>';
                    }
                    elseif( $_POST['paymentmethod'] == 'bitcoin' )  {

                        $b_publickey = $this->ts_functions->getsettings('bitcoin','publickey');
                        $b_privatekey = $this->ts_functions->getsettings('bitcoin','privatekey');
                                             
                        $a = array($b_privatekey);
 						define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $a));
 						
 						$b_privatekey = CRYPTOBOX_PRIVATE_KEYS;
                        
	                    $box_style = $message_style = '';

                    	if (!$box_style) 	 $box_style = "border-radius:15px;box-shadow:0 0 12px #aaa;-moz-box-shadow:0 0 12px #aaa;-webkit-box-shadow:0 0 12px #aaa;padding:3px 6px;margin:10px";
						if (!$message_style) $message_style = "display:inline-block;max-width:580px;padding:15px 20px;box-shadow:0 0 10px #aaa;-moz-box-shadow: 0 0 10px #aaa;margin:7px;font-size:13px;font-weight:normal;line-height:21px;font-family: Verdana, Arial, Helvetica, sans-serif;";
						
						function icrc32($str)
						{
							$in = crc32($str);
							$int_max = pow(2, 31)-1;
							if ($in > $int_max) $out = $in - $int_max * 2 - 2;
							else $out = $in;
							$out = abs($out);

							return $out;
						}
						
						$width = 530;
						$height = 230;
						$boxID = explode('AA',$b_publickey)[0];
						$coinName = 'bitcoin';
						$coinLabel = 'BTC';
						$amount = '0';
						$amountUSD = $finalItemAmount;
						$period = "24 HOUR";
						$language = "EN";
						$webdev_key = "";
						$orderID = $trackingItemNumber;
						$userFormat = "COOKIE";
						$ip = $_SERVER['REMOTE_ADDR'];
						$userID =  trim(md5($ip."*&*".$boxID."*&*".$coinLabel."*&*".$orderID));
						$cookieName = 15963;
						$iframeID = 'bit_boxx';
						$submit_btn = true;
						$cryptobox_html = '';
						$val = md5($b_privatekey);
						
						setcookie($cookieName, $userID , time()+(10*365*24*60*60),'/');
						
						$hash_str = $boxID.$coinName.$b_publickey.$b_privatekey.$webdev_key.$amount.$period.$amountUSD.$language.$amount.$iframeID.$amountUSD.$userID.$userFormat.$orderID.$width.$height;
						$hash = md5($hash_str);
						
						$cryptobox_html .= "<div align='center' style='min-width:".$width."px'><iframe id='$iframeID'   ".($box_style?'style="'.htmlspecialchars($box_style, ENT_COMPAT).'"':'')." scrolling='no' marginheight='0' marginwidth='0' frameborder='0' width='$width' height='$height'></iframe></div>";
						$cryptobox_html .= "<div><script type='text/javascript'>";
						$cryptobox_html .= "cryptobox_show($boxID, '$coinName', '$b_publickey', '$amount', '$amountUSD', '$period', '$language', '$iframeID', '$userID', '$userFormat', '$orderID', '$cookieName' , '', '$hash', $width, $height);";
						 
						$cryptobox_html .= "</script></div>";

						$cryptobox_html .= "<br>";

                        $formData =  '<script src="'.base_url().'adminassets/js/bitcoin/cryptobox.min.js" type="text/javascript"></script>'.$cryptobox_html;
                    }
                    elseif( $_POST['paymentmethod'] == 'wallet' )  {
                        $_SESSION['walletSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                         $formData = '<script> window.location = "'.base_url().'pages/wallet_payment"; </script>';
                    }
                    elseif( $_POST['paymentmethod'] == 'webmoney' )  {
                        $purseNumber = $this->ts_functions->getsettings('webmoney','purse');

                        $_SESSION['webmoneySession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $formData = '<form id=pay name=pay method="POST" action="https://merchant.wmtransfer.com/lmi/payment.asp"> <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$finalItemAmount.'"> <input type="hidden" name="LMI_PAYMENT_DESC" value="'.$finalItemName.'"> <input type="hidden" name="LMI_PAYMENT_NO" value="1"> <input type="hidden" name="LMI_PAYEE_PURSE" value="'.$purseNumber.'">   <input type="hidden" name="LMI_SIM_MODE" value="0"> <input type="hidden" name="LMI_SUCCESS_URL" value="'.base_url().'pages/webmoney_success">   <input type="hidden" name="LMI_SUCCESS_METHOD" value="1">  <input type="hidden" name="LMI_FAIL_URL" value="'.base_url().'pages/canceled_payment"> <input type="hidden" name="LMI_FAIL_METHOD" value="1"></form>
                        ';
                    }
                    elseif( $_POST['paymentmethod'] == 'yandex' )  {
                        $walletNumber = $this->ts_functions->getsettings('yandex','wallet');

                        $_SESSION['yandexSession'] = $finalItemName.'@#'.$finalItemAmount.'@#'.$trackingItemNumber;

                        $url = urlencode(base_url().'pages/yandex_success');

                        //$formData = '<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/shop.xml?account='.$walletNumber.'&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets='.$finalItemName.'&default-sum='.$finalItemAmount.'&button-text=01&successURL='.$url.'" width="450" height="198"></iframe>';

                        $formData = '<iframe frameborder="0" allowtransparency="true" scrolling="no" style="margin-top: 40px;" src="https://money.yandex.ru/quickpay/button-widget?account='.$walletNumber.'&quickpay=small&yamoney-payment-type=on&button-text=02&button-size=m&button-color=orange&targets='.$finalItemName.'&default-sum='.$finalItemAmount.'&successURL='.$url.'" width="125" height="36"></iframe>';
                    }
					elseif( $_POST['paymentmethod'] == 'tpay' ) {
						$ipn_tpay = base_url().'pages/tpay_ipn';
						$suc_tpay = base_url().'pages/success_payment';
						$fail_tpay = base_url().'pages/canceled_payment';
						
						$formData =
						'<form action="https://secure.transferuj.pl" method="post" accept-charset="utf-8"  name="tpay_form_name">
						<input type="hidden" name="id" value="'.$this->ts_functions->getsettings('tpay','merchantid').'">
						<input type="hidden" name="kwota" value="'.$finalItemAmount.'">
						<input type="hidden" name="opis" value="'.$finalItemName.'">
						<input type="hidden" name="crc" value="'.$trackingItemNumber.'">
						<input type="hidden" name="wyn_url" value="'.$ipn_tpay.'">
						<input type="hidden" name="pow_url" value="'.$suc_tpay.'">
						<input type="hidden" name="pow_url_blad" value="'.$fail_tpay.'">
						</form>';
                    }
					elseif( $_POST['paymentmethod'] == 'pagseguro' ) {
						
						$pArr = explode('.',$finalItemAmount);
						if( count($pArr) != '2' ) {
							$finalItemAmount = $finalItemAmount.'.00';
						}
						elseif( strlen($pArr[1]) < 2 ) {
							$finalItemAmount = $finalItemAmount.'0';
						}
						
						$ipn_pagseguro = base_url().'pages/pagseguro_ipn';
						$suc_pagseguro = base_url().'pages/success_payment';
						
						$pg_email = $this->ts_functions->getsettings('pagseguro','email');
						$pg_token = $this->ts_functions->getsettings('pagseguro','token');
						
						$ch = curl_init();	 
						curl_setopt($ch, CURLOPT_URL,"https://ws.pagseguro.uol.com.br/v2/checkout");
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS,
									"email=".$pg_email."&token=".$pg_token."&currency=BRL&itemId1=".$trackingItemNumber."&itemDescription1=".$finalItemName."&itemAmount1=".$finalItemAmount."&itemQuantity1=1&shippingType=1&notificationURL=".$ipn_pagseguro."&redirectURL=".$suc_pagseguro."");

						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$response_pagseg = curl_exec ($ch);
						curl_close ($ch);
						$xml_response = simplexml_load_string($response_pagseg);
						
						if( isset($xml_response->code) ) {
							$pageseg_code = $xml_response->code;
							
							$formData = '<form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post" name="pagseguro_form_name"><input type="hidden" name="code" value="'.$pageseg_code.'" /><input type="hidden" name="iot" value="button" /><input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-comprar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" /></form>';
						}
						else {
							$formData = '<p style="color:red;text-align:center;"> Error Occured. Please, contact support.</p>';
						}
						
                    }
                    elseif( $_POST['paymentmethod'] == 'permoney' ) {
						
						$uname = $this->session->userdata['ts_uname'];
						$permoney_account = $this->ts_functions->getsettings('permoney','account');
						
						$formData = '<form action="https://perfectmoney.is/api/step1.asp" method="POST" name="permoney_form_name"><input type="hidden" name="PAYEE_ACCOUNT" value="'.$permoney_account.'"><input type="hidden" name="PAYEE_NAME" value="'.$uname.'"><input type="hidden" name="PAYMENT_ID" value="'.$trackingItemNumber.'"><input type="hidden" name="PAYMENT_AMOUNT" value="'.$finalItemAmount.'"><input type="hidden" name="PAYMENT_UNITS" value="USD"> <input type="hidden" name="STATUS_URL" value="http://kamleshyadav.com/scripts/themeportal/pages/perfectmoney_ipn"> <input type="hidden" name="PAYMENT_URL" value="http://kamleshyadav.com/scripts/themeportal/pages/success_payment"><input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
<input type="hidden" name="NOPAYMENT_URL" value="http://kamleshyadav.com/scripts/themeportal/pages/perfectmoney_fail"><input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST"><input type="hidden" name="SUGGESTED_MEMO" value=""><input type="hidden" name="BAGGAGE_FIELDS" value=""></form>';
						
                    }
                    echo $formData;
                }
                else {
                    echo 0;
                }
            }
        }
        else {
            echo 0;
        }
        die();

    }
    /*********** Initiate payment depending on option ENDS *******************/

    /**************** Manual Transactions START ****************/

    function savetransactionmadedetails(){
        if(isset($_POST['txtDetails'])) {
            if( $_POST['txtDetails'] != '' ) {
                if(isset($_SESSION['banktransferSession'])) {
                    $detailss = explode('@#',$_SESSION['banktransferSession']);
                    $payable_amount = $detailss[0];
                    $uid = $this->session->userdata['ts_uid'];
                    $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
                    $this->DatabaseModel->access_database('ts_paymentdetails','update', array('payment_date'=>date('Y-m-d H:i:s'), 'payment_note'=>$_POST['txtDetails'],'payment_amount'=>$payable_amount,'payment_email'=>$userDetail[0]['user_email']) , array('payment_uniqid'=>$detailss[1]));
                    echo 1;
                }
                else {
                    echo 0;
                }
            }
            else {
                echo 0;
            }
        }
        else {
            echo 0;
        }
        die();
    }
    /**************** Manual Transactions ENDS ****************/
    
    /**************** Coupon Code Verification STARTS ****************/
    
    function verify_coupon_code(){
    	if(isset($_POST['coupon_code'])) {
    		// Check & Verify
    		
    		if( $_POST['prod_type'] == 'products' ) {
				$data_array = array(
					'prod_id'   =>  $_POST['prodID'],
					'prod_coupon'  =>  $_POST['coupon_code']
				);
				$join_array = array('ts_coupons','ts_coupons.coup_code = ts_products.prod_coupon');
				$coup_Res = $this->DatabaseModel->access_database('ts_products','','',$data_array,$join_array);
				
				$actual_cost = !empty($coup_Res) ? $coup_Res[0]['prod_price'] : '0' ;
			}
			else if( $_POST['prod_type'] == 'vplans' ) {
				$data_array = array(
					'vplan_id'   =>  $_POST['prodID'],
					'vplan_coupon'  =>  $_POST['coupon_code']
				);
				$join_array = array('ts_coupons','ts_coupons.coup_code = ts_vendorplans.vplan_coupon');
				$coup_Res = $this->DatabaseModel->access_database('ts_vendorplans','','',$data_array,$join_array);
				
				$actual_cost = !empty($coup_Res) ? $coup_Res[0]['vplan_amount'] : '0' ;
			}
			else if( $_POST['prod_type'] == 'plans' ) {
				$data_array = array(
					'plan_id'   =>  $_POST['prodID'],
					'plan_coupon'  =>  $_POST['coupon_code']
				);
				$join_array = array('ts_coupons','ts_coupons.coup_code = ts_plans.plan_coupon');
				$coup_Res = $this->DatabaseModel->access_database('ts_plans','','',$data_array,$join_array);
				
				$actual_cost = !empty($coup_Res) ? $coup_Res[0]['plan_amount'] : '0' ;
			}
			
			
			
			if(!empty($coup_Res)) {
				if( $coup_Res[0]['coup_duration'] != '1' ) {
					$coup_duration = date_format(date_create ( $coup_Res[0]['coup_duration'] ) , 'Y-m-d').' 59:59:59';
					$today_date = date('Y-m-d H:i:s');
				
					if( $today_date > $coup_duration ) {
						echo '3'; // expired
						die();
					}
				}
				
				if( $coup_Res[0]['coup_type'] == 'percent' ) {
					$discount = ( $coup_Res[0]['coup_amount'] * $actual_cost ) / 100 ;
					
				}
				else {
					$discount = $coup_Res[0]['coup_amount'];
				}
				$final_cost = $actual_cost - $discount;
				$pCode = 'prodID_'.$_POST['prodID'].'_'.$_POST['prod_type'];
    			setcookie($pCode, $discount.'@#'.$final_cost , time()+3600 * 24 * 90,'/');
    			
				echo $actual_cost.'@#'.$discount.'@#'.$final_cost;
			}
			else {
				echo '2';
			}
    	}
    	elseif(isset($_POST['prod_ID'])) {
    		// Remove coupons
    		
    		if( $_POST['prod_type'] == 'products' ) {
				$prod_Res = $this->DatabaseModel->access_database('ts_products','select','', array('prod_id'=>$_POST['prod_ID']) );	
			$actual_cost = $prod_Res[0]['prod_price'];
			}
			else if( $_POST['prod_type'] == 'vplans' ) {
				$prod_Res = $this->DatabaseModel->access_database('ts_vendorplans','select','', array('vplan_id'=>$_POST['prod_ID']) );	
				$actual_cost = $prod_Res[0]['vplan_amount'];
			}
			else if( $_POST['prod_type'] == 'plans' ) {
				$prod_Res = $this->DatabaseModel->access_database('ts_plans','select','', array('plan_id'=>$_POST['prod_ID']) );	
				$actual_cost = $prod_Res[0]['plan_amount'];
			}
			
			$pCode = 'prodID_'.$_POST['prod_ID'].'_'.$_POST['prod_type'];
			
			$price_arr = explode('@#',$_COOKIE[$pCode]);
			setcookie($pCode, '' , time()-3600 * 24 * 90,'/');
			
			$discount = $price_arr[0];
			$final_cost = $price_arr[1];
			
			echo $actual_cost.'@#'.$discount.'@#'.$final_cost;
		
    	}
        else {
            echo 0;
        }
        die();
    }
    
    /**************** Coupon Code Verification ENDS ****************/
    
    function aa(){
    	$config = array(
		  "environment" => "sandbox", # or live
		  "userid" => "info-facilitator_api1.commercefactory.org",
		  "password" => "1399139964",
		  "signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31ABA-4mmfZiu.G30Dl3DKyBo9-GF8",
		  // "appid" => "", # You can set this when you go live
		);

    	include('Adaptive.php');
    	$paypal = new PayPal($config);
    	$result = $paypal->call(
		  array(
			'actionType'  => 'PAY',
			'currencyCode'  => 'USD',
			'feesPayer'  => 'EACHRECEIVER',
			'memo'  => 'Order number #123',
			'cancelUrl' => 'cancel.php',
			'returnUrl' => 'success.php',
			'receiverList' => array(
			  'receiver' => array(
				array(
				  'amount'  => '100.00',
				  'email'  => 'info-facilitator@commercefactory.org',
				  'primary'  => 'true',
				),
				array(
				  'amount'  => '45.00',
				  'email'  => 'us-provider@commercefactory.org',
				),
				array(
				  'amount'  => '45.00',
				  'email'  => 'us-provider2@commercefactory.org',
				),
			  ),
			),
		  ), 'Pay'
		);
		
		
		if ($result['responseEnvelope']['ack'] == 'Success') {
		  $_SESSION['payKey'] = $result["payKey"];
		  $paypal->redirect($result);
		} else {
		  echo 'Handle the payment creation failure';
		}
    }

}
