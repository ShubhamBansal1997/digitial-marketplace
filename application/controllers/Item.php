<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ts_functions');
		$this->theme = $this->ts_functions->current_theme();
	}

    public function _remap($method,$parameter)
    {
        $this->index($method,$parameter);
    }

	public function index($method,$parameter)
	{
	    if( $parameter[0] == 'live_demo' ) {
	        $uniqid = $parameter[1];
	        $livedemo = '1';
	        $pageType = 'Live Demo';
	    }
	    else {
	        $uniqid = $parameter[0];
	        $livedemo = '0';
	        $pageType = 'Single';
	    }

	    /**** Get Analytics STARTS *********/
	    $details = $this->ts_functions->product_analytics($uniqid,$pageType);
	    if( $details == 'ZERO' ) {
	        redirect(base_url());
	    }
	    /**** Get Analytics ENDS *********/

        $data['basepath'] = base_url();
		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','','');
		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$prodDetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_uniqid'=>$uniqid),$join_array);
		if(empty($prodDetails)) {
		    redirect(base_url());
		}
		if( $prodDetails[0]['prod_status'] == '0' ) {
		    if(isset($this->session->userdata['ts_uid'])) {
                $userId = $this->session->userdata['ts_uid'];
                $pr_details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid , 'prod_uid'=>$userId));
                if(empty($pr_details)) {
                    if( $this->session->userdata['ts_level'] != '1' ) {
                        redirect(base_url());
                    }
                }
            }
            else {
                redirect(base_url());
            }
		}
		$data['productdetails'] = $prodDetails;
		$data['productName'] = $this->ts_functions->getProductName($prodDetails[0]['prod_id']);

		$this->load->view('themes/'.$this->theme.'/home/include/product_header',$data);

		if( $livedemo == '1' ) {
		    $data['remainigProducts'] = $this->DatabaseModel->access_database('ts_products','','', array('prod_uniqid !='=>$uniqid),$join_array);
		    $this->load->view('themes/'.$this->theme.'/home/live_demo',$data);
		}
		else {

		    $this->db->select('*');
            $this->db->from('ts_products');
            $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->where('prod_status',1);
            $this->db->where('prod_uniqid !=',$uniqid);
            $this->db->where('prod_cateid',$prodDetails[0]['prod_cateid']);
            $this->db->limit(0, 4);
            $rs=$this->db->get();
            $data['relatedProducts'] = $rs->result_array();


		    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		    $this->load->view('themes/'.$this->theme.'/home/single_item',$data);
		    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
		}
	}

}
