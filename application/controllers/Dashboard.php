<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( !isset($this->session->userdata['ts_uid']) ) {
			redirect(base_url());
		}
		if( isset($this->session->userdata['ts_uid']) ) {
    		if($this->session->userdata['ts_level'] == 1) {
			    redirect(base_url().'backend');
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

	public function index(){
	    redirect(base_url().'dashboard/purchased');
	}

/******* Profile page STARTS ***************/
	public function profile(){
	    require('Default_controllers.php');
	    $data['basepath'] = base_url();
        $data['pageHeading'] = $this->ts_functions->getlanguage('profiletext','menus','solo');
        $data['profile_active'] = 'active';
        $uid = $this->session->userdata['ts_uid'];
        $updateArr = array();
	    if(isset($_POST['basic_btn']) || isset($_POST['billing_btn'])) {
	        foreach($_POST as $k=>$v) {
	            if( $k != 'basic_btn' && $k != 'billing_btn' ) {
                    $updateArr['user_'.$k] = $v;
                }
            }
            $data['updatemsg'] = $this->ts_functions->getlanguage('profilesucc','userdashboard','solo');
	    }

	    if(isset($_POST['chngpwd_btn'])) {
	        if($_POST['pwd'] == $_POST['repwd']) {
	            if(strlen($_POST['pwd']) > 7) {
                    $updateArr['user_pwd'] = md5($_POST['repwd']);
                    $data['updatemsg'] = $this->ts_functions->getlanguage('profilepwdsucc','userdashboard','solo');
	            }
	            else {
	                $data['errormsg'] = $this->ts_functions->getlanguage('profilepwderr','userdashboard','solo');
	            }
	        }
	        else {
	            $data['errormsg'] = $this->ts_functions->getlanguage('profilepwdmatcherr','userdashboard','solo');
	        }
	    }

	    if(!empty($updateArr)) {
	        $this->DatabaseModel->access_database('ts_user','update',$updateArr,array('user_id'=>$uid));
	    }

        $data['userDetail'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
        $data['countryDetails'] = $this->DatabaseModel->access_database('ts_country','select','','');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/profile',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
/******* Profile page ENDS ***************/

/******* Add / Renew Subscription STARTS ***************/
	public function subscription(){
	    require('Default_controllers.php');
        $data['basepath'] = base_url();
        $data['pageHeading'] = $this->ts_functions->getlanguage('substext','menus','solo');
        $data['plans_active'] = 'active';
        $data['plandetails'] = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_status'=>1));
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/plans_pricing',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
/******* Add / Renew Subscription ENDS ***************/

/******* Purchased products OR Products unders your plan STARTS ***************/
	public function purchased(){

        $data['basepath'] = base_url();
        $data['purchase_active'] = 'active';

        $join_array = array('ts_products','ts_products.prod_id = ts_purchaserecord.purrec_prodid');
		$purchasedDetails = $this->DatabaseModel->access_database('ts_purchaserecord','','',array('purrec_uid'=>$this->session->userdata['ts_uid'],'prod_status'=>1),$join_array);

        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
            $uid = $this->session->userdata['ts_uid'];
            $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));

            $userPlan = $userDetail[0]['user_plans'];
            $planProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>0,'prod_plan'=>$userPlan));
            $data['dateofplan'] = $userDetail[0]['user_plansdate'];

            if( $userPlan == '0' ) {
                $data['planMsg'] = $this->ts_functions->getlanguage('upgrademessage','userdashboard','solo');
            }
        }
        else {
            $planProducts = array();
        }
		$data['purchasedDetails'] = array_merge($purchasedDetails,$planProducts);

        $data['pageHeading'] = $this->ts_functions->getlanguage('paiddowntext','menus','solo');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/purchased',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}

/******* Purchased products OR Products unders your plan ENDS ***************/

/******* FREE products STARTS ***************/
	public function free_downloads(){
        $data['basepath'] = base_url();
        $data['download_active'] = 'active';

		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$data['freeProducts'] = $this->DatabaseModel->access_database('ts_products','','',array('prod_free'=>1,'prod_status'=>1),$join_array);

        $data['pageHeading'] = $this->ts_functions->getlanguage('freedowntext','menus','solo');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/free_downloads',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
/******* FREE products ENDS ***************/


/******* Purchased Download Product Code STARTS ***************/
	public function download_product($prodUniqid='') {
	    if($prodUniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodUniqid));
	        if(!empty($prodDetails)) {

	            $purchaseDetails = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_uid'=>$this->session->userdata('ts_uid'),'purrec_prodid'=>$prodDetails[0]['prod_id']));

	            if(!empty($purchaseDetails)) {
	                /*$downloadCount = $purchaseDetails[0]['purrec_downloadcount'];
	                $downloadCount = $downloadCount + 1 ;
	                $this->DatabaseModel->access_database('ts_purchaserecord','update',array('purrec_downloadcount'=>$downloadCount),array('purrec_id'=>$purchaseDetails[0]['purrec_id']));*/

                    $this->downloadfiles($prodUniqid);

                }
                else {
                    redirect(base_url());
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* Purchased Download Product Code ENDS ***************/


/******* FREE Download Product Code STARTS ***************/
	public function free_download_product($prodUniqid='') {
	    if($prodUniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodUniqid));
	        if(!empty($prodDetails) && isset($this->session->userdata['ts_uid']) ) {

                $uid = $this->session->userdata('ts_uid');
                $checkAvail = $this->ts_functions->checkproductavailablility($prodUniqid,$uid);
                if( $checkAvail == '0' ) {
                    redirect(base_url());
                }
                elseif( $checkAvail == '2' ) {
                    $this->session->set_flashdata('planMsg', $this->ts_functions->getlanguage('upgrademessage','userdashboard','solo'));
                    redirect(base_url().'dashboard/purchased');
                }

                $downloadCount = $prodDetails[0]['prod_download_count'];
                $downloadCount = $downloadCount + 1 ;
                $this->DatabaseModel->access_database('ts_products','update',array('prod_download_count'=>$downloadCount),array('prod_uniqid'=>$prodUniqid));
                if( $prodDetails[0]['prod_filename'] == '' ) {
                	$this->session->set_flashdata('planMsg', $this->ts_functions->getlanguage('missingzipmessage','userdashboard','solo'));
                    redirect(base_url().'dashboard/purchased');
                }
                else {
                	$this->downloadfiles($prodUniqid);
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* FREE Download Product Code ENDS ***************/

/******* Download file code STARTS ***************/
	private function downloadfiles($uniqid='') {
	    require('Default_controllers.php');
	    if($uniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid));
	        if(!empty($prodDetails)) {

	            if( strpos($prodDetails[0]['prod_filename'],'/') === false ) {

                    $filename = $prodDetails[0]['prod_filename'];
                    
                    $productname = $this->ts_functions->getProductName($prodDetails[0]['prod_id']);
                    $productname = rtrim($productname,'/');

                    $path=dirname(__FILE__);
                    $abs_path=explode('/application/',$path);
                    $source_path = $abs_path[0].'/repo/mainzipfiles/';
                    $destination_path = $abs_path[0].'/repo/temp/';

                    copy ( $source_path.$filename , $destination_path.$filename );
                    rename ( $destination_path.$filename , $destination_path.$productname.'.zip' );

                    header('Content-Type: application/zip');
                    header('Content-Disposition: attachment; filename="'.$productname.'.zip');
                    readfile($destination_path.$productname.'.zip');		// push it out

                    unlink($destination_path.$productname.'.zip');
                    exit();
                }
                else {
                    // Direct URL Download
                    redirect($prodDetails[0]['prod_filename']);
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* Download file code ENDS ***************/

    /************** Make User as Vendor STARTS ******************/

    function complete_vendor() {
        if(isset($_POST['comm'])) {
            $uid = $this->session->userdata['ts_uid'];
            $this->DatabaseModel->access_database('ts_user','update',array('user_accesslevel'=>3),array('user_id'=>$uid));
            $this->session->userdata['ts_level'] = 3;
            echo '1';
        }
        else {

        }
    }

    /************** Make User as Vendor ENDS ******************/
}
?>
