<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ts_functions {

    public function __construct()
	{
        $this->CI = get_instance();
	}

    /****
        getsettings : Function responsible to fetch the basic settings of the application,
        First Param : Pagename eg., login, register...
        Second Param : Type eg., title , metatags...
    ****/

    public function getsettings($pagename='',$type='')
    {
        $whrParam = $pagename.'_'.$type;
        $whrArray = array('key_text'=>$whrParam);
        $resArray = $this->CI->DatabaseModel->access_database('ts_settings','select','',$whrArray);

        return (!empty($resArray) ? $resArray[0]['value_text'] : 'NF' );
    }


    /****
        updatesettings : Function responsible to update the settings of the application,
        First Param : key ...
        Second Param : value ...
    ****/

    public function updatesettings($key='',$value='')
    {
        $whrArray = array('key_text'=>$key);
        $updateArray = array('value_text'=>$value);

        $this->CI->DatabaseModel->access_database('ts_settings','update', $updateArray , $whrArray);
    }


    /****
        getlanguage : Function responsible to fetch the language depending on either key or type,
        First Param : key
        Second Param : type
    ****/

    public function getlanguage($key='',$type='',$return='')
    {
        if( $key == 'all' ) {
            $whrArray = array('language_type'=>$type);
        }
        else {
            $whrArray = array('language_key'=>$key,'language_type'=>$type);
        }

        $resArray = $this->CI->DatabaseModel->access_database('ts_language','select','',$whrArray);

        if( $return == 'solo' ) {
            $resArr = $this->CI->DatabaseModel->access_database('ts_settings','select','',array('key_text'=>'weblanguage_text'));
            $selectedLanguage =  $resArr[0]['value_text'];
            if( isset($_COOKIE['language']) ) {
            	$k = 'language_'.$_COOKIE['language'] ;
            }
            else {
            	$k = 'language_'.$selectedLanguage ;
            }
            
            return (!empty($resArray) ? $resArray[0][$k] : 'NF' );
        }
        else {
            return (!empty($resArray) ? $resArray : 'NF' );
        }
    }


    /****
        getlanguage : Function responsible to get a product download count,
        First Param : column name
        Second Param : where array or value
        Third Param : type of search
    ****/

     public function getProductPurchaseDetail($colname='',$whrValue='',$type=''){
        if($colname != ''){
            if($type == 'proddownload'){
                $this->CI->db->select('SUM('.$colname.') AS prodcnt');
                $this->CI->db->from('ts_purchaserecord');
                $this->CI->db->where($whrValue);
                $rs=$this->CI->db->get();
                $res = $rs->result_array();
                return (($res[0]['prodcnt']!='') ? $res[0]['prodcnt'] : '0') ;
			}
			else if($type == 'prodpurchase'){
                $res = $this->CI->DatabaseModel->access_database('ts_purchaserecord','select','',$whrValue);
                return (!empty($res) ? count($res) : '0') ;
			}
        }
        else {
            return '0';
        }
        die();
	}



    /****
        getlanguage : Function to get product url name,
        First Param : product db id
    ****/

     public function getProductName($id=''){
        if($id != ''){
            $res = $this->CI->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$id));
            if(!empty($res)) {
                $prodd = $res[0]['prod_urlname'] != '' ? $res[0]['prod_urlname'] : $res[0]['prod_name'] ;
                $p = strtolower($prodd);
                $p = str_replace(' ','-',$p);
                $p = preg_replace('!-+!', '-', $p);
                return $p.'/';
            }
            else {
                return '/';
            }
        }
        else {
            return '/';
        }
        die();
	}

	/****
        getlanguage : Function to get vendor name,
        First Param : user db id
    ****/
	public function getVendorName($uid=''){
        if($uid != ''){
            $userDetail = $this->CI->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
            if(!empty($userDetail)) {
                $uname = $userDetail[0]['user_uname'];
                $p = strtolower($uname);
                return $p;
            }
            else {
                return '0';
            }
        }
        else {
            return '0';
        }
        die();
	}


    /****
        getlanguage : Function to get send notifications email
        First Param : product db id
    ****/

     public function sendnotificationemails($type,$to,$subject,$username,$linkhref){

        $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>".$this->getsettings('sitetitle','text')."</title>
        </head><body>";
        if( $this->getsettings('email','logoshow') == '1' ) {
            $body = "<img src='".$this->getsettings('logo','url')."' alt='".$this->getsettings('sitetitle','text')."'  title='".$this->getsettings('sitetitle','text')."'/>";
        }
        else {
            $body = '';
        }

		$emContent = $this->getsettings($type,'text');
		
		if( is_array($linkhref) ) {
			$emContent = str_replace("[password]",$linkhref[0],$emContent);
			$emContent = str_replace("[website_link]",$linkhref[1],$emContent);
		}
		else {
			$link = "<a href='".$linkhref."'>".$this->getsettings($type,'linktext')."</a>";
			$emContent = str_replace("[linktext]",$link,$emContent);
		}
        
        
        $emContent = str_replace("[username]",$username,$emContent);
        $emContent = str_replace("[break]","<br/>",$emContent);

        $body .="<p>".$emContent."</p>";

        $from = $this->getsettings('email','fromname');
        $from_add = $this->getsettings('email','fromemail');
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
        'Reply-To: '.$from_add . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to,$subject,$bodyhead.$body.'</body></html>',$headers, '-f'.$from_add);

        if( $type == 'forgotpwdemail' ) {
            return '7#email';
        }
        else {
            return '7#register';
        }

        die();
	}


    /****
        getlanguage : Function to subscribe email,
        First Param : Email
        Second Param : Type of source
    ****/

     public function subscribeemails($email='',$type=''){
        if($email != ''){
            $newsletter_subs = $this->getsettings('newsletter','subs');
            $registeredemails_subs = $this->getsettings('registeredemails','subs');
            $contactemails_subs = $this->getsettings('contactemails','subs');

            if($type == 'newsletter' && $newsletter_subs == '1') {
                 return $this->sendDataToEmailList($email,$type);
            }
            if($type == 'registeredemails' && $registeredemails_subs == '1') {
                return $this->sendDataToEmailList($email,$type);
            }
            if($type == 'contactemails' && $contactemails_subs == '1') {
                return $this->sendDataToEmailList($email,$type);
            }
            return '7';
        }
        else {
            return '0';
        }
        die();
	}

	private function sendDataToEmailList($email='',$type='') {
	    if($email == '' || $type == '') {
	        return '0';
	    }
	    else {
	        $join_array = array('ts_emailproviders','ts_emailproviders.ep_id = ts_eplist.eplist_parentid');
	        $elistRes = $this->CI->DatabaseModel->access_database('ts_eplist','','',array('eplist_use'=>'1'),$join_array);
	        $path=dirname(__FILE__);
            $abs_path=explode('/application/',$path);
            $pathToEmailLibraries = $abs_path[0].'/application/controllers/';

	        if(!empty($elistRes)) {
                foreach($elistRes as $solo_elist) {

                    $listID = $solo_elist['eplist_uniqid'];
                    $listDBid = $solo_elist['eplist_id'];
                    $em_credentials = json_decode($solo_elist['ep_credentials']);

                    if( $solo_elist['ep_name'] == 'Mailchimp' ) {

                        require_once $pathToEmailLibraries.'emailIntegration_resources/Mailchimp/MCAPI.class.php';

                        $api = new MCAPI($em_credentials->Mailchimp_apikey);

                        $args = '';

                        if(!empty($listID)){
                            $api->listSubscribe($listID, $email, $args );
                        }

                        if ($api->errorCode == '')
                        {
                            $insertArr = array(
                                'e_date'    =>  date('Y-m-d'),
                                'e_email'   =>  $email,
                                'e_list'   =>  $listDBid,
                                'e_type'   =>  $type
                            );
                            $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');
                        }

                    } // Mailchimp Ends
                    elseif( $solo_elist['ep_name'] == 'GetResponse' ) {
                        require_once $pathToEmailLibraries.'emailIntegration_resources/GetResponse/jsonRPCClient.php';

                        $api = new jsonRPCClient('http://api2.getresponse.com');
                        try
                        {
                            $args = array(
                                'campaign' => $listID,
                                'email' => $email,
                                'cycle_day'=>0,
                            );

                            $api->add_contact($em_credentials->GetResponse_apikey, $args);

                            $insertArr = array(
                                'e_date'    =>  date('Y-m-d'),
                                'e_email'   =>  $email,
                                'e_list'   =>  $listDBid,
                                'e_type'   =>  $type
                            );
                        $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');

                        }
                        catch (Exception $e)
                        { }
                    } // GetResponse Ends
                    elseif( $solo_elist['ep_name'] == 'Aweber' ) {
                        require_once $pathToEmailLibraries.'emailIntegration_resources/Aweber/aweber_api.php';

                        try
                        {

                           $arp_setting['aw_lists']=$listID;

                            $aweber = new AWeberAPI($em_credentials->Aweber_consumer_key, $em_credentials->Aweber_consumer_secret);

                            $account = $aweber->getAccount($em_credentials->Aweber_access_key, $em_credentials->Aweber_access_secret);

                            $aweber_list = $arp_setting['aw_lists'];
                            $list = $account->loadFromUrl('/accounts/' . $account->id . '/lists/' . $aweber_list);

                            $subscriber = array(
                                'email' => $email,
                                'ip' => $_SERVER['REMOTE_ADDR']
                            );

                            $list->subscribers->create($subscriber);

                            $insertArr = array(
                                'e_date'    =>  date('Y-m-d'),
                                'e_email'   =>  $email,
                                'e_list'   =>  $listDBid,
                                'e_type'   =>  $type
                            );
                            $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');

                        }
                        catch (AWeberException $e)
                        { }

                    } // Aweber Ends
                    elseif( $solo_elist['ep_name'] == 'ConstantContact' ) {

                        require_once $pathToEmailLibraries.'emailIntegration_resources/ConstantContact/class.cc.php';
                        $cc = new cc($em_credentials->ConstantContact_uname, $em_credentials->ConstantContact_pwd);


                        $email = $email;

                        $contact_list =$listID;
                        $extra_fields = array(
                        );

                        $contact = $cc->query_contacts($email);
                        if (!$contact)
                        {
                            $new_id = $cc->create_contact($email, $contact_list, $extra_fields);
                            if ($new_id)
                            {

                                $insertArr = array(
                                    'e_date'    =>  date('Y-m-d'),
                                    'e_email'   =>  $email,
                                    'e_list'   =>  $listDBid,
                                    'e_type'   =>  $type
                                );
                                $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');

                            }
                        }
                    } // ConstantContact
                    elseif( $solo_elist['ep_name'] == 'Sendinblue' ) {
                        require_once $pathToEmailLibraries.'emailIntegration_resources/Sendinblue/Mailin.php';
                        $apikey = $em_credentials->Sendinblue_apikey;

                        $email = $email;

                        try
                        {
                            $mailin = new Mailin('https://api.sendinblue.com/v2.0',$apikey);

                            try {

                                $data = array( "email" => $email,
                                    "attributes" => array("NAME"=>'', "SURNAME"=>''),
                                    "listid" => array($listID)
                                );

                                $res = $mailin->create_update_user($data);
                                $insertArr = array(
                                    'e_date'    =>  date('Y-m-d'),
                                    'e_email'   =>  $email,
                                    'e_list'   =>  $listDBid,
                                    'e_type'   =>  $type
                                );
                                $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');

                            } catch(Emma_Invalid_Response_Exception $e) {
                                echo 0;
                            }

                        } catch (Exception $e){
                            echo 0;
                        }
                    } // Sendinblue
                    elseif( $solo_elist['ep_name'] == 'Freshmail' ) {
                        define ( 'FM_API_KEY', $em_credentials->Freshmail_apikey );
                        define ( 'FM_API_SECRET', $em_credentials->Freshmail_apisecret );

                        require_once $pathToEmailLibraries.'emailIntegration_resources/Freshmail/class.rest.php';

                        $rest = new FmRestAPI();
                        $rest->setApiKey( FM_API_KEY );
                        $rest->setApiSecret( FM_API_SECRET );

                        $email = $email;

                        try {
                            $data = array(
                                'email' =>  $email,
                                'list'  =>  $listID
                            );
                            $rest->doRequest('subscriber/add',$data);

                            $insertArr = array(
                                'e_date'    =>  date('Y-m-d'),
                                'e_email'   =>  $email,
                                'e_list'   =>  $listDBid,
                                'e_type'   =>  $type
                            );
                            $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');

                        }  catch (Exception $e) {
                            echo '404';
                        }
                    } // Freshmail
                    elseif( $solo_elist['ep_name'] == 'ActiveCampaign' ) {
						
						$url =  $em_credentials->ActiveCampaign_apiurl;
						$apikey =  $em_credentials->ActiveCampaign_apikey;

						$params = array(
							'api_key'      => $apikey,
							'api_action'   => 'contact_add',
							'api_output'   => 'json'
						);

						$post = array(
							'email'                    => $email,
							'first_name'               => '',
							'tags'                     => 'api',
							'p[1]'                   => $listID,
							'status[1]'              => 1,
							'instantresponders[123]' => 1
						);

						$query = "";
						foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
						$query = rtrim($query, '& ');

						$data = "";
						foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
						$data = rtrim($data, '& ');

						$url = rtrim($url, '/ ');

						$api = $url . '/admin/api.php?' . $query;

						$request = curl_init($api);
						curl_setopt($request, CURLOPT_HEADER, 0);
						curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($request, CURLOPT_POSTFIELDS, $data);
						curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
						$response = (string)curl_exec($request);
						curl_close($request);

						if ( $response ) {
							$result = json_decode($response);
							if( $result->result_code != 0) {
								$insertArr = array(
									'e_date'    =>  date('Y-m-d'),
									'e_email'   =>  $email,
									'e_list'   =>  $listDBid,
									'e_type'   =>  $type
								);
								$this->CI->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');
							}
						}

					} // ActiveCampaign

                }
	        }
	        else {
	            $dataArr = array(
	                'e_email'   =>  $email,
	                'e_type'    =>  $type,
	                'e_date'    =>  date('Y-m-d')
	            );
	            $this->CI->DatabaseModel->access_database('ts_emaillist','insert',$dataArr,'');
	            return '1';
	        }
	    }
	}

    /****
        getlanguage : Function toGet Availablity of Product for User requesting Download,
        First Param : Product Unique Id
        Second Param : User Id
    ****/


	public function checkproductavailablility($prodUniqid='',$uid='') {
	    if( $prodUniqid != '' && $uid != '' ) {
	        /**** Download check *****/

	        $prodDetails = $this->CI->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodUniqid));

	        $userDetail = $this->CI->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));

            if(!empty($prodDetails)) {

                $donwload_insert_array = array(
                    'download_uid'  =>  $uid,
                    'download_planid'   =>  $userDetail[0]['user_plans']
                );
                $downCheck = $this->CI->DatabaseModel->access_database('ts_downloadtbl','select','',$donwload_insert_array);

                if( !empty($downCheck) ) {
                    $donwload_insert_array = array(
                        'download_uid'  =>  $uid,
                        'download_planid'   =>  $userDetail[0]['user_plans'],
                        'download_pid'  =>  $prodDetails[0]['prod_id']
                    );
                    $userPreviousDownload = $this->CI->DatabaseModel->access_database('ts_downloadtbl','select','',$donwload_insert_array);

                    if( empty($userPreviousDownload) ) {
                        if( $prodDetails[0]['prod_free'] == '0') {
                        $userPlan = $userDetail[0]['user_plans'];
                        $pos = strpos($prodDetails[0]['prod_plan'] , $userPlan);

                        if( $pos === false ){
                            return '0';
                        }
                        $planDetails = $this->CI->DatabaseModel->access_database('ts_plans','select','',array('plan_product'=>$userPlan));

                        if( strtolower(trim($planDetails[0]['plan_product'])) != 'all' ) {
                            if( $planDetails[0]['plan_product'] <= count($downCheck) ) {
                                return '2'; // Upgrade plan message
                            }
                        }
                    }
                     // Save download record
                     $this->CI->DatabaseModel->access_database('ts_downloadtbl','insert',$donwload_insert_array,'');
                    }
                }

                // Check whether this product comes in current Plan
                $userPlan = $userDetail[0]['user_plans'];
                if( $prodDetails[0]['prod_free'] == '1') {
                    return '1'; // Get download FREE Product
                }
                else if( strpos($prodDetails[0]['prod_plan'].',',$userPlan.',') !== FALSE ) {
                    return '1'; // Get download
                }
                else {
                    // PRODUCT PURCHASE SINGLE COST

                    $prod_purchase = array(
                        'purrec_prodid' =>  $prodDetails[0]['prod_id'],
                        'purrec_uid' =>  $uid
                    );
                    $purchaseCheck = $this->CI->DatabaseModel->access_database('ts_purchaserecord','select','',$prod_purchase);

                    if( !empty($purchaseCheck) ) {
                        return '1'; // Get download
                    }
                    else {
                        return '2'; // Upgrade plan message
                    }
                }
            }
            else {
                return '0';
            }

            /**** Download check *****/
	    }
	    else {
	        return '0'; // to homepage
	    }
	}


    /****
        getlanguage : Function to store the Analytics Data of Product,
        First Param : Product Unique Id
        Second Param : Page type
    ****/


    public function product_analytics($uniqid='',$pagetype='') {
	    if( $pagetype != '' && $uniqid != '' ) {

	        $userIp = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $os_array       = array('/windows phone 8/i'    =>  'Mobile',
                                        '/windows phone os 7/i' =>  'Mobile',
                                        '/windows nt 6.3/i'     =>  'Desktop',
                                        '/windows nt 6.2/i'     =>  'Desktop',
                                        '/windows nt 6.1/i'     =>  'Desktop',
                                        '/windows nt 6.0/i'     =>  'Desktop',
                                        '/windows nt 5.2/i'     =>  'Desktop',
                                        '/windows nt 5.1/i'     =>  'Desktop',
                                        '/windows xp/i'         =>  'Desktop',
                                        '/windows nt 5.0/i'     =>  'Desktop',
                                        '/windows me/i'         =>  'Desktop',
                                        '/win98/i'              =>  'Desktop',
                                        '/win95/i'              =>  'Desktop',
                                        '/win16/i'              =>  'Desktop',
                                        '/macintosh|mac os x/i' =>  'Desktop',
                                        '/mac_powerpc/i'        =>  'Desktop',
                                        '/linux/i'              =>  'Desktop',
                                        '/ubuntu/i'             =>  'Desktop',
                                        '/iphone/i'             =>  'Mobile',
                                        '/ipod/i'               =>  'Tablet',
                                        '/ipad/i'               =>  'Tablet',
                                        '/android/i'            =>  'Mobile',
                                        '/blackberry/i'         =>  'Mobile',
                                        '/webos/i'              =>  'Mobile');

                $found = false;
                $device = 'Desktop';
                foreach ($os_array as $regex => $value)
                {
                    if($found)
                     break;
                    else if (preg_match($regex, $user_agent))
                    {
                        $device    =   $value;
                    }
                }

            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
                 $browser = 'Internet explorer';
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
                 $browser = 'Internet explorer';
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
                 $browser = 'Mozilla Firefox';
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
                 $browser = 'Google Chrome';
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
                 $browser = "Opera Mini";
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
                 $browser = "Opera";
            elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
                 $browser = "Safari";
            else
                 $browser = 'Others';


            $dataArr = array(
	                'prod_analysis_prodid'   =>  $uniqid,
	                'prod_analysis_date'    =>  date('Y-m-d'),
	                'prod_analysis_browser'    =>  $browser,
	                'prod_analysis_device'    =>  $device,
	                'prod_analysis_ipaddr'    =>  $userIp,
	                'prod_analysis_pagetype'    =>  $pagetype
	            );
	        $anaDetails = $this->CI->DatabaseModel->access_database('ts_product_analysis','select','',$dataArr);
	        if( !empty($anaDetails) ) {
	            $currentCount = $anaDetails[0]['prod_analysis_views'];
	            $currentRowId = $anaDetails[0]['prod_analysis_id'];
	        }
	        else {
                $currentRowId = $this->CI->DatabaseModel->access_database('ts_product_analysis','insert',$dataArr,'');
                $currentCount = 0;
	        }
	        $newCount = $currentCount + 1;
	        $dataArr['prod_analysis_views'] = $newCount;
	        $this->CI->DatabaseModel->access_database('ts_product_analysis','update',$dataArr,array('prod_analysis_id'=>$currentRowId));
	        return $newCount;
	    }
	    else {
	        return 'ZERO'; // to homepage
	    }
	}



    /****
        getlanguage : Function to GET the Analytics Data of Product,
        First Param : Product Unique Id
        Second Param : Column type
    ****/


    public function get_product_analytics($uniqid='',$col='') {
	    if( $col != '' && $uniqid != '' ) {

            $dataArr = array(
	                'prod_analysis_prodid'   =>  $uniqid,
	                'prod_analysis_date'    =>  date('Y-m-d'),
	                'prod_analysis_browser'    =>  $browser,
	                'prod_analysis_device'    =>  $device,
	                'prod_analysis_ipaddr'    =>  $userIp,
	                'prod_analysis_pagetype'    =>  $pagetype
	            );
	        $anaDetails = $this->CI->DatabaseModel->access_database('ts_product_analysis','select','',$dataArr);
	        if( !empty($anaDetails) ) {
	            $currentCount = $anaDetails[0]['prod_analysis_views'];
	            $currentRowId = $anaDetails[0]['prod_analysis_id'];
	        }
	        else {
                $currentRowId = $this->CI->DatabaseModel->access_database('ts_product_analysis','insert',$dataArr,'');
                $currentCount = 0;
	        }
	        $newCount = $currentCount + 1;
	        $dataArr['prod_analysis_views'] = $newCount;
	        $this->CI->DatabaseModel->access_database('ts_product_analysis','update',$dataArr,array('prod_analysis_id'=>$currentRowId));
	        return $newCount;
	    }
	    else {
	        return 'ZERO'; // to homepage
	    }
	}


   /****
        getlanguage : Function to GET current Theme Details,
    ****/


    public function current_theme() {
	    $dataArr = array(
                'theme_status'   =>  1
        );
        $themeDetails = $this->CI->DatabaseModel->access_database('ts_themes','select','',$dataArr);
        if( !empty($themeDetails) ) {
            return $themeDetails[0]['theme_name'];
        }
        else {
            return 'default';
        }
	}


     /****
        sendtransactionemails : Function to get send transaction email
        First Param : product db id
    ****/

     public function sendtransactionemails($tranId){

        $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>".$this->getsettings('sitetitle','text')."</title>
        </head><body>";
        if( $this->getsettings('email','logoshow') == '1' ) {
            $body = "<img src='".$this->getsettings('logo','url')."' alt='".$this->getsettings('sitetitle','text')."'  title='".$this->getsettings('sitetitle','text')."'/>";
        }
        else {
            $body = '';
        }
        $transactionDetails = $this->CI->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_id'=>$tranId));

        if( !empty($transactionDetails) ) {

            $userDetails = $this->CI->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$transactionDetails[0]['payment_uid']));

            $custom = trim($transactionDetails[0]['payment_pid']);
            $customArr = explode(',',$custom);

            $prod_name_list = '';
            for($i=0;$i<count($customArr);$i++) {

                $pId = $customArr[$i];
                $findPlan = $this->CI->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$pId,'plan_status'=>1));

                $findProduct = $this->CI->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId,'prod_status'=>1));

                if(!empty($findPlan) || !empty($findProduct)) {
                    if(!empty($findPlan)) {
                        // Update Plan
                        $prod_name_list .= ' '.$findPlan[0]['plan_name'].' ,';
                    }

                    if(!empty($findProduct)) {
                        // Add Products to purchase
                        $prod_name_list .= ' '.$findProduct[0]['prod_name'].' ,';
                    }

                }
            }
            $sym = $this->getsettings('portalcurreny','symbol');
            
            $productStr = '<p> Product Name : '.rtrim($prod_name_list,',').'</p>';
            $productStr .= '<p> Total Cost : '.$sym.' '.$transactionDetails[0]['payment_total'].'</p>';
            if( $transactionDetails[0]['payment_discount'] != '' ) {
            	$productStr .= '<p> Discount Applied : '.$sym.' '.$transactionDetails[0]['payment_discount'].'</p>';
            }
            $productStr .= '<p> Amount Paid : '.$sym.' '.$transactionDetails[0]['payment_amount'].'</p>';

            $to = $userDetails[0]['user_email'];
            $bodyUser = $body;
            $bodyUser .="<p>Hi ".$userDetails[0]['user_uname'].",</p> <p> Congratulations, your purchase is successful. <br/> Below is the product detail : </p> <hr/> ".$productStr."<br/><p> Here is the Purchase Code for this transaction : ".$transactionDetails[0]['payment_uniqid']."</p> <p> You can get your product from the download section.</p> <p>Thanks, <br/> ".$this->getsettings('sitename','text')." Team</p>";

            $bodyAdmin = $body;
            $bodyAdmin .="<p>Hi Admin,</p> <p> User has done a successfull purchase. <br/> User details who has done the transaction <p> Username : ".$userDetails[0]['user_uname']." </p>  <p> User Email : ".$userDetails[0]['user_email']." </p>  <p> Transaction mode : ".$transactionDetails[0]['payment_mode']." </p>  Below is the product detail : </p> <hr/> ".$productStr."<br/><p> Here is the Purchase Code for this transaction : ".$transactionDetails[0]['payment_uniqid']."</p>  <p> You can get the transaction details from Admin dashboard, transaction history section.</p> <p>Thanks, <br/> ".$this->getsettings('sitename','text')." Team</p>";

            $from = $this->getsettings('email','fromname');
            $from_add = $this->getsettings('email','fromemail');
            $admin_add = $this->getsettings('email','contactemail');

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
            'Reply-To: '.$from_add . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            $subject = 'Details of purchase on '.$this->getsettings('sitename','text');

            mail($to,$subject,$bodyhead.$bodyUser.'</body></html>',$headers, '-f'.$from_add);

            mail($admin_add,$subject,$bodyhead.$bodyAdmin.'</body></html>',$headers, '-f'.$from_add);
            return 1;
        }


        die();
	}
	
	
	

    /****
        getlanguage : Function to get send notifications email when Pending prod moves to Active
        First Param : product db id
    ****/

     public function sendnotificationemails_productstatus($prod_id,$status){

        $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>".$this->getsettings('sitetitle','text')."</title>
        </head><body>";
        if( $this->getsettings('email','logoshow') == '1' ) {
            $body = "<img src='".$this->getsettings('logo','url')."' alt='".$this->getsettings('sitetitle','text')."'  title='".$this->getsettings('sitetitle','text')."'/>";
        }
        else {
            $body = '';
        }
        $productDetails = $this->CI->DatabaseModel->access_database('ts_products','','',array('prod_id'=>$prod_id),array('ts_user','ts_user.user_id = ts_products.prod_id'));

        if( !empty($productDetails) ) {
		if($productDetails[0]['user_accesslevel'] != '1' && $productDetails[0]['prod_image'] != '' ) {
			
			if( $status == 'update' ) {	
				
				$productStr = '<p> Product Name : '.$productDetails[0]['prod_name'].'</p> <p> Vendor Name : '.$productDetails[0]['user_uname'].'</p> <p> Vendor Email : '.$productDetails[0]['user_email'].'</p> ';
				
				$to = $this->getsettings('email','contactemail');
				$bodyUser = $body;
				$bodyUser .="<p>Hi Admin,</p> <p> A vendor has updated the product.  <br/> Below is the product related info : </p> <hr/> ".$productStr."<br/><p> You can check the product from manage product section.</p> <p>Thanks, <br/> ".$this->getsettings('sitename','text')." Team</p>";
				$subject = 'Product updated on - '.$this->getsettings('sitename','text');
			}
			else {
				$subject = 'Product status changed on - '.$this->getsettings('sitename','text');
				
				$status_msg = ($status == 1) ? '<p>Product Status : <b style="color:green;">ACTIVE</b></p>' : '<p>Product Status : <b style="color:red;">PENDING</b></p>';
				
				$productStr = '<p> Product Name : '.$productDetails[0]['prod_name'].'</p> '.$status_msg;
				
				$to = $productDetails[0]['user_email'];
				$bodyUser = $body;
				$bodyUser .="<p>Hi ".$productDetails[0]['user_uname'].",</p> <p> Your product status has been changed by Admin <br/> Below is the product detail : </p> <hr/> ".$productStr."<br/><p> You can check the status from manage product section.</p> <p>Thanks, <br/> ".$this->getsettings('sitename','text')." Team</p>";
			}
            $from = $this->getsettings('email','fromname');
            $from_add = $this->getsettings('email','fromemail');

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
            'Reply-To: '.$from_add . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            

            mail($to,$subject,$bodyhead.$bodyUser.'</body></html>',$headers, '-f'.$from_add);
		}
		}
		return 1;
            
        die();
	}
}

/* End of file Ts_functions.php */
?>
