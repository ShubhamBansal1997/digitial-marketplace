<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    $this->load->library('ts_functions');
	    $this->theme = $this->ts_functions->current_theme();
	}


    /************ Custom pages after payment STARTS *******************************/

    function notify_payment() {
        if(isset($_POST['payer_id'])) {
            $custom = trim($_POST['custom']);
            $customArr = explode(',',$custom);
            $payment_uniqid = $_POST['item_number'];
            $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

            if( !empty($checkPaymentDetails) ) {
            if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
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

                                $prodCost = $findProduct[0]['prod_price'];
                                if( $prodOwner[0]['user_accesslevel'] == '3') {
                                    if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                        $comis = $this->ts_functions->getsettings('vendor','commission');

                                        $v_c = ( $prodCost * $comis ) / 100;
                                        $v_c = round($v_c, 2);

                                        $a_c = $prodCost - $v_c ;
                                    }
                                    else {
                                        $v_c = $prodCost;
                                        $a_c = 0;
                                    }
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

                $payerEmail = isset($_POST['payer_email']) ? $_POST['payer_email'] : '' ;

                $payable_amount = $_POST['mc_gross'];
                $vendor_commission = rtrim( trim($vendor_commission) ,',');
                $admin_commission = rtrim( trim($admin_commission) ,',');
                $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$_POST['mc_gross'], 'payment_email'=>$payerEmail ,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));


                $this->ts_functions->sendtransactionemails($emTransId);
            }
            }
        }
    }


    function success_payment() {
        setcookie("cartCookies", '1' , time()-3600 * 24 * 90,'/');
        $data['basepath'] = base_url();
        $data['pagetype_toptext'] = 'paySuccessHeading';
        $data['pagetype_heading'] = 'paySuccessh3';
        $data['pagetype_text'] = 'paySuccesstext';
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/success',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    /************ Custom pages after payment ENDS *******************************/

    /***************** Paypal IPN STARTS *************************/

    function paypal_ipn() {
        if(isset($_POST['payer_id'])) {
            $custom = trim($_POST['custom']);
            $customArr = explode(',',$custom);
            $payment_uniqid = $_POST['item_number'];
            $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

            if( !empty($checkPaymentDetails) ) {
            if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
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

                                $prodCost = $findProduct[0]['prod_price'];
                                if( $prodOwner[0]['user_accesslevel'] == '3') {
                                    if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                        $comis = $this->ts_functions->getsettings('vendor','commission');

                                        $v_c = ( $prodCost * $comis ) / 100;
                                        $v_c = round($v_c, 2);

                                        $a_c = $prodCost - $v_c ;
                                    }
                                    else {
                                        $v_c = $prodCost;
                                        $a_c = 0;
                                    }
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

                $payerEmail = isset($_POST['payer_email']) ? $_POST['payer_email'] : '' ;

                $payable_amount = $_POST['mc_gross'];
                $vendor_commission = rtrim( trim($vendor_commission) ,',');
                $admin_commission = rtrim( trim($admin_commission) ,',');
                $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$_POST['mc_gross'], 'payment_email'=>$payerEmail ,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));


                $this->ts_functions->sendtransactionemails($emTransId);
            }
            }
        }
    }

    /***************** Paypal IPN ENDS *************************/

    /*********** PayU Money *******************/
    /************ Custom pages after payment STARTS *******************************/


    function canceled_payment() {
        setcookie("cartCookies", '1' , time()-3600 * 24 * 90,'/');
        $data['basepath'] = base_url();
        $data['pagetype_toptext'] = 'payCanceledHeading';
        $data['pagetype_heading'] = 'payCancelh3';
        $data['pagetype_text'] = 'payCanceltext';
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/oops',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    function payu_success_payment() {

        $status=$_POST["status"];
        $firstname=$_POST["firstname"];
        $amount=$_POST["amount"];
        $txnid=$_POST["txnid"];
        $posted_hash=$_POST["hash"];
        $key=$_POST["key"];
        $productinfo=$_POST["productinfo"];
        $email=$_POST["email"];
        $salt=$this->ts_functions->getsettings('payu','merchantSalt');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges=$_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

        }
        else {
            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
        //echo "Invalid Transaction. Please try again";

            redirect(base_url().'pages/canceled_payment');
        }
        else {

            $payment_uniqid = $txnid;
            $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

            if( !empty($checkPaymentDetails) ) {
            if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
                $custom = trim($checkPaymentDetails[0]['payment_pid']);
                $customArr = explode(',',$custom);
                $admin_commission = $vendor_commission = '';
                $emTransId = $checkPaymentDetails[0]['payment_id'];

                $amount_array = array();
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
                            array_push($amount_array,$findPlan[0]['plan_amount']);
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
                                $prodCost = $findProduct[0]['prod_price'];
                                array_push($amount_array,$prodCost);
                                if( $prodOwner[0]['user_accesslevel'] == '3') {
                                    if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                        $comis = $this->ts_functions->getsettings('vendor','commission');

                                        $v_c = ( $prodCost * $comis ) / 100;
                                        $v_c = round($v_c, 2);

                                        $a_c = $prodCost - $v_c ;
                                    }
                                    else {
                                        $v_c = $prodCost;
                                        $a_c = 0;
                                    }
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

                $payerEmail = isset($_POST['email']) ? $_POST['email'] : '' ;

                $payable_amount = array_sum($amount_array);

                $vendor_commission = rtrim( trim($vendor_commission) ,',');
                $admin_commission = rtrim( trim($admin_commission) ,',');
                $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_email'=>$payerEmail,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                $this->ts_functions->sendtransactionemails($emTransId);
                redirect(base_url().'pages/success_payment');

            }
            }
            else {
                redirect(base_url().'pages/canceled_payment');
            }

        }

    }

    /************ Custom pages after payment ENDS *******************************/
    /**************** Pages for STRIPE STARTS *****************************/

    function stripe_checkout(){

        try {
			require 'Stripe_lib/Stripe.php';
			$secretKey = $this->ts_functions->getsettings('stripe','secretKey');
			Stripe::setApiKey($secretKey); //Replace with your Secret Key
			if(!isset($_SESSION['stripeSession'])) {
			    redirect(base_url().'pages/canceled_payment');
			}
			else {
			    if( $_SESSION['stripeSession'] != '' ) {
			        $stripeSessionArr = explode('@#',$_SESSION['stripeSession']);

                    $charge = Stripe_Charge::create(array(
                        "amount" => $stripeSessionArr[1],
                        "currency" => strtolower($this->ts_functions->getsettings('portal','curreny')),
                        "card" => $_POST['stripeToken'],
                        "description" => $stripeSessionArr[0]
                    ));

                    $_SESSION['stripeSession'] = '';
                    $amount = substr($stripeSessionArr[1], 0, -2);
                    $payment_uniqid = $stripeSessionArr[2];
                    $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                    if( !empty($checkPaymentDetails) ) {
                        if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
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

                                            $prodCost = $findProduct[0]['prod_price'];
                                            if( $prodOwner[0]['user_accesslevel'] == '3') {
                                                if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                    $comis = $this->ts_functions->getsettings('vendor','commission');

                                                    $v_c = ( $prodCost * $comis ) / 100;
                                                    $v_c = round($v_c, 2);

                                                    $a_c = $prodCost - $v_c ;
                                                }
                                                else {
                                                    $v_c = $prodCost;
                                                    $a_c = 0;
                                                }
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

                            $payerEmail = isset($_POST['stripeEmail']) ? $_POST['stripeEmail'] : '' ;

                            $payable_amount = $amount;
                            $vendor_commission = rtrim( trim($vendor_commission) ,',');
                            $admin_commission = rtrim( trim($admin_commission) ,',');
                            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_email'=>$payerEmail,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                            $this->ts_functions->sendtransactionemails($emTransId);
                            redirect(base_url().'pages/success_payment');

                        }
                    }
                    else {
                        redirect(base_url().'pages/canceled_payment');
                    }
			    }
			    else {
			        redirect(base_url().'pages/canceled_payment');
			    }
			}

		}
		catch(Stripe_CardError $e) {
            redirect(base_url().'pages/canceled_payment');
		}
		catch (Stripe_InvalidRequestError $e) {
            redirect(base_url().'pages/canceled_payment');
		} catch (Stripe_AuthenticationError $e) {
            redirect(base_url().'pages/canceled_payment');
		} catch (Stripe_ApiConnectionError $e) {
            redirect(base_url().'pages/canceled_payment');
		} catch (Stripe_Error $e) {
            redirect(base_url().'pages/canceled_payment');
		} catch (Exception $e) {
            redirect(base_url().'pages/canceled_payment');
		}

    }
    /**************** Pages for STRIPE ENDS *****************************/

    /**************** Pages for 2checkout STARTS *****************************/

    function checkout2_return(){

        /*$hashSecretWord = 'tango'; //2Checkout Secret Word
        $hashSid = 1303908; //2Checkout account number
        $hashTotal = '1.00'; //Sale total to validate against
        $hashOrder = $_REQUEST['order_number']; //2Checkout Order Number
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));

        if ($StringToHash != $_REQUEST['key']) {
            $result = 'Fail - Hash Mismatch';
            } else {
            $result = 'Success - Hash Matched';
        }

        echo $result;*/

        if(!isset($_SESSION['2checkoutSession'])) {
            redirect(base_url().'pages/canceled_payment');
        }
        else {
            if( $_SESSION['checkoutSession'] != '' ) {
                $checkoutSessionArr = explode('@#',$_SESSION['checkoutSession']);

                /*$charge = Stripe_Charge::create(array(
                    "amount" => $checkoutSessionArr[1],
                    "currency" => strtolower($this->ts_functions->getsettings('portal','curreny')),
                    "card" => $_POST['stripeToken'],
                    "description" => $checkoutSessionArr[0]
                ));*/

                $_SESSION['checkoutSession'] = '';
                $amount = $checkoutSessionArr[1];
                $payment_uniqid = $checkoutSessionArr[2];
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
                        $custom = trim($checkPaymentDetails[0]['payment_pid']);
                        $customArr = explode(',',$custom);
                        $admin_commission = $vendor_commission = '';
                        $emTransId = $checkPaymentDetails[0]['payment_id'];

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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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
                            $payerEmail = isset($_POST['stripeEmail']) ? $_POST['stripeEmail'] : '' ;

                            $payable_amount = $amount;
                            $vendor_commission = rtrim( trim($vendor_commission) ,',');
                            $admin_commission = rtrim( trim($admin_commission) ,',');
                            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_email'=>$payerEmail,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));
                        }

                        $this->ts_functions->sendtransactionemails($emTransId);

                        redirect(base_url().'pages/success_payment');

                    }
                }
                else {
                    redirect(base_url().'pages/canceled_payment');
                }
            }
            else {
                redirect(base_url().'pages/canceled_payment');
            }
        }

    }

    /**************** Pages for Bank Transfer ********************/

    function wait_for_approval() {
        setcookie("cartCookies", '1' , time()-3600 * 24 * 90,'/');
        $data['basepath'] = base_url();
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/wait',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    /**************** Pages for Bitcoin Transfer ********************/

    function bit_success(){
        $this->DatabaseModel->access_database('ts_settings','insert',array('key_text'=>date('Y-m-d H:i:s'),'value_text'=>json_encode($_POST)),'');
        
        
		if(isset($_POST['status'])) {
			if($_POST['status']=='payment_received'){
			    
			    if($_POST['private_key'] == $this->ts_functions->getsettings('bitcoin','privatekey')) {
			        
			
                    $amount = $_POST['amountusd'];
                    $payment_uniqid = $_POST['order'];
                    $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                    if( !empty($checkPaymentDetails) ) {
                        if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
                            $uid = $checkPaymentDetails[0]['payment_uid'];

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

                                            $prodCost = $findProduct[0]['prod_price'];
                                            if( $prodOwner[0]['user_accesslevel'] == '3') {
                                                if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                    $comis = $this->ts_functions->getsettings('vendor','commission');

                                                    $v_c = ( $prodCost * $comis ) / 100;
                                                    $v_c = round($v_c, 2);

                                                    $a_c = $prodCost - $v_c ;
                                                }
                                                else {
                                                    $v_c = $prodCost;
                                                    $a_c = 0;
                                                }
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

                            $payable_amount = $amount;
                            $vendor_commission = rtrim( trim($vendor_commission) ,',');
                            $admin_commission = rtrim( trim($admin_commission) ,',');
                            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                            $this->ts_functions->sendtransactionemails($emTransId);
                        }
                    }
			    }
			    $html = "cryptobox_newrecord";
			}
			else {
			    $html = "cryptobox_updated";
			}
		}
		else {
		    $html = "Only POST Data Allowed";
		}
	    echo $html; 
    }

    /**************** Pages for Wallet STARTS *****************************/

    function wallet_payment(){
        if( isset($_SESSION['walletSession'])) {
            if($_SESSION['walletSession'] != '' ) {
                $walletSessionArr = explode('@#',$_SESSION['walletSession']);
                $_SESSION['walletSession'] = '';

                $amount = $walletSessionArr[1];
                $payment_uniqid = $walletSessionArr[2];
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {

                        /**** Deduct amount from wallet ******/
                        $uid = $this->session->userdata['ts_uid'];
                        $currentWallet = $this->DatabaseModel->access_database('ts_wallet','select','',array('wallet_uid'=>$uid));
                        if( !empty($currentWallet) ) {
                            $curAmount = $currentWallet[0]['wallet_amount'];
                            $amountLeft = $curAmount - $amount;
                            if( $amountLeft > 0 || $amountLeft == 0 ) {
                                $this->DatabaseModel->access_database('ts_wallet','update',array('wallet_amount'=>$amountLeft),array('wallet_uid'=>$uid));
                            }
                            else {
                                redirect(base_url().'pages/canceled_payment');
                            }
                        }
                        else {
                            redirect(base_url().'pages/canceled_payment');
                        }
                        /**** Deduct amount from wallet ******/

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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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

                        $payable_amount = $amount;
                        $vendor_commission = rtrim( trim($vendor_commission) ,',');
                        $admin_commission = rtrim( trim($admin_commission) ,',');
                        $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                        $this->ts_functions->sendtransactionemails($emTransId);
                        redirect(base_url().'pages/success_payment');

                    }
                }
                else {
                    redirect(base_url().'pages/canceled_payment');
                }
            }
            else {
                redirect(base_url().'pages/canceled_payment');
            }
        }
        else {
            redirect(base_url().'pages/canceled_payment');
        }
    }
    /**************** Pages for Wallet ENDS *****************************/

    /**************** Pages for WebMoney STARTS *****************************/

    function webmoney_success(){
        if( isset($_SESSION['webmoneySession'])) {
            if($_SESSION['webmoneySession'] != '' ) {
                $webmoneySessionArr = explode('@#',$_SESSION['webmoneySession']);
                $_SESSION['webmoneySession'] = '';

                $amount = $webmoneySessionArr[1];
                $payment_uniqid = $webmoneySessionArr[2];
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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

                        $payable_amount = $amount;
                        $vendor_commission = rtrim( trim($vendor_commission) ,',');
                        $admin_commission = rtrim( trim($admin_commission) ,',');
                        $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                        $this->ts_functions->sendtransactionemails($emTransId);
                        redirect(base_url().'pages/success_payment');

                    }
                }
                else {
                    redirect(base_url().'pages/canceled_payment');
                }
            }
            else {
                redirect(base_url().'pages/canceled_payment');
            }
        }
        else {
            redirect(base_url().'pages/canceled_payment');
        }
    }
    /**************** Pages for WebMoney ENDS *****************************/

    /**************** Pages for Yandex STARTS *****************************/

    function yandex_success(){

        if( isset($_SESSION['yandexSession'])) {
            if($_SESSION['yandexSession'] != '' ) {
                $yandexSessionArr = explode('@#',$_SESSION['yandexSession']);
                $_SESSION['yandexSession'] = '';
                $amount = $yandexSessionArr[1];

                $withDrawalAmount = isset($_POST['withdraw_amount']) ? $_POST['withdraw_amount'] : '';

                if( $withDrawalAmount != '' ) {
                    if( $amount != $withDrawalAmount ) {
                        redirect(base_url().'pages/canceled_payment');
                    }
                }

                $payment_uniqid = $yandexSessionArr[2];
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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

                        $payable_amount = $amount;
                        $vendor_commission = rtrim( trim($vendor_commission) ,',');
                        $admin_commission = rtrim( trim($admin_commission) ,',');

                        $payer_email = isset($_POST['email']) ? $_POST['email'] : '';

                        $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_email'=>$payer_email, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                        $this->ts_functions->sendtransactionemails($emTransId);
                        redirect(base_url().'pages/success_payment');

                    }
                }
                else {
                    redirect(base_url().'pages/canceled_payment');
                }
            }
            else {
                redirect(base_url().'pages/canceled_payment');
            }
        }
        else {
            redirect(base_url().'pages/canceled_payment');
        }

    }

    /**************** Pages for Yandex ENDS *****************************/
	
    /**************** Pages for Tpay STARTS *****************************/
	
	function tpay_ipn(){
		if(isset($_POST['tr_status'])) {
			if($_SERVER['REMOTE_ADDR']=='195.149.229.109'){
			
                $amount = $_POST['tr_amount'];
                $payment_uniqid = $_POST['tr_crc'];
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
                        $uid = $checkPaymentDetails[0]['payment_uid'];

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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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

                        $payable_amount = $amount;
                        $vendor_commission = rtrim( trim($vendor_commission) ,',');
                        $admin_commission = rtrim( trim($admin_commission) ,',');
                        $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

                        $this->ts_functions->sendtransactionemails($emTransId);
                    }
                }
                
			return true;
        }
		}
	}
	
    /**************** Pages for Tpay ENDS *****************************/
    
    
    /**************** Pages for Pagseguro STARTS *****************************/
	
	function pagseguro_ipn(){
	    if(isset($_POST['notificationCode'])) {
	        $notiCode = $_POST['notificationCode'];
	        $pg_email = $this->ts_functions->getsettings('pagseguro','email');
    		$pg_token = $this->ts_functions->getsettings('pagseguro','token');
    		
    		$ch = curl_init();	  
            //curl_setopt($ch, CURLOPT_URL,"https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$notiCode."?email=".$pg_email."&token=".$pg_token."");
            curl_setopt($ch, CURLOPT_URL,"https://ws.pagseguro.uol.com.br/v3/transactions/notifications/".$notiCode."?email=".$pg_email."&token=".$pg_token."");
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_pagseg = curl_exec ($ch);
            curl_close ($ch);
            $xml_response = simplexml_load_string($response_pagseg);
            if( $xml_response->status == 3 ) {
                $payment_uniqid = $xml_response->items->item->id;
                $amount = $xml_response->grossAmount;
                
                $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uniqid'=>$payment_uniqid));

                if( !empty($checkPaymentDetails) ) {
                    if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
                        $uid = $checkPaymentDetails[0]['payment_uid'];

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

                                        $prodCost = $findProduct[0]['prod_price'];
                                        if( $prodOwner[0]['user_accesslevel'] == '3') {
                                            if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                                                $comis = $this->ts_functions->getsettings('vendor','commission');

                                                $v_c = ( $prodCost * $comis ) / 100;
                                                $v_c = round($v_c, 2);

                                                $a_c = $prodCost - $v_c ;
                                            }
                                            else {
                                                $v_c = $prodCost;
                                                $a_c = 0;
                                            }
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

                        $payable_amount = $amount;
                        $vendor_commission = rtrim( trim($vendor_commission) ,',');
                        $admin_commission = rtrim( trim($admin_commission) ,',');
                        
                        $payee_email = $xml_response->sender->email;
                        $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes','payment_amount'=>$amount, 'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission , 'payment_email'=> $payee_email ),array('payment_uniqid'=>$payment_uniqid));

                        $this->ts_functions->sendtransactionemails($emTransId);
                    }
                }
            }
	    }
	}
	
	
	function pagseguro_redirect(){
        if(isset($_GET['transaction_id'])) {
	        $notiCode = $_GET['transaction_id'];
	        $pg_email = $this->ts_functions->getsettings('pagseguro','email');
    		$pg_token = $this->ts_functions->getsettings('pagseguro','token');
    		
    		$ch = curl_init();	  
            //curl_setopt($ch, CURLOPT_URL,"https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/".$notiCode."?email=".$pg_email."&token=".$pg_token."");
            curl_setopt($ch, CURLOPT_URL,"https://ws.pagseguro.uol.com.br/v3/transactions/".$notiCode."?email=".$pg_email."&token=".$pg_token."");
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_pagseg = curl_exec ($ch);
            curl_close ($ch);
            $xml_response = simplexml_load_string($response_pagseg);
            
            if( $xml_response->status == 3 ) {
                // Success
                redirect(base_url().'pages/success_payment');
            }
            else {
                // Cancelled
                redirect(base_url().'pages/canceled_payment');
            }
	    }
	}
		
    /**************** Pages for Pagseguro ENDS *****************************/
    
    
    /**************** Pages for Perfect Money STARTS *****************************/

    function perfectmoney_ipn() {
        $this->DatabaseModel->access_database('ts_settings','insert',array('key_text'=>'ipn '.date('Y-m-d H:i:s'),'value_text'=>json_encode($_POST)),'');
        
    }
    function perfectmoney_success() {
    print_r($_POST);
        $this->DatabaseModel->access_database('ts_settings','insert',array('key_text'=>'suc '.date('Y-m-d H:i:s'),'value_text'=>json_encode($_POST)),'');
        
    }
    function perfectmoney_fail() {
    print_r($_POST);
        $this->DatabaseModel->access_database('ts_settings','insert',array('key_text'=>'fail '.date('Y-m-d H:i:s'),'value_text'=>json_encode($_POST)),'');
        
    }
    /**************** Pages for Perfect Money ENDS *****************************/
    
    
    
}
