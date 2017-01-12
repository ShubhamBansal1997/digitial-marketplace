<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

	public function __construct()
	{
	
		parent::__construct();
		if( isset($this->session->userdata['ts_uid']) ) {
			if($this->session->userdata['ts_level'] == 1) {
			    redirect(base_url().'backend'); // Admin
			}
			else {
			    redirect(base_url().'dashboard');
			}
		}

		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
        $this->theme = $this->ts_functions->current_theme();
	}

	public function index()
	{
		redirect(base_url().'authenticate/login');
	}

	// Login page
	public function login($key='')
	{
		if( $this->ts_functions->getsettings('loginhome','checkbox') == '0' ) {
			redirect(base_url());
		}
	    if($key != '') {
	        $res = $this->DatabaseModel->access_database('ts_user','select','',array('user_key'=>$key,'user_status'=>2));
	        if( !empty($res) ) {
	            $data['invalidAccess'] = 1;
	            $this->DatabaseModel->access_database('ts_user','update',array('user_status'=>1,'user_key'=>''),array('user_key'=>$key));
	        }
	        else {
	            $data['invalidAccess'] = 0;
	        }
	    }
	    else {
	        $data['invalidAccess'] = 2;
	    }
		$data['basepath'] = base_url();
		$data['name_of_page'] = 'login';

		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/login',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

    // Register page
    public function register()
	{
		if( $this->ts_functions->getsettings('registerhome','checkbox') == '0' ) {
			redirect(base_url());
		}
		
		$data['basepath'] = base_url();
		$data['name_of_page'] = 'register';
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/register',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

	// Registeration section / Login p
	function getuserin_section() {
        if( isset($_POST['users_uname']) ) {
        if( isset($_POST['users_pwd']) ) {

            // Check Login
            $result_uname = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$_POST['users_uname'],'user_pwd'=>md5($_POST['users_pwd'])));

            $result_uemail = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$_POST['users_uname'],'user_pwd'=>md5($_POST['users_pwd'])));

            if (!empty($result_uname) || !empty($result_uemail)) {

                $result = !empty($result_uname) ? $result_uname : $result_uemail ;

                if($result[0]['user_status'] == '2') {
                    echo "2#error"; // InActive
                }
                elseif($result[0]['user_status'] == '3') {
                    echo "3#error"; // Blocked
                }
                else
                {
                    $userPlan = $result[0]['user_plans'];
                    $uid = $result[0]['user_id'];
                    if( $userPlan != '0' ) {
                        $planDetails = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$userPlan));
                        $planDuration = explode(' ',$planDetails[0]['plan_duration']);
                        if( $planDuration[1] == 'Time' ) {
                            $planstatus = 1; // Life time
                        }
                        else {
                            if( $planDuration[1] == 'Days' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
                            }
                            elseif( $planDuration[1] == 'Weeks' ) {
                                $n = $planDuration[0] * 7 ;
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
                            }
                            elseif( $planDuration[1] == 'Months' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
                            }
                            elseif( $planDuration[1] == 'Years' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
                            }
                            $p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_plansdate <'=>$p_date));

                            $planstatus = empty($p) ? '1' : '0' ;
                        }
                    }
                    else {
                        $planstatus = '404';
                    }

                    // Vendor Plans

                    $vendorPlan = $result[0]['user_vplans'];
                    if( $vendorPlan != '0' ) {
                        $planDetails = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$vendorPlan));
                        $planDuration = explode(' ',$planDetails[0]['vplan_duration']);
                        if( $planDuration[1] == 'Time' ) {
                            $planstatus = 1; // Life time
                        }
                        else {
                            if( $planDuration[1] == 'Days' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
                            }
                            elseif( $planDuration[1] == 'Weeks' ) {
                                $n = $planDuration[0] * 7 ;
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
                            }
                            elseif( $planDuration[1] == 'Months' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
                            }
                            elseif( $planDuration[1] == 'Years' ) {
                                $p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
                            }
//echo $p_date;
                            $p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_vplansdate <'=>$p_date));

                            $vplanstatus = empty($p) ? '1' : '0' ;
                        }
                    }
                    else {
                        $vplanstatus = '404';
                    }

                    $user_details	= array(
                        'ts_uid'		=> $uid,
                        'ts_uname'		=> $result[0]['user_uname'],
                        'ts_login'		=> true,
                        'ts_level'		=> $result[0]['user_accesslevel'],
                        'ts_planstatus'		=> $planstatus,
                        'ts_vendorplanstatus'		=> $vplanstatus
                    );

                    $this->session->set_userdata($user_details);

                    if($_POST['rem_me'] == '1'){
                        setcookie("ts_emanu", $_POST['users_uname'] , time()+3600 * 24 * 14,'/');
                        setcookie("ts_dwp", $_POST['users_pwd'] , time()+3600 * 24 * 14,'/');
                    }
                    elseif($_POST['rem_me'] == '0')
                    {
                        setcookie("ts_emanu", $_POST['users_uname'] , time()-3600 * 24 * 365,'/');
                        setcookie("ts_dwp", $_POST['users_pwd'] , time()-3600 * 24 * 365,'/');
                    }

                    echo ( $result[0]['user_accesslevel'] == '1' ) ? '7#adminredirect' : '7#redirect';
                    // Login success
                }
            }
            else {
                if(isset($_POST['users_email'])) {
                    $email = $_POST['users_email'];
                    $un = $_POST['users_uname'];
                    $pwd = $_POST['users_pwd'];

                    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pwd) > 7 && preg_match("/^[a-zA-Z0-9\d]+$/",$un) ) {
                        $checkUsername = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$_POST['users_uname']));

                        if(empty($checkUsername)) {
                            $checkEmail = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$_POST['users_email']));

                            if(empty($checkEmail)) {

                                $key = md5(date('his').$_POST['users_email']);
                                $data_arr	= array('user_uname'=>$_POST['users_uname'],'user_email'=>$_POST['users_email'],'user_pwd'=>md5($_POST['users_pwd']),'user_accesslevel'=>2,'user_status'=>2);
                                $data_arr['user_key'] = $key;

                                $uid = $this->DatabaseModel->access_database('ts_user','insert',$data_arr,'');

                                /* Subscribe to list */
                                $s = $this->ts_functions->subscribeemails( $_POST['users_email'] , 'registeredemails');
                                /* Subscribe to list */

                                echo $this->ts_functions->sendnotificationemails('registrationemail', $_POST['users_email'], 'Verification Link' , $_POST['users_uname'] , base_url().'authenticate/login/'.$key );

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
        }
        else {
            // Forgot Password Section
            $where = "user_email='".$_POST['users_uname']."' OR user_uname='".$_POST['users_uname']."'";
            $result = $this->DatabaseModel->access_database('ts_user','select','',$where);

            if (!empty($result)) {
                if($result[0]['user_status'] == '2') {
                    echo "2#error"; // InActive
                }
                elseif($result[0]['user_status'] == '3') {
                    echo "3#error"; // Blocked
                }
                else
                {
                    $uid = $result[0]['user_id'];
                    $key = md5(date('Ymdhis').$uid);
                    $this->DatabaseModel->access_database('ts_user','update',array('user_key'=>$key),array('user_id'=>$uid));
                    /*

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <help@themeportal.com>' . "\r\n";

                    $msg = '<p>Hi , '.$result[0]['user_uname'].'</p> <p>click on the link below to reset your password <a href="'.base_url().'authenticate/reset_password/'.$key.'">'.base_url().'authenticate/reset_password/'.$key.'</p><br/><br/><p>Thanks, <br/> Team, Themeportal</p>';

                    mail($result[0]['user_email'],'Forgot Password',$msg,$headers);
                    */

                    echo $this->ts_functions->sendnotificationemails('forgotpwdemail', $result[0]['user_email'], 'Forgot Password' , $result[0]['user_uname'] , base_url().'authenticate/reset_password/'.$key );

                    // Forgot email sent
                }
            }
            else {
                echo '5#error';
                // Forgot Email does not match
            }
        }
        }
        else {
            echo '404#error';
            // False access
        }
			die();
	}

	// Forgot Password

	function forgot_password(){
        $data['basepath'] = base_url();
		$data['name_of_page'] = 'forgotpwd';
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/forgot_password',$data);
		$this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	}

	// Reset Password

	function reset_password($key=''){
	    if($key != '') {
	        $res = $this->DatabaseModel->access_database('ts_user','select','',array('user_key'=>$key));
	        $data['invalidAccess'] = (!empty($res)) ? 0 : 1 ;
	        $data['pwdKey'] = $key;
	        $data['basepath'] = base_url();
            $data['name_of_page'] = 'resetpwd';
            $this->load->view('themes/'.$this->theme.'/home/authenticate/common_header',$data);
            $this->load->view('themes/'.$this->theme.'/home/authenticate/reset_password',$data);
            $this->load->view('themes/'.$this->theme.'/home/authenticate/common_footer',$data);
	    }
	    else {
	        redirect(base_url());
	    }
	}

	function update_resetpwdform(){
	    if(isset($_POST['users_pwd'])) {
	        $key = $_POST['key'];
	        $this->DatabaseModel->access_database('ts_user','update',array('user_key'=>'','user_status'=>1,'user_pwd'=>md5($_POST['users_pwd'])),array('user_key'=>$key));
            echo "1#suc";
        }
        else {
            echo "1#error";
        }
	}
	
	/*********************** Social Login STARTS **********************************/
	
	public function facebooklogin(){
	    include_once("fb_login/autoload.php");
	    $app_id = $this->ts_functions->getsettings('facebook','appid');
	    $app_secret = $this->ts_functions->getsettings('facebook','appsecret');
	    
	    $fb = new Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.2',
            'persistent_data_handler'=>'session'
          ]);
        $helper = $fb->getRedirectLoginHelper();
        $encoded_baseurl = urlencode(base_url().'authenticate/fb_data');
       
        $loginUrl = 'https://www.facebook.com/v2.2/dialog/oauth?client_id='.$app_id.'&state='.$app_secret.'&response_type=code&sdk=php-sdk-5.0.0&redirect_uri='.$encoded_baseurl.'&scope=email';
        header('Location: '.$loginUrl);
	}

    public function fb_data(){
        include_once("fb_login/autoload.php");
        $fb = new Facebook\Facebook([
            'app_id' => $this->ts_functions->getsettings('facebook','appid'),
            'app_secret' => $this->ts_functions->getsettings('facebook','appsecret'),
            'default_graph_version' => 'v2.2',
            'persistent_data_handler'=>'session'
          ]);

        $helper = $fb->getRedirectLoginHelper();
         $_SESSION['FBRLH_state']=$_GET['state'];

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        if (! isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
            // access_denied 200
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          exit;
        }
        $oAuth2Client = $fb->getOAuth2Client();

        try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $fb->get('/me?fields=id,first_name,last_name,email,gender,locale,picture', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $user_profile = $response->getGraphUser();
		
		if(!isset($user_profile['email'])) {
			echo '<script type="text/javascript">window.close(); window.opener.location.reload();</script>';
			
		}
        $email = $user_profile['email'];
		$socialId = $user_profile['id'];
        $checkUser = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$email));

        if(empty($checkUser)) {
            
            $user_name = strtolower($user_profile['first_name']);
			$user_name = substr($user_name,0,10);
			
			$insert_array = array(
				'user_uname'   =>  $user_name,
				'user_fname'   =>  $user_profile['first_name'],
				'user_lname'   =>  $user_profile['last_name'],
				'user_email'   =>  $user_profile['email'],
				'user_status'   =>  1,
                'user_accesslevel'   =>  2,
				'user_social'   =>  $user_profile['id']
			);
            $userId = $this->DatabaseModel->access_database('ts_user','insert',$insert_array,'');

            $this->create_session($userId);
        }
        else {
            $this->create_session($checkUser[0]['user_id']);
        }
        echo '<script type="text/javascript">window.close(); window.opener.location.reload();</script>';
    }
	
	/************* Google Login STARTS ****************/
	public function googlelogin(){
        include_once("google_login/autoload.php");
        $client_id = $this->ts_functions->getsettings('google','clientid');
        $client_secret = $this->ts_functions->getsettings('google','clientsecret');
        $redirect_uri = base_url().'authenticate/googlelogin';

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");


        $service = new Google_Service_Oauth2($client);
        if (isset($_GET['code'])) {
          $client->authenticate($_GET['code']);
          $_SESSION['access_token'] = $client->getAccessToken();
        }else {
          $authUrl = $client->createAuthUrl();
          redirect($authUrl);
        }

        /************************************************
          If we have an access token, we can make
          requests, else we generate an authentication URL.
         ************************************************/
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $user = $service->userinfo->get();

            $email = $user['email'];

            $checkUser = $this->DatabaseModel->access_database('ts_user','select','',array('user_email'=>$email));

            if(empty($checkUser)) {
                $user_name = strtolower($user['givenName']);
                $user_name = substr($user_name,0,10);

                $insert_array = array(
                    'user_uname'   =>  $user_name,
                    'user_fname'   =>  $user['givenName'],
                    'user_lname'   =>  $user['familyName'],
                    'user_email'   =>  $user['email'],
                    'user_status'   =>  1,
                    'user_accesslevel'   =>  2,
                    'user_social'   =>  $user['id']
                );
                
                $userId = $this->DatabaseModel->access_database('ts_user','insert',$insert_array,'');
                $this->create_session($userId);
            }
            else {
                $this->create_session($checkUser[0]['user_id']);
                $userId = $checkUser[0]['user_id'];
            }
            echo '<script type="text/javascript">window.close(); window.opener.location.reload();</script>';

        } else {
            $authUrl = $client->createAuthUrl();
            redirect($authUrl);
        }

	}
	/************* Google Login ENDS ****************/
	
	
    /*************** Create Session and Send Email STARTS **********************/

    function create_session($userid) {
    	// To work in all browsers
        $result = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$userid));

        if($result[0]['user_status'] == '3') {
			$this->session->userdata['ts_loginstatus'] = 'Blocked'; // Blocked
		}
		else
		{
			if($result[0]['user_status'] == '2') {
				$this->DatabaseModel->access_database('ts_user','update',array('user_status'=>1),array('user_id'=>$userid));
				$result = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$userid));
			}

			$userPlan = $result[0]['user_plans'];
			$uid = $result[0]['user_id'];
			if( $userPlan != '0' ) {
				$planDetails = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$userPlan));
				$planDuration = explode(' ',$planDetails[0]['plan_duration']);
				if( $planDuration[1] == 'Time' ) {
					$planstatus = 1; // Life time
				}
				else {
					if( $planDuration[1] == 'Days' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
					}
					elseif( $planDuration[1] == 'Weeks' ) {
						$n = $planDuration[0] * 7 ;
						$p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
					}
					elseif( $planDuration[1] == 'Months' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
					}
					elseif( $planDuration[1] == 'Years' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
					}
					$p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_plansdate <'=>$p_date));

					$planstatus = empty($p) ? '1' : '0' ;
				}
			}
			else {
				$planstatus = '404';
			}

			// Vendor Plans

			$vendorPlan = $result[0]['user_vplans'];
			if( $vendorPlan != '0' ) {
				$planDetails = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$vendorPlan));
				$planDuration = explode(' ',$planDetails[0]['vplan_duration']);
				if( $planDuration[1] == 'Time' ) {
					$planstatus = 1; // Life time
				}
				else {
					if( $planDuration[1] == 'Days' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." days"));
					}
					elseif( $planDuration[1] == 'Weeks' ) {
						$n = $planDuration[0] * 7 ;
						$p_date = date('Y-m-d H:i:s',strtotime("-".$n." days"));
					}
					elseif( $planDuration[1] == 'Months' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." month"));
					}
					elseif( $planDuration[1] == 'Years' ) {
						$p_date = date('Y-m-d H:i:s',strtotime("-".$planDuration[0]." year"));
					}
//echo $p_date;
					$p = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_vplansdate <'=>$p_date));

					$vplanstatus = empty($p) ? '1' : '0' ;
				}
			}
			else {
				$vplanstatus = '404';
			}

			$user_details	= array(
				'ts_uid'		=> $uid,
				'ts_uname'		=> $result[0]['user_uname'],
				'ts_login'		=> true,
				'ts_level'		=> $result[0]['user_accesslevel'],
				'ts_planstatus'		=> $planstatus,
				'ts_vendorplanstatus'		=> $vplanstatus
			);

			$this->session->set_userdata($user_details);
			// User will redirect after page reload 
		}
    
    }
    /*************** Create Session and Send Email ENDS **********************/

	
	/*********************** Social Login ENDS **********************************/

}
