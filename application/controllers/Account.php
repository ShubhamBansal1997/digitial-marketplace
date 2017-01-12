<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( !isset($this->session->userdata['wms_uid']) ) {
			redirect(base_url());
		}
		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }

	}

	public function index(){
		$data['basepath'] = base_url();
		$data['pagetitle'] = 'Account';
		$uid = $this->session->userdata['wms_uid'];
		if(isset($_POST['update_accountbtn'])) {
		    $data_array = array(
		        'user_fname'    =>  $_POST['users_fname'],
		        'user_lname'    =>  $_POST['users_lname'],
		        'user_mobile'    =>  $_POST['users_mobile'],
		        'user_address'    =>  $_POST['users_address'],
		        'user_country'    =>  $_POST['users_country'],
		        'user_state'    =>  $_POST['users_state'],
		        'user_city'    =>  $_POST['users_city'],
		        'user_zip'    =>  $_POST['users_zip']
		    );
		    $this->WMS_DB_Model->access_database('wms_user','update',$data_array,array('user_id'=>$uid));
		}
		$data['countrylist'] = $this->WMS_DB_Model->access_database('wms_country','select','','');
		$data['user_details'] = $this->WMS_DB_Model->access_database('wms_user','select','',array('user_id'=>$uid));
		$this->load->view('user/include/header',$data);
		$this->load->view('user/accountpage',$data);
		$this->load->view('user/include/footer',$data);
	}

    /* Change Password - Account Page */
	function change_password(){
	    if(isset($_POST['users_pwd'])) {
	        if( $_POST['users_pwd'] == $_POST['users_repwd'] ) {
	            $uid = $this->session->userdata['wms_uid'];
	            $this->WMS_DB_Model->access_database('wms_user','update',array('user_pwd'=>md5($_POST['users_pwd'])),array('user_id'=>$uid));
	            echo 'success';
	        }
	        else {
	            echo 'error';
	        }
	    }
	    else {
	        echo 'error';
	    }
	    die();
	}
}
?>
