<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ts_functions');
		$this->theme = $this->ts_functions->current_theme();
	}

    public function _remap($method)
    {
        if($method == '0') {
            redirect(base_url());
        }
        $this->index($method);
    }

	public function index($method)
	{
	    $data['basepath'] = base_url();
		$userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_uname'=>$method));

        if(empty($userDetail)) {
            redirect(base_url());
        }
		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
        $productdetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_status'=>1,'prod_uid'=>$userDetail[0]['user_id']),$join_array);

		$data['productdetails'] = $productdetails;
		$data['userDetail'] = $userDetail;
		$data['headlineText'] = ucfirst($method)."'s ".$this->ts_functions->getlanguage('profiletext','menus','solo');

        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/vendor_page',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}

}
