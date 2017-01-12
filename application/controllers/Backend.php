<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( !isset($this->session->userdata['ts_uid']) ) {
		    redirect(base_url());
		}
		if( isset($this->session->userdata['ts_uid']) ) {
    		if($this->session->userdata['ts_level'] != 1) {
			    redirect(base_url());
			}
		}
		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
	}

	public function index(){
		$data['basepath'] = base_url();

        $data['userdetails_active'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_status'=>1,'user_accesslevel !='=>1));
        $data['userdetails_inactive'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_status'=>2,'user_accesslevel!='=>1));
        $data['userdetails_blocked'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_status'=>3,'user_accesslevel!='=>1));

        $data['productdetails_active'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1));
        $data['productdetails_free'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>1));

        $data['activePlans'] = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_status'=>1));
        $data['emaillist_uniq'] = $this->DatabaseModel->access_database('ts_emaillist','groupby','e_email','');

        if( !isset($_POST['duration'])) {
            $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel !='=>1));
            $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select','','');
            $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select','','');
            $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','select','','');

            $data['duration'] = $data['d1'] = $data['d2'] = '';
        }
        else if(isset($_POST['duration'])) {

            if( $_POST['duration'] == '' ) {
                $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel !='=>1));
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select','','');
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select','','');
                $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','select','','');

            }
            elseif($_POST['duration'] == 'today'){
                $todaydate = date('Y-m-d');

                $havingArr = array('user_accesslevel !='=>1);
                $like_arr = array('user_registerdate'=>$todaydate);
                $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','like',$havingArr,$like_arr);

                $like_arr = array('prod_analysis_date'=>$todaydate);
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','like','',$like_arr);

                $like_arr = array('purrec_date'=>$todaydate);
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','like','',$like_arr);

                $like_arr = array('e_date'=>$todaydate);
                $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','like','',$like_arr);

            }
            elseif($_POST['duration'] == 'yesterday'){
                $yesterdate = date('Y-m-d',strtotime("-1 days"));

                $havingArr = array('user_accesslevel !='=>1);
                $like_arr = array('user_registerdate'=>$yesterdate);
                $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','like',$havingArr,$like_arr);

                $like_arr = array('prod_analysis_date'=>$yesterdate);
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','like','',$like_arr);

                $like_arr = array('purrec_date'=>$yesterdate);
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','like','',$like_arr);

                $like_arr = array('e_date'=>$yesterdate);
                $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','like','',$like_arr);
            }
            elseif($_POST['duration'] == 'custom'){
                $fromdate = date_format(date_create ( $_POST['d1'] ) , 'Y-m-d H:i:s');
                $todate = date_format(date_create ( $_POST['d2'] ) , 'Y-m-d H:i:s');

                $whr = array(
                        'user_registerdate >=' =>  $fromdate,
                        'user_registerdate <=' =>  $todate,
                        'user_accesslevel'=>2
                );
                $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',$whr);

                $whr = array(
                        'prod_analysis_date >=' =>  $fromdate,
                        'prod_analysis_date <=' =>  $todate
                );
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',$whr);

                $whr = array(
                        'purrec_date >=' =>  $fromdate,
                        'purrec_date <=' =>  $todate
                );
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select','',$whr);

                $whr = array(
                        'e_date >=' =>  $fromdate,
                        'e_date <=' =>  $todate
                );
                $data['emaillist'] = $this->DatabaseModel->access_database('ts_emaillist','select','',$whr);

            }
            $data['duration'] = $_POST['duration'];
            $data['d1'] = $_POST['d1'];
            $data['d2'] = $_POST['d2'];
        }


        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/myboard',$data);
	}

    /****************** Change Admin Password STARTS *********************/

    function admin_change_password(){
        if(isset($_POST['old_pwd'])) {
            $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel'=>1,'user_pwd'=>md5($_POST['old_pwd'])));
            if(!empty($userDetail)){
                $this->DatabaseModel->access_database('ts_user','update',array('user_pwd'=>md5($_POST['new_pwd'])),array('user_id'=>$userDetail[0]['user_id']));
                echo '1';
            }
            else {
                echo '0';
            }
        }
        else {
            echo '0';
        }
        die();
    }
    /****************** Change Admin Password ENDS *********************/

    /****************** User List STARTS *********************/
	public function users(){
		$data['basepath'] = base_url();
		$data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel'=>2));
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/users',$data);
		$this->load->view('backend/include/footer',$data);
	}
    /****************** User List ENDS *********************/

    /************* Single User details STARTS ********************/
	public function single_user($uid=''){
		$data['basepath'] = base_url();
		$data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel'=>2,'user_id'=>$uid));
		$freeProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_free'=>1,'prod_status'=>1));

		$join_array = array('ts_products','ts_products.prod_id = ts_purchaserecord.purrec_prodid');
		$purchasedDetails = $this->DatabaseModel->access_database('ts_purchaserecord','','',array('purrec_uid'=>$uid,'prod_status'=>1),$join_array);

        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {

            $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));

            $userPlan = $userDetail[0]['user_plans'];
            $totalProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>0));

            $planProducts = array();
            if(!empty($totalProducts))
            {
                foreach($totalProducts as $solo_prod) {
                    if( strpos($solo_prod['prod_plan'].',',$userPlan.',') !== FALSE ) {
                        array_push($planProducts,$solo_prod);
                    }
                }
            }
        }
        else {
            $planProducts = array();
        }

		$purchasedDetails = array_merge($purchasedDetails,$planProducts);

		$data['totalProductDetails'] = array_merge($purchasedDetails,$freeProducts);
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/single_user',$data);
		$this->load->view('backend/include/footer',$data);
	}

    /************* Single User details ENDS ********************/

	public function portalrevenue(){
		$data['basepath'] = base_url();
		$data['plandetails'] = $this->DatabaseModel->access_database('ts_plans','select','','');
		$data['vendorplandetails'] = $this->DatabaseModel->access_database('ts_vendorplans','select','','');
		$data['couponsList'] = $this->DatabaseModel->access_database('ts_coupons','select','',array('coup_status'=>1));
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/portalrevenue',$data);
		$this->load->view('backend/include/footer',$data);
	}

	/**** Ajax function to handel subscription plan updates ****/
    public function update_plantable() {
	    if(isset($_POST['planupdate'])) {
	        $updatedata = json_decode($_POST['updatedata']);
	            $nID = '0';
	        foreach( $updatedata as $soloKey=>$soloValue ) {
	            if( strpos($soloKey,'V') === false ) {
                    $colArr = explode('#',$soloKey);
                    if( count($colArr) == 2 ) {
                        $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$colArr[1]));
                    }
                    else {
                        if( $colArr[0] == 'plan_duration' ) {
                            if( $soloValue == 'Life Time' ) {
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$colArr[2]));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $nkey2 = $colArr[0].'#period#'.$colArr[2];
                                $colValue = $updatedata->$nKey1.' '.$updatedata->$nkey2;
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$colValue),array('plan_id'=>$colArr[2]));
                            }
                        }
                        /***********************/

                        if( $colArr[0] == 'plan_product' ) {
                            if( $soloValue == 'All' ) {
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$colArr[2]));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $colValue = $updatedata->$nKey1;
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$colValue),array('plan_id'=>$colArr[2]));
                            }
                        }
                    }
	            }
	            else {
	                // New data
	                $colArr = explode('#',$soloKey);
                    if( count($colArr) == 2 ) {
                        if($nID == '0') {
                            $nID = $this->DatabaseModel->access_database('ts_plans','insert',array($colArr[0]=>$soloValue),'');
                        }
                        else {
                            $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$nID));
                        }
                    }
                    else {
                        if( $colArr[0] == 'plan_duration' ) {
                            if( $soloValue == 'Life Time' ) {
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$nID));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $nkey2 = $colArr[0].'#period#'.$colArr[2];
                                $colValue = $updatedata->$nKey1.' '.$updatedata->$nkey2;
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$colValue),array('plan_id'=>$nID));
                            }
                        }
                        /***********************/

                        if( $colArr[0] == 'plan_product' ) {
                            if( $soloValue == 'All' ) {
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$soloValue),array('plan_id'=>$nID));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $colValue = $updatedata->$nKey1;
                                $this->DatabaseModel->access_database('ts_plans','update',array($colArr[0]=>$colValue),array('plan_id'=>$nID));
                            }
                        }
                    }
	            }
	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}


	/**** Ajax function to handel vendor plan updates ****/
    public function update_vendore_plantable() {
	    if(isset($_POST['vplanupdate'])) {
	        $updatedata = json_decode($_POST['updatedata']);
	            $nID = '0';
	        foreach( $updatedata as $soloKey=>$soloValue ) {
	            if( strpos($soloKey,'T') === false ) {
                    $colArr = explode('#',$soloKey);
                    if( count($colArr) == 2 ) {
                        $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$soloValue),array('vplan_id'=>$colArr[1]));
                    }
                    else {
                        if( $colArr[0] == 'vplan_duration' ) {
                            if( $soloValue == 'Life Time' ) {
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$soloValue),array('vplan_id'=>$colArr[2]));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $nkey2 = $colArr[0].'#period#'.$colArr[2];
                                $colValue = $updatedata->$nKey1.' '.$updatedata->$nkey2;
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$colValue),array('vplan_id'=>$colArr[2]));
                            }
                        }
                        /***********************/

                        if( $colArr[0] == 'plan_product' ) {
                            if( $soloValue == 'All' ) {
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$soloValue),array('vplan_id'=>$colArr[2]));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $colValue = $updatedata->$nKey1;
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$colValue),array('vplan_id'=>$colArr[2]));
                            }
                        }
                    }
	            }
	            else {
	                // New data
	                $colArr = explode('#',$soloKey);
                    if( count($colArr) == 2 ) {
                        if($nID == '0') {
                            $nID = $this->DatabaseModel->access_database('ts_vendorplans','insert',array($colArr[0]=>$soloValue),'');
                        }
                        else {
                            $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$soloValue),array('vplan_id'=>$nID));
                        }
                    }
                    else {
                        if( $colArr[0] == 'vplan_duration' ) {
                            if( $soloValue == 'Life Time' ) {
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$soloValue),array('vplan_id'=>$nID));
                            }
                            else {
                                $nKey1 = $colArr[0].'#num#'.$colArr[2];
                                $nkey2 = $colArr[0].'#period#'.$colArr[2];
                                $colValue = $updatedata->$nKey1.' '.$updatedata->$nkey2;
                                $this->DatabaseModel->access_database('ts_vendorplans','update',array($colArr[0]=>$colValue),array('vplan_id'=>$nID));
                            }
                        }
                    }
	            }
	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	/****** Email Section STARTS **************/

	public function email_integrations($em_name='') {
	if( $em_name != '') {
		$res_em_resp = $this->DatabaseModel->access_database('ts_emailproviders','select','',array('ep_name'=>$em_name));
		if(!empty($res_em_resp)) {
			$this->DatabaseModel->access_database('ts_emailproviders','delete','',array('ep_name'=>$em_name));
			$resID = $res_em_resp[0]['ep_id'];
$this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));
redirect(base_url().'backend/email_integrations');
		}
	}
	    $data['basepath'] = base_url();
	    $res_em_resp = $this->DatabaseModel->access_database('ts_emailproviders','select','','');
        $data['emailresponders'] = $res_em_resp;

        //$all_responders = array('CampaignMonitor','ConstantContact','GetResponse','Mailchimp','SendReach','iContact','Infusionsoft','Hubspot','Aweber','ActiveCampaign','Sendlane','Benchmark','Sendy','Madmimi','Sendinblue');
        $all_responders = array('ConstantContact','GetResponse','Mailchimp','Aweber','Sendinblue','Freshmail','ActiveCampaign');

        $connect_resp = array();
        if(!empty($res_em_resp)) {
            foreach($res_em_resp as $solo_resp) {
                $connect_resp[] = $solo_resp['ep_name'];
            }
            $left_respon = array_diff($all_responders, $connect_resp);
            //array_push($left_respon);
        }
        else {
            $left_respon = $all_responders;
        }

        $data['left_responders'] = $left_respon;
        $data['connect_resp'] = $connect_resp;
	    $this->load->view('backend/include/header',$data);
		$this->load->view('backend/email_integrations',$data);
		$this->load->view('backend/include/footer',$data);
	}

	public function email_integrations_ajx() {
	    if(isset($_POST['emAppId'])) {

        if( $_POST['emAppId'] == 'Mailchimp') {
            // Mailchimp Autoresponder

            require_once 'emailIntegration_resources/Mailchimp/MCAPI.class.php';

            $list = array();
            if ( $_POST['Mailchimp_apikey'])
            {

                $api = new MCAPI($_POST['Mailchimp_apikey']);
                $retval = $api->lists();
                if (!$api->errorCode)
                {
                    if($retval['total'] != 0){
                        foreach ($retval['data'] as $v)
                        {
                            $list[$v['id']] = $v['name'];
                        }

                        $insertArr = array(
                            'ep_name'   =>  $_POST['emAppId']
                        );

                        $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                        if( empty($res)) {
                            $insertArr['ep_credentials'] = json_encode(array('Mailchimp_apikey'=>$_POST['Mailchimp_apikey']));

                            $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                        }
                        else {
                             $resID = $res[0]['ep_id'];

                             $updateArr['ep_credentials'] = json_encode(array('Mailchimp_apikey'=>$_POST['Mailchimp_apikey']));
                             $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                        }

                        $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));

                        foreach($list as $key=>$val) {

                            $listInsertArr = array(
                                'eplist_parentid' =>  $resID,
                                'eplist_uniqid' =>  $key,
                                'eplist_name' =>  $val
                            );
                            $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
                        }

                    }
                    else {
                        echo 'ZERO'; // When no list found
                    }
                }
                else {
                    echo '404';
                }
            }
            else {
                echo '404';
            }

        }
        elseif( $_POST['emAppId'] == 'GetResponse') {
            // Get_Response Autoresponder

            require_once 'emailIntegration_resources/GetResponse/jsonRPCClient.php';

            $list = array();
            if ( $_POST['GetResponse_apikey'])
            {
                $api = new jsonRPCClient('http://api2.getresponse.com');
                try
                {
                    $result = $api->get_campaigns($_POST["GetResponse_apikey"]);
                    if( count($result) > 0 ) {

                        $insertArr = array(
                                'ep_name'   =>  $_POST['emAppId']
                        );

                        $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                        if( empty($res)) {
                            $insertArr['ep_credentials'] = json_encode(array('GetResponse_apikey'=>$_POST['GetResponse_apikey']));


                            $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                        }
                        else {
                             $resID = $res[0]['ep_id'];

                             $updateArr['ep_credentials'] = json_encode(array('GetResponse_apikey'=>$_POST['GetResponse_apikey']));

                             $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                        }

                        $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));

                        foreach ($result as $k => $v)
                        {
                            $list_key = $k;
                            $list_name = $v['name'];

                            $listInsertArr = array(
                                'eplist_parentid' =>  $resID,
                                'eplist_uniqid' =>  $list_key,
                                'eplist_name' =>  $list_name
                            );
                            $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
                        }
                    }
                    else {
                        echo 'ZERO'; // When no list found
                    }
                }
                catch (Exception $e)
                {
                   echo '404'; // Invalid API key
                }
            }
            else {
                echo '404';
            }

        }
        elseif( $_POST['emAppId'] == 'Aweber') {
            // Aweber Autoresponder


            if ( isset ($_POST['Aweber_code']) )
            {
                require_once 'emailIntegration_resources/Aweber/aweber_api.php';
                $data_arr = array();

                $descr = '';
                try
                {
                    list($consumer_key, $consumer_secret, $access_key, $access_secret) = AWeberAPI::getDataFromAweberID($_POST['Aweber_code']);
                }
                catch (AWeberAPIException $exc)
                {
                    list($consumer_key, $consumer_secret, $access_key, $access_secret) = null;
                    if(isset($exc->message))
                    {
                        $descr = $exc->message;
                        $descr = preg_replace('/http.*$/i', '', $descr);	 # strip labs.aweber.com documentation url from error message
                        $descr = preg_replace('/[\.\!:]+.*$/i', '', $descr); # strip anything following a . : or ! character
                        $descr = '('.$descr.')';

                    }
                }
                catch (AWeberOAuthDataMissing $exc)
                {
                    list($consumer_key, $consumer_secret, $access_key, $access_secret) = null;
                }
                catch (AWeberException $exc)
                {
                    list($consumer_key, $consumer_secret, $access_key, $access_secret) = null;
                }

                if (!$access_secret)
                {
                    echo '404';
                }
                else
                {
                    $aweber = new AWeberAPI($consumer_key, $consumer_secret);
                    $account = $aweber->getAccount($access_key, $access_secret);
                    $aweber_result = $account->lists;
                    if( $aweber_result->data['total_size'] != '' && $aweber_result->data['total_size'] != 0 )
                    {

                        $insertArr = array(

                                'ep_name'   =>  $_POST['emAppId']
                        );

                        $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                        if( empty($res)) {
                            $insertArr['ep_credentials'] = json_encode(array('Aweber_consumer_key'=>$consumer_key,'Aweber_consumer_secret'=>$consumer_secret,'Aweber_access_key'=>$access_key,'Aweber_access_secret'=>$access_secret));


                            $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                        }
                        else {
                             $resID = $res[0]['ep_id'];

                             $updateArr['ep_credentials'] = json_encode(array('Aweber_consumer_key'=>$consumer_key,'Aweber_consumer_secret'=>$consumer_secret,'Aweber_access_key'=>$access_key,'Aweber_access_secret'=>$access_secret));

                             $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                        }

                        $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));


                        foreach ($aweber_result->data['entries'] as $solo_list)
                        {
                             $listInsertArr = array(
                                'eplist_parentid' =>  $resID,
                                'eplist_uniqid' =>  $solo_list['id'],
                                'eplist_name' =>  $solo_list['name']
                            );
                            $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
                        }
                    }
                    else {
                        echo 'ZERO';
                    }

                }

            }
            else {
                echo '404';
            }

        }
        elseif( $_POST['emAppId'] == 'ConstantContact') {

            // ConstantContact Autoresponder
            require_once 'emailIntegration_resources/ConstantContact/class.cc.php';
            $cc = new cc($_POST["ConstantContact_uname"], $_POST["ConstantContact_pwd"]);

            $resultofcc = $cc->get_lists('lists');


            if ($resultofcc)
            {

                if( count($resultofcc) > 0 ) {
                    $insertArr = array(

                            'ep_name'   =>  $_POST['emAppId']
                    );

                    $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                    if( empty($res)) {
                        $insertArr['ep_credentials'] = json_encode(array('ConstantContact_uname'=>$_POST['ConstantContact_uname'],'ConstantContact_pwd'=>$_POST['ConstantContact_pwd']));


                        $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                    }
                    else {
                         $resID = $res[0]['ep_id'];

                         $updateArr['ep_credentials'] = json_encode(array('ConstantContact_uname'=>$_POST['ConstantContact_uname'],'ConstantContact_pwd'=>$_POST['ConstantContact_pwd']));

                         $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                    }

                    $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));


                    foreach($resultofcc as $list){

                            $listInsertArr = array(
                                'eplist_parentid' =>  $resID,
                                'eplist_uniqid' =>  $list['id'],
                                'eplist_name' =>  $list['Name']
                            );
                            $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
                    }

                }
                else {
                    echo 'ZERO';
                }
            }
            else
            {
                echo '404';
            }

        }
        elseif( $_POST['emAppId'] == 'Sendinblue') {
            // Sendinblue Autoresponder

            if ( isset($_POST['Sendinblue_apikey']) )
            {

                $apikey = $_POST['Sendinblue_apikey'];
                require_once 'emailIntegration_resources/Sendinblue/Mailin.php';

	            $mailin = new Mailin('https://api.sendinblue.com/v2.0',$apikey);

                $data = array(
                  "page" => 1,
                  "page_limit" => 50
                );
                $retvals = $mailin->get_lists($data);
                if( $retvals['code'] == 'success' ) {
                    if( count($retvals['data']['lists']) > 0 ) {

                        $insertArr = array(

                                'ep_name'   =>  $_POST['emAppId']
                        );

                        $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                        if( empty($res)) {
                            $insertArr['ep_credentials'] = json_encode(array('Sendinblue_apikey'=>$_POST['Sendinblue_apikey']));


                            $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                        }
                        else {
                             $resID = $res[0]['ep_id'];

                             $updateArr['ep_credentials'] = json_encode(array('Sendinblue_apikey'=>$_POST['Sendinblue_apikey']));

                             $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                        }
                        $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));
                        foreach($retvals['data']['lists'] as $retval)
                        {
                            $listInsertArr = array(
                                'eplist_parentid' =>  $resID,
                                'eplist_uniqid' =>  $retval['id'],
                                'eplist_name' =>  $retval['name']
                            );
                            $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');

                        }
                    }
                    else {
                        echo 'ZERO';
                    }
                }
                else {
                    echo '404';
                }
            }
            else {
                echo '404';
            }


        }
        elseif( $_POST['emAppId'] == 'Freshmail') {
            // Sendinblue Autoresponder

            if ( isset($_POST['Freshmail_apikey']) && isset($_POST['Freshmail_apisecret']) )
            {

                define ( 'FM_API_KEY', $_POST['Freshmail_apikey'] );
                define ( 'FM_API_SECRET', $_POST['Freshmail_apisecret'] );

                require_once 'emailIntegration_resources/Freshmail/class.rest.php';

	            $rest = new FmRestAPI();
                $rest->setApiKey( FM_API_KEY );
                $rest->setApiSecret( FM_API_SECRET );
                //testing GET request
                try {
                    $response = $rest->doRequest('ping');

                    try {
                        $response = $rest->doRequest('subscribers_list/lists');
                        if( $response['status'] == 'OK' ) {
                            if( count($response['lists']) != '0' ) {

                                $insertArr = array(

                                        'ep_name'   =>  $_POST['emAppId']
                                );

                                $res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

                                if( empty($res)) {
                                    $insertArr['ep_credentials'] = json_encode(array('Freshmail_apikey'=>$_POST['Freshmail_apikey'],'Freshmail_apisecret'=>$_POST['Freshmail_apisecret']));


                                    $resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
                                }
                                else {
                                     $resID = $res[0]['ep_id'];

                                     $updateArr['ep_credentials'] = json_encode(array('Freshmail_apikey'=>$_POST['Freshmail_apikey'],'Freshmail_apisecret'=>$_POST['Freshmail_apisecret']));

                                     $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
                                }


                                $this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));
                                foreach($response['lists'] as $solo_list)
                                {
                                    $listInsertArr = array(
                                        'eplist_parentid' =>  $resID,
                                        'eplist_uniqid' =>  $solo_list['subscriberListHash'],
                                        'eplist_name' =>  $solo_list['name']
                                    );
                                    $this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
                                }
                            }
                            else {
                                echo 'ZERO';
                            }
                        }
                        else {
                            echo '404';
                        }

                    // Get List
                    } catch (Exception $e) {
                        echo '404';
                    }

                // Check Connection
                } catch (Exception $e) {
                    echo '404';
                }


            }
            else {
                echo '404';
            }


        }
        elseif( $_POST['emAppId'] == 'ActiveCampaign') {
            // ActiveCampaign Autoresponder

            if ( $_POST['ActiveCampaign_apiurl'] && $_POST['ActiveCampaign_apikey'] )
            {
                $url = $_POST['ActiveCampaign_apiurl'];
                $apikey = $_POST['ActiveCampaign_apikey'];
                $params = array(

                    'api_key'      => $apikey,
                    'api_action'   => 'list_paginator',
                    'api_output'   => 'json',
                    'somethingthatwillneverbeused' => '',
                    'sort' => '',
                    'offset' => 0,
                    'limit' => 20,
                    'filter' => 0,
                    'public' => 0,

                );

                $query = "";
                foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
                $query = rtrim($query, '& ');
                $url = rtrim($url, '/ ');
                
                if ( !function_exists('curl_init') ) { echo '404'; }

                if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
                    echo '404';
                }
                $api = $url . '/admin/api.php?' . $query;

                $request = curl_init($api);
                curl_setopt($request, CURLOPT_HEADER, 0);
                curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
                $response = (string)curl_exec($request);
                curl_close($request);

                if ( !$response ) {
                   echo '404';
                }

                $result = json_decode($response);
                if( $result->result_code == 0 ) {
                    echo '404';
                }
                else {
                    if ( $result->cnt == 0 ) {
                        echo 'ZERO';
                    }
                    else {

						 $insertArr = array(
								'ep_name'   =>  $_POST['emAppId']
						);

						$res = $this->DatabaseModel->access_database('ts_emailproviders','select','',$insertArr);

						if( empty($res)) {
							$insertArr['ep_credentials'] = json_encode(array('ActiveCampaign_apiurl'=>$_POST['ActiveCampaign_apiurl'],'ActiveCampaign_apikey'=>$_POST['ActiveCampaign_apikey']));


							$resID = $this->DatabaseModel->access_database('ts_emailproviders','insert',$insertArr,'');
						}
						else {
							 $resID = $res[0]['ep_id'];

							 $updateArr['ep_credentials'] = json_encode(array('ActiveCampaign_apiurl'=>$_POST['ActiveCampaign_apiurl'],'ActiveCampaign_apikey'=>$_POST['ActiveCampaign_apikey']));
							 $this->DatabaseModel->access_database('ts_emailproviders','update',$updateArr,array('ep_id'=>$resID));
						}

$this->DatabaseModel->access_database('ts_eplist','delete','',array('eplist_parentid'=>$resID));
						foreach($result->rows as $solo_list)
						{
							$list_key = $solo_list->id;
							$list_name = $solo_list->name;
							
							$listInsertArr = array(
								'eplist_parentid' =>  $resID,
								'eplist_uniqid' =>  $list_key,
								'eplist_name' =>  $list_name
							);
							
							$this->DatabaseModel->access_database('ts_eplist','insert',$listInsertArr,'');
						}
                    }
                }
                
            }
            else {
                echo '404';
            }

        }

        }
        die();
	}

    public function saveListToConnect() {
        if(isset($_POST['jsondata'])) {
            $jsondata = json_decode($_POST['jsondata']);
            foreach($jsondata as $key=>$val) {
                $this->ts_functions->updatesettings($key,$val);
            }
            if($_POST['elistStr'] != '') {
                $ress = $this->DatabaseModel->access_database('ts_eplist','select','','');
                if(!empty($ress)) {
                    foreach($ress as $soloress) {
                        $dataArr1 = array('eplist_use'=>0);
                        $whrArr1 = array('eplist_id'=>$soloress['eplist_id']);
                        $this->DatabaseModel->access_database('ts_eplist','update',$dataArr1,$whrArr1);
                    }
                }
                $strArr = explode('@#',$_POST['elistStr']);
                for($i=0;$i<count($strArr);$i++) {
                    if($strArr[$i] != '') {
                        $dataArr = array('eplist_use'=>1);
                        $whrArr = array('eplist_id'=>$strArr[$i]);
                        $this->DatabaseModel->access_database('ts_eplist','update',$dataArr,$whrArr);
                    }
                }
            }

            echo '1';
        }
        else {
            echo '0';
        }
        die();
    }


	public function email_list() {
	    $data['basepath'] = base_url();
	    $joinArr = array('ts_eplist','ts_eplist.eplist_id = ts_emaillist.e_list');
	    $listusers = $this->DatabaseModel->access_database('ts_emaillist','','','',$joinArr);

	    $listusers1 = $this->DatabaseModel->access_database('ts_emaillist','select','',array('e_list'=>0));
        $data['listusers'] = array_merge($listusers,$listusers1);
	    $this->load->view('backend/include/header',$data);
		$this->load->view('backend/email_list',$data);
		$this->load->view('backend/include/footer',$data);
	}

	public function email_list_export($type='') {
	    if($type != '') {

	        $filename = 'Email-List.'.$type;
            $joinArr = array('ts_eplist','ts_eplist.eplist_id = ts_emaillist.e_list');
	        $result1 = $this->DatabaseModel->access_database('ts_emaillist','','','',$joinArr);

	        $result2 = $this->DatabaseModel->access_database('ts_emaillist','select','',array('e_list'=>0));

	        $result = array_merge($result1,$result2);
	        $col_arr = array('Index','Email','List Name','Type','Date');
	        if(!empty($result)) {
	                $str = '';
	                $count=0;

                if( $type == 'csv' ) {
                    $filename = 'Email-List.csv';
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename='.$filename);

                    foreach($result as $soloRes) {
                        $elistname = ( $soloRes['e_list'] != '0' && $soloRes['e_list'] != '' ) ? $soloRes['eplist_name'] : '-' ;
                        $count++;
                        $str .= $count.",".$soloRes['e_email'].",".$elistname.",".$soloRes['e_type'].",".date_format(date_create ( $soloRes['e_date'] ) , 'M d Y')."\r\n";
                    }
                    echo implode(",", $col_arr) . "\r\n";

                    echo $str;

                }
                else {

                    $filename = 'Email-List.xls';
                    header("Content-Disposition: attachment; filename=".$filename);
                    header("Content-Type: application/vnd.ms-excel");
                    foreach($result as $soloRes) {
                        $elistname = ( $soloRes['e_list'] != '0' && $soloRes['e_list'] != '' ) ? $soloRes['eplist_name'] : '-' ;
                        $count++;
                        $str .= $count."\t".$soloRes['e_email']."\t".$elistname."\t".$soloRes['e_type']."\t".date_format(date_create ( $soloRes['e_date'] ) , 'M d, Y')."\r\n";
                    }
                    echo implode("\t", $col_arr) . "\r\n";

                    echo $str;
                }

            }
            else {
                 redirect(base_url().'backend/email_list');
            }
	    }
	    else {
             redirect(base_url().'backend/email_list');
        }
	}


	public function email_templates() {
	    if(isset($_POST['type'])) {
	        $type = $_POST['type'];

	        if(isset($_POST['logoshow'])) {
	            $this->ts_functions->updatesettings($type.'_logoshow',$_POST['logoshow']);
	        }
	        if( isset($_POST['emText']) ) {
	            $this->ts_functions->updatesettings($type.'_text',$_POST['emText']);
	            if( isset($_POST['linktext']) ) {
	            	$this->ts_functions->updatesettings($type.'_linktext',$_POST['linktext']);
	            }
	        }
	        else if( isset($_POST['fromname']) ) {
	            $this->ts_functions->updatesettings($type.'_fromname',$_POST['fromname']);
	            $this->ts_functions->updatesettings($type.'_fromemail',$_POST['fromemail']);
	            $this->ts_functions->updatesettings($type.'_replytoshow',$_POST['replytoshow']);
	            $this->ts_functions->updatesettings($type.'_replyemail',$_POST['replyemail']);
	            $this->ts_functions->updatesettings($type.'_contactemail',$_POST['contactemail']);
	        }
	        echo '1';
	        die();
	    }
	    else
	    {
            $data['basepath'] = base_url();
            $this->load->view('backend/include/header',$data);
            $this->load->view('backend/email_templates',$data);
            $this->load->view('backend/include/footer',$data);
		}
	}

    function sendTestEmails() {
        if(isset($_POST['testemail'])) {
            $to=$_POST['testemail'];
            $type = $_POST['type'];
            $subject="Test email for ".$_POST['type'];
            $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>".$this->ts_functions->getsettings('sitetitle','text')."</title>
            </head><body>";
            if( $this->ts_functions->getsettings('email','logoshow') == '1' ) {
                $body = "<img src='".$this->ts_functions->getsettings('logo','url')."' alt='".$this->ts_functions->getsettings('sitetitle','text')."'  title='".$this->ts_functions->getsettings('sitetitle','text')."'/>";
            }
            else {
                $body = '';
            }

            $link = "<a href='".base_url()."'>".$this->ts_functions->getsettings($type,'linktext')."</a>";
            $emContent = $this->ts_functions->getsettings($type,'text');
            $emContent = str_replace("[username]","username",$emContent);
            $emContent = str_replace("[password]","password",$emContent);
            $emContent = str_replace("[website_link]",base_url(),$emContent);
            $emContent = str_replace("[break]","<br/>",$emContent);
            $emContent = str_replace("[linktext]",$link,$emContent);

            $body .="<p>".$emContent."</p>";

            $from = $this->ts_functions->getsettings('email','fromname');
            $from_add = $this->ts_functions->getsettings('email','fromemail');
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
            'Reply-To: '.$from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to,$subject,$bodyhead.$body.'</body></html>',$headers, '-f'.$from_add);
            echo '1';
        }
        else {
            echo '0';
        }
        die();
    }
	/******* Email Section ENDS **************/

	/********* Testimonials Settings STARTS **********/

	function testimonials($tid='') {
	    $data['basepath'] = base_url();
	    if($tid != '') {
	        $data['solotesti'] = $this->DatabaseModel->access_database('ts_testimonial','select','',array('	testi_id'=>$tid));
	    }
	    else {
	        $data['solotesti'] = array();
	    }
	    $data['testi_details'] = $this->DatabaseModel->access_database('ts_testimonial','orderby',array('	testi_order','asc'),'');
	    $this->load->view('backend/include/header',$data);
		$this->load->view('backend/testimonials',$data);
	}

	function add_testimonial() {
	    if(isset($_POST['clientname'])) {
	        $testiDataArr = array();
	        if($_FILES['clientimage']['name'] != ''){
	            $path=dirname(__FILE__);
                $abs_path=explode('/application/',$path);
                $pathToImages = $abs_path[0].'/webimage/';

                $config['upload_path'] = $pathToImages;
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('clientimage'))
                {
                    $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                    $imgNewname = $randomstr;
                    $uploaddata=$this->upload->data();
                    $img_name = $uploaddata['raw_name'];
                    $img_ext = $uploaddata['file_ext'];
                    $imgNewname = $imgNewname.$img_ext;
                    rename($pathToImages.$img_name.$img_ext, $pathToImages.$imgNewname);
                    $testiDataArr['testi_image']=$imgNewname;
                }
	        }

	        $chk = (isset($_POST['clientdesignation_checkbox']) ? '1' : '0');
	        $testiDataArr['testi_name'] = $_POST['clientname'];
	        $testiDataArr['testi_showdesig'] = $chk;
	        $testiDataArr['testi_desig'] = $_POST['clientdesignation'];
	        $testiDataArr['testi_msg'] = $_POST['clientmsg'];

	        if($_POST['old_testid']=='0') {
	            $this->DatabaseModel->access_database('ts_testimonial','insert',$testiDataArr,'');
                $this->session->userdata['ts_success'] = 'Testimonial added successfully.';
            }
            else {
                $this->DatabaseModel->access_database('ts_testimonial','update',$testiDataArr, array('testi_id'=>$_POST['old_testid']));
                $this->session->userdata['ts_success'] = 'Testimonial updated successfully.';
            }

            redirect(base_url().'backend/testimonials');
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	function save_testimonial_order() {
	    if(isset($_POST['testi_id'])) {
            $testi_array= explode(',',$_POST['testi_id']);
            $ord = 0;
            for($i=0; $i<count($testi_array); $i++){
                $ord++;
                $testiID = $testi_array[$i];
                $this->DatabaseModel->access_database('ts_testimonial','update', array('testi_order'=>$ord) , array('testi_id'=>$testiID));
            }
            echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	/********* Testimonials Settings ENDS **********/

	/********* Category Settings STARTS **********/

	function categories($cid='') {
	    $data['basepath'] = base_url();
	    if($cid != '') {
	        $data['solocate'] = $this->DatabaseModel->access_database('ts_categories','select','',array('	cate_id'=>$cid));
	    }
	    else {
	        $data['solocate'] = array();
	    }
	    $data['cate_details'] = $this->DatabaseModel->access_database('ts_categories','select','','');
	    $this->load->view('backend/include/header',$data);
		$this->load->view('backend/category_page',$data);
		$this->load->view('backend/include/footer',$data);
	}

	function add_categories() {
	    if(isset($_POST['catename'])) {
	        $cateDataArr = array();
            if( $_POST['catename'] != '' ) {
                $cateDataArr['cate_name'] = $_POST['catename'];
                $cateDataArr['cate_urlname'] = strtolower($_POST['cateurlname']);

                if($_POST['old_cateid']=='0') {
                    $this->DatabaseModel->access_database('ts_categories','insert',$cateDataArr,'');
                    $this->session->userdata['ts_success'] = 'Category added successfully.';
                }
                else {
                    $this->DatabaseModel->access_database('ts_categories','update',$cateDataArr, array('cate_id'=>$_POST['old_cateid']));
                    $this->session->userdata['ts_success'] = 'Category updated successfully.';
                }
            }
            else {
                $this->session->userdata['ts_error'] = "Category can not be added.";
            }

            redirect(base_url().'backend/categories');
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	/********* Category Settings ENDS **********/

	/********* Sub Category Settings STARTS **********/

	function sub_categories($sub_cid='') {
	    $data['basepath'] = base_url();
	    if($sub_cid != '') {
	        $data['solo_sub_cate'] = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_id'=>$sub_cid));
	    }
	    else {
	        $data['solo_sub_cate'] = array();
	    }
	    $data['sub_cate_details'] = $this->DatabaseModel->access_database('ts_subcategories','select','','');
	    $data['cate_details'] = $this->DatabaseModel->access_database('ts_categories','select','','');
	    $this->load->view('backend/include/header',$data);
		$this->load->view('backend/sub_categories_page',$data);
		$this->load->view('backend/include/footer',$data);
	}

	function add_sub_categories() {
	    if(isset($_POST['sub_catename'])) {
	        $sub_cateDataArr = array();
            if( $_POST['sub_catename'] != '' ) {
                $sub_cateDataArr['sub_name'] = $_POST['sub_catename'];
                $sub_cateDataArr['sub_urlname'] = strtolower($_POST['sub_cateurlname']);
                $sub_cateDataArr['sub_parent'] = $_POST['sub_parent'];

                if($_POST['old_sub_cateid']=='0') {
                    $this->DatabaseModel->access_database('ts_subcategories','insert',$sub_cateDataArr,'');
                    $this->session->userdata['ts_success'] = 'Sub Category added successfully.';
                }
                else {
                    $this->DatabaseModel->access_database('ts_subcategories','update',$sub_cateDataArr, array('sub_id'=>$_POST['old_sub_cateid']));
                    $this->session->userdata['ts_success'] = 'Sub Category updated successfully.';
                }
            }
            else {
                $this->session->userdata['ts_error'] = "Sub Category can not be added.";
            }

            redirect(base_url().'backend/sub_categories');
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

    function getSubCategories(){
        if(isset($_POST['cateId'])) {
            $subCate  = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$_POST['cateId']));
            $str = '<option value="0">Choose one</option>';
            if(!empty($subCate)) {
                foreach($subCate as $solo_subCate) {
                    $str .= '<option value="'.$solo_subCate['sub_id'].'">'.$solo_subCate['sub_name'].'</option>';
                }
            }
            else {
                $str .= '<option value="0">Nothing found</option>';
            }
            echo $str;
        }
        else {
	        echo '0';
	    }
	    die();
    }
	/********* Sub Category Settings ENDS **********/

	/************ Compliance Page STARTS *****************/
	function compliance_pages(){
	    if(isset($_POST['pageSection'])) {
	    // Ajax
	        $pageSection = json_decode($_POST['pageSection']);
	        foreach( $pageSection as $soloKey=>$soloValue ) {
	            $colArr = explode('V7',$soloKey);
	            if(count($colArr) == 2) {
	                $this->DatabaseModel->access_database('ts_pages','update', array($colArr[0]=>$soloValue) , array('page_type'=>$pageSection->typee));
	            }
	        }
	        echo '1';
	    }
	    else {
            $data['pageSection'] = $this->DatabaseModel->access_database('ts_pages','select', '' , '');
            $data['basepath'] = base_url();
            $this->load->view('backend/include/header',$data);
            $this->load->view('backend/compliance_pages',$data);
		}
	}
	/************ Compliance Page ENDS *****************/

	/************ Transaction History STARTS *******************/

	function transaction_history(){
	    $data['transactionDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , '');
	    $data['totalTransaction'] = $this->DatabaseModel->access_database('ts_paymentdetails','totalvalue', array('payment_amount','totalAmount') , array('payment_status'=>'yes'));

        $data['basepath'] = base_url();
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/transaction_history',$data);
        $this->load->view('backend/include/footer',$data);
	}

    function transaction_history_detail(){
        if(isset($_POST['currentId'])){

            $join_array = array('ts_user','ts_user.user_id = ts_paymentdetails.payment_uid');
		    $transactionDetails = $this->DatabaseModel->access_database('ts_paymentdetails','','',array('payment_id'=>$_POST['currentId']),$join_array);
		    $sym = $this->ts_functions->getsettings('portal','curreny');

            if(empty($transactionDetails)) {
                echo '<p>Data can not be fetched.</p>';
            }
            else {
                $custom = trim($transactionDetails[0]['payment_pid']);
                $customArr = explode(',',$custom);
                $outputStr = '';

                $outputStr .= '<p> User Details </p> <p> Username : <b>'.$transactionDetails[0]['user_uname'].'</b></p> <p> Email : <b>'.$transactionDetails[0]['user_email'].'</b></p> <p> Registration Date : <b>'.date_format(date_create ( $transactionDetails[0]['user_registerdate'] ) , 'M d, Y').'</b></p> <p> Transaction Mode : <b>'.ucfirst($transactionDetails[0]['payment_mode']).'</b></p> <p> Payer\'s Email : <b>'.$transactionDetails[0]['payment_email'].'</b></p> <p> Total Cost : <b>'.$sym.' '.$transactionDetails[0]['payment_total'].'</b></p> <p> Discount Applied : <b>'.$sym.' '.$transactionDetails[0]['payment_discount'].'</b></p> <p> Amount Paid : <b>'.$sym.' '.$transactionDetails[0]['payment_amount'].'</b></p><hr />';
                $venStr = trim($transactionDetails[0]['payment_vendor_commission']);
                $venCommArr = array();
                if( $venStr != '' ) {
                    $venArr = explode(',',$venStr);

                    for($i=0;$i<count($venArr);$i++) {
                        $venSplitArr = explode('@#', trim($venArr[$i]));
                        $venCommArr[ $venSplitArr[0] ] = $venSplitArr[1];
                    }
                }
                $adminStr = trim($transactionDetails[0]['payment_admin_commission']);
                $adminCommArr = array();
                if( $adminStr != '' ) {
                    $adminArr = explode(',',$adminStr);

                    for($i=0;$i<count($adminArr);$i++) {
                        $adminSplitArr = explode('@#', trim($adminArr[$i]));
                        $adminCommArr[ $adminSplitArr[0] ] = $adminSplitArr[1];
                    }
                }

                for($i=0;$i<count($customArr);$i++) {

                    $pId = trim($customArr[$i]);
                    if( $transactionDetails[0]['payment_type'] == 'vendor_plan' ) {
                        $findPlan = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$pId,'vplan_status'=>1));
                    }
                    else {
                        $findPlan = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$pId,'plan_status'=>1));
                    }

                    $findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId,'prod_status'=>1));

                    if(!empty($findPlan) || !empty($findProduct)) {

                        if(!empty($findPlan)) {
                            if( $transactionDetails[0]['payment_type'] == 'vendor_plan' ) {
                                $outputStr .= '<p> Vendor Plan Name: <b>'.$findPlan[0]['vplan_name'].'</b></p>';
                                $outputStr .= '<p> Vendor Plan Amount : <b>'.$sym.' '.$findPlan[0]['vplan_amount'].'</b></p>';
                                $outputStr .= '<p> Commission Admin will get : <b>'.$sym.' '.$findPlan[0]['vplan_amount'].'</b></p>';
                            }
                            else {
                                $outputStr .= '<p> Product Plan Name : <b>'.$findPlan[0]['plan_name'].'</b></p>';
                                $outputStr .= '<p> Product Plan Amount : <b>'.$sym.' '.$findPlan[0]['plan_amount'].'</b></p>';
                                $outputStr .= '<p> Commission Admin will get : <b>'.$sym.' '.$findPlan[0]['plan_amount'].'</b></p>';
                            }

                            if( $transactionDetails[0]['payment_mode'] == 'banktransfer' ) {
                                $outputStr .= '<p> User Note : <b>'.$transactionDetails[0]['payment_note'].'</b></p>';
                                if( $transactionDetails[0]['payment_status'] == 'no' ) {
                                    $outputStr .= '<p> <a class="btn theme_btn" href="'.base_url().'backend/approve_transaction/'.$transactionDetails[0]['payment_id'].'" > Approve </a></p>';
                                }
                            }
                            $outputStr .= '<hr />';
                        }

                        if(!empty($findProduct)) {
                            $outputStr .= '<p> Product Name : <b>'.$findProduct[0]['prod_name'].'</b></p>';
                            $outputStr .= '<p> Product Amount : <b>'.$sym.' '.$findProduct[0]['prod_price'].'</b></p>';
							 if( isset($adminCommArr[$pId]) ) {
							    $outputStr .= '<p> Commission Admin will get : <b>'.$sym.' '.$adminCommArr[$pId].'</b></p>';
							 }
							 if( isset($venCommArr[$pId]) ) {
							    $outputStr .= '<p> Commission Vendor will get : <b>'.$sym.' '.$venCommArr[$pId].'</b></p>';
							 }

                            if( $transactionDetails[0]['payment_mode'] == 'banktransfer' ) {
                                $outputStr .= '<p> User Note : <b>'.$transactionDetails[0]['payment_note'].'</b></p>';
                                if( $transactionDetails[0]['payment_status'] == 'no' ) {
                                    $outputStr .= '<p> <a class="btn theme_btn" href="'.base_url().'backend/approve_transaction/'.$transactionDetails[0]['payment_id'].'" > Approve </a></p>';
                                }
                            }
                            $outputStr .= '<hr />';
                        }
                    }
                }
                echo $outputStr;
            }
        }
        else {
            echo '<p>Data can not be fetched.</p>';
        }
        die();
    }

    function approve_transaction($paymentid) {
        $checkPaymentDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_id'=>$paymentid));

        if( !empty($checkPaymentDetails) ) {
        if( $checkPaymentDetails[0]['payment_status'] == 'no' ) {
            $payment_uniqid = $checkPaymentDetails[0]['payment_uniqid'];
            $custom = trim($checkPaymentDetails[0]['payment_pid']);
            $customArr = explode(',',$custom);
            $emTransId = $checkPaymentDetails[0]['payment_id'];
            $vendor_commission = $admin_commission = '';
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

            $vendor_commission = rtrim( trim($vendor_commission) ,',');
            $admin_commission = rtrim( trim($admin_commission) ,',');
            $this->DatabaseModel->access_database('ts_paymentdetails','update',array('payment_status'=>'yes' ,'payment_admin_commission'=> $admin_commission ,'payment_vendor_commission'=> $vendor_commission ),array('payment_uniqid'=>$payment_uniqid));

            $this->ts_functions->sendtransactionemails($emTransId);
        }
        }
        redirect(base_url().'backend/transaction_history');
    }

	/************ Transaction History ENDS *******************/

	/************ Statements STARTS *******************/
	function statements(){
        $data['transactionDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , array('payment_status'=>'yes','payment_type'=>'products'));

        $data['basepath'] = base_url();
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/transaction_statements',$data);
        $this->load->view('backend/include/footer',$data);
	}
    /************ Statements ENDS *******************/

	/**************** Theme Section STARTS **********************/

	function tp_themes($themeid='') {
	    if($themeid != '') {
	        $checkTheme = $this->DatabaseModel->access_database('ts_themes','select','',array('theme_id'=>$themeid));
	        if(!empty($checkTheme)) {
	            $allThemes = $this->DatabaseModel->access_database('ts_themes','select','','');

	            foreach($allThemes as $soloTheme) {
	                $this->DatabaseModel->access_database('ts_themes','update',array('theme_status'=>0),array('theme_id'=>$soloTheme['theme_id']));
	            }
	            $this->DatabaseModel->access_database('ts_themes','update',array('theme_status'=>1),array('theme_id'=>$themeid));
	        }
	    }
	    $data['basepath'] = base_url();
	    $data['themeList'] = $this->DatabaseModel->access_database('ts_themes','select','','');
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/tp_themes',$data);
        $this->load->view('backend/include/footer',$data);
	}

	/**************** Theme Section ENDS **********************/

	/***************** Vendor Management STARTS ***************/
	function vendor_management(){
	    if(isset($_POST['vendor_tnctext'])) {
	        $this->ts_functions->updatesettings('vendor_tnctext',$_POST['vendor_tnctext']);
	        $chk = isset($_POST['vendor_tncstatus']) ? '1' : '0' ;
	        $this->ts_functions->updatesettings('vendor_tncstatus',$chk);
	        $_SESSION['ts_success'] = "Vendor's Terms &amp; Conditions updated.";
	    }
        $data['basepath'] = base_url();
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/vendor_management',$data);
        $this->load->view('backend/include/footer',$data);
	}

	function vendor_list(){
	    if($this->ts_functions->getsettings('marketplace','typevendor') != 'multi') {
	        redirect(base_url().'backend');
	    }
        $data['basepath'] = base_url();
        $data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel'=>3));
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/vendor_list',$data);
        $this->load->view('backend/include/footer',$data);
	}
	/***************** Vendor Management ENDS ***************/

	/************* Single Vendor details STARTS ********************/
	public function single_vendor($uid=''){
		$data['basepath'] = base_url();
		$data['userdetails'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_accesslevel'=>3,'user_id'=>$uid));
		$freeProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_free'=>1,'prod_status'=>1));

		$join_array = array('ts_products','ts_products.prod_id = ts_purchaserecord.purrec_prodid');
		$purchasedDetails = $this->DatabaseModel->access_database('ts_purchaserecord','','',array('purrec_uid'=>$uid,'prod_status'=>1),$join_array);

		$data['totalProductDetails'] = array_merge($purchasedDetails,$freeProducts);
		// Uploaded products
        $uploadedProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uid'=>$uid));
        $data['uploadedProducts'] = $uploadedProducts;

        // Transaction Details
        if(!empty($uploadedProducts)) {
            $transactionDetailsArray = array();
            $totalTransactionArray = array();
            foreach($uploadedProducts as $solo_prod) {
                $trDet = $this->DatabaseModel->access_database('ts_paymentdetails','like', '' , array('payment_pid'=>$solo_prod['prod_uniqid']));
                if(!empty($trDet)) {
                    foreach($trDet as $solotrDet) {
                        array_push($transactionDetailsArray,$solotrDet);
                    }
                }

                $trAmnt = $this->DatabaseModel->access_database('ts_paymentdetails','totalvalue', array('payment_amount','totalAmount') , array('payment_status'=>'yes','payment_pid'=>$solo_prod['prod_uniqid']));
                if(!empty($trAmnt)) {
                    array_push($totalTransactionArray,$trAmnt[0]['totalAmount']);
                }
            }
            $data['transactionDetails'] = $transactionDetailsArray;
            $totalAmnt[0] = array('totalAmount'=>array_sum($totalTransactionArray));
            $data['totalTransaction'] = $totalAmnt;
        }
        else {
            $data['transactionDetails'] = array();
            $data['totalTransaction'] = 0;
        }

        // Withdrawal

        $data_array = array(
            'venwith_uid'   =>  $uid,
            'venwith_type'  =>  'paypal_email'
        );
        $data['withdrawalDetails_paypal'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);

        $data_array = array(
            'venwith_uid'   =>  $uid,
            'venwith_type'  =>  'banktransfer_details'
        );
        $data['withdrawalDetails_bnkdetails'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);
        
        $data_array = array(
            'venwith_uid'   =>  $uid,
            'venwith_type'  =>  'bitcoin_details'
        );
        $data['withdrawalDetails_bitcoin'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);
        
        
        $data['withdrawalDetails_payed'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','totalvalue', array('venwith_text','totalPayedAmount') , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

        $data['payment_history_details'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select', '' , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/single_vendor',$data);
		$this->load->view('backend/include/footer',$data);
	}

    function updateWithdrawal(){
        if(isset($_POST['sendnotification'])) {
            $this->DatabaseModel->access_database('ts_vendorwithdrawal','insert', array('venwith_uid'=>$_POST['vendorId'],'venwith_type'=>'payed_amount','venwith_text'=>$_POST['amounttobepaid'],'venwith_notes'=>$_POST['paymentnote'],'venwith_date'=>date('Y-m-d H:i:s')) , '' );

            if( $_POST['sendnotification'] == '1' )
            {
                /**** Send Notification Email ******/

                $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                <html xmlns='http://www.w3.org/1999/xhtml'>
                <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <title>".$this->ts_functions->getsettings('sitetitle','text')."</title>
                </head><body>";
                if( $this->ts_functions->getsettings('email','logoshow') == '1' ) {
                    $body = "<img src='".$this->ts_functions->getsettings('logo','url')."' alt='".$this->ts_functions->getsettings('sitetitle','text')."'  title='".$this->ts_functions->getsettings('sitetitle','text')."'/>";
                }
                else {
                    $body = '';
                }

                $userDetails = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$_POST['vendorId']));

                $to = $userDetails[0]['user_email'];
                $bodyUser = $body;
                $bodyUser .="<p>Hi ".$userDetails[0]['user_uname'].",</p> <p> Admin has transferred the amount. Here are the details : </p> <br/> <p> Amount : ".$this->ts_functions->getsettings('portal','curreny')." ".$_POST['amounttobepaid']."</p>  <p> Note : ".$_POST['paymentnote']."</p> <br/><p> You can even get these details in your VendorBoard, withdrawal section also.</p> <p>Thanks, <br/> ".$this->ts_functions->getsettings('sitename','text')." Team</p>";

                $from = $this->ts_functions->getsettings('email','fromname');
                $from_add = $this->ts_functions->getsettings('email','fromemail');

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
                'Reply-To: '.$from_add . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                $subject = 'Details of withdrawal';

                mail($to,$subject,$bodyhead.$bodyUser.'</body></html>',$headers, '-f'.$from_add);
                /**** Send Notification Email ******/
            }
            echo 1;
        }
        else {
            echo '0';
        }
    }
    /************* Single Vendor details ENDS ********************/

    /************* Header Views STARTS ********************/

    function tp_headers($head_id='') {
        $headers = $this->ts_functions->getsettings('headers','all');
        $headerArr = explode(',',$headers);

	    if($head_id != '') {
	        if(in_array($head_id,$headerArr)) {
	            $this->ts_functions->updatesettings('headers_active',$head_id);
	            redirect(base_url().'backend/tp_headers');
	        }
	    }
	    $data['basepath'] = base_url();
	    $data['headerArr'] = $headerArr;
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/tp_headers',$data);
        $this->load->view('backend/include/footer',$data);
	}
    /************* Header Views ENDS ********************/

	/************* Social Login STARTS **********************/
	
	function social_login(){
		$data['basepath'] = base_url();
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/social_login',$data);
        $this->load->view('backend/include/footer',$data);
	}
	
	/************* Social Login ENDS **********************/
	
	
	/************* Discount Coupons STARTS **********************/
	
	function discount_coupon($coupon_id=''){
		if( isset($_POST['coup_duration']) ) {
			$data_arr = array();
			foreach($_POST as $k=>$v) {
				$data_arr[ $k ] = $v;
			}
			if( $_POST['coup_id'] == '0' ) {
				$this->DatabaseModel->access_database('ts_coupons','insert', $data_arr , '');
				echo '1';
			}
			else {
				$this->DatabaseModel->access_database('ts_coupons','update', $data_arr , array( 'coup_id' => $_POST['coup_id'] ) );
				echo '2';
			}
			
			die();
		}
		
		if( $coupon_id != '' ) {
			$d = $this->DatabaseModel->access_database('ts_coupons','select', '' , array( 'coup_id' => $coupon_id ) );
			if( empty($d) ) { redirect(	base_url().'backend/discount_coupon' ); }
			$data['singleCoupons'] = $d;
		}
		$data['basepath'] = base_url();
		$data['discount_page'] = 1;
		$data['allCoupons'] = $this->DatabaseModel->access_database('ts_coupons','select', '' , '' );	
        $this->load->view('backend/include/header',$data);
        $this->load->view('backend/discount_coupon',$data);
        $this->load->view('backend/include/footer',$data);
	}
	
	/************* Discount Coupons ENDS **********************/
	
	/************* Add New User STARTS **********************/
	
	function addnewuser_backend() {
        if( isset($_POST['u_email']) ) {
        	
			if(isset($_POST['u_email'])) {
				$email = $_POST['u_email'];
				$un = $_POST['u_uname'];
				$pwd = $_POST['u_pwd'];

				if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pwd) > 7 && preg_match("/^[a-zA-Z0-9\d]+$/",$un) ) {
					$checkUsername = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$_POST['u_uname']));

					if(empty($checkUsername)) {
						$checkEmail = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$_POST['u_email']));

						if(empty($checkEmail)) {

							$data_arr	= array('user_uname'=>$_POST['u_uname'],'user_email'=>$_POST['u_email'],'user_pwd'=>md5($_POST['u_pwd']),'user_accesslevel'=>$_POST['u_accesslevel'],'user_status'=>1);
							
							$uid = $this->DatabaseModel->access_database('ts_user','insert',$data_arr,'');

							/* Subscribe to list */
							$s = $this->ts_functions->subscribeemails( $_POST['u_email'] , 'registeredemails');
							/* Subscribe to list */

							if( $_POST['sendemail'] == '1' ) {
								echo $this->ts_functions->sendnotificationemails('addnewuseremail', $_POST['u_email'], 'New Account Created' , $_POST['u_uname'] , array($_POST['u_pwd'],base_url()) );
							}
							else {
								echo '7#register';
							}
							// Register success

						}
						else {
							echo '7#exists';
							// Email exists
						}
					}
					else {
						echo '6#exists';
						// Username exists
					}
				}
				else {
					echo '404#js_mistake';
					// Server Error exists
				}
			}
			else {
				echo '0#error';
				// Login credentials don't match
			}
		
        
        }
        else {
            echo '404#error';
            // False access
        }
			die();
	}
	
	/************* Add New User ENDS **********************/
	
	
	/******************** Delete Language STARTS ********************/

	function delete_selected_language($langname=''){
		if( $langname != '' ) {
			$existingLang = $this->ts_functions->getsettings('languageoption','text');;
			$lan_arr = explode(',',$existingLang);
			$current_lan = $this->ts_functions->getsettings('weblanguage','text');
			
			$lan_str = '';
			$f_lan = '';
			for($i=0;$i<count($lan_arr);$i++) {
				if( $lan_arr[$i] != $langname ) {
					$lan_str .= $lan_arr[$i].',';
					$f_lan = $lan_arr[$i];
				}
			}
			if( $current_lan == $langname ) {				$this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$f_lan),array('key_text'=>'weblanguage_text'));
			}
			
			$lan_str = rtrim($lan_str,',');
			$this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$lan_str),array('key_text'=>'languageoption_text'));

			$this->load->dbforge();
			$k = 'language_'.$langname;
			$this->dbforge->drop_column('ts_language', $k);
			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	/******************** Delete Language ENDS ********************/
	
}
?>
