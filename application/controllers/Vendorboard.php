<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendorboard extends CI_Controller {

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
			if($this->session->userdata['ts_level'] == 2) {
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

    /******* Index page STARTS ***************/
	public function index(){
//print_r($_SESSION);
	    /**** Check Vendor Plans STARTS ********/
	    if($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' ) {
            if( $this->session->userdata['ts_vendorplanstatus'] == '0' ) {
                $this->session->set_flashdata('vendorplanMsg', 'Your current vendor plan has expired.');
                redirect(base_url().'dashboard/purchased');
            }
        }
	    /**** Check Vendor Plans ENDS ********/

		$data['basepath'] = base_url();

        $uid = $this->session->userdata['ts_uid'];
        $data['productdetails_active'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_uid'=>$uid));
        $data['productdetails_free'] = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>1,'prod_uid'=>$uid));

        $total_products = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uid'=>$uid));

        $prodUniqIdArr = array();
        $prodDBIdArr = array();
        if(!empty($total_products)) {
            foreach($total_products as $solo_prod) {
                array_push($prodUniqIdArr,$solo_prod['prod_uniqid']);
                array_push($prodDBIdArr,$solo_prod['prod_id']);
            }
        }

        if( !isset($_POST['duration'])) {

            if(!empty($prodUniqIdArr)) {
                $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','wherein',$prodUniqIdArr,'','prod_analysis_prodid');
                $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','wherein',$prodDBIdArr,'','purrec_prodid');
            }
            else {
                $data['prodViews'] = $data['prodSales'] = array();
            }

            $data['duration'] = $data['d1'] = $data['d2'] = '';
        }
        else if(isset($_POST['duration'])) {

            if(!empty($prodUniqIdArr)) {
                if( $_POST['duration'] == '' ) {

                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','wherein',$prodUniqIdArr,'','prod_analysis_prodid');
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','wherein',$prodDBIdArr,'','purrec_prodid');

                }
                elseif($_POST['duration'] == 'today'){
                    $todaydate = date('Y-m-d');

                    $like_arr = array('prod_analysis_date'=>$todaydate);
                    $data['prodViews'] = $this->DatabaseModel->access_database('ts_product_analysis','select_like',$like_arr,'',array('prod_analysis_prodid',json_encode($prodUniqIdArr)));

                    $like_arr = array('purrec_date'=>$todaydate);
                    $data['prodSales'] = $this->DatabaseModel->access_database('ts_purchaserecord','select_like',$like_arr,'',array('purrec_prodid',json_encode($prodDBIdArr)));

                }
                elseif($_POST['duration'] == 'yesterday'){
                    $yesterdate = date('Y-m-d',strtotime("-1 days"));

                    $havingArr = array('user_accesslevel'=>2);
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
            }
            else {
                $data['prodViews'] = $data['prodSales'] = array();
            }

            $data['duration'] = $_POST['duration'];
            $data['d1'] = $_POST['d1'];
            $data['d2'] = $_POST['d2'];
        }


        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/vboard',$data);
	}
	/******* Index page ENDS ***************/

	 /*************** Manage Products STARTS *****************/

	 public function manage_products(){
        $data['basepath'] = base_url();
		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$uid = $this->session->userdata['ts_uid'];
		$data['productdetails'] = $this->DatabaseModel->access_database('ts_products','','',array('prod_uid'=>$uid),$join_array);
		$data['actionUrl'] = base_url().'vendorboard/modify_products';
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('vendor/manage_products',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}
	 /*************** Manage Products ENDS *****************/

    /*************** Add Products STARTS *****************/

	/***** Add products Step 1 ENDS **********/
	public function add_products_1(){
		if( isset($_POST['p_type']) ) {
			$uid = $this->session->userdata['ts_uid'];
			$dataArr = array(
				'prod_name' =>  trim($_POST['p_name']),
				'prod_type' =>  $_POST['p_type'],
				'prod_urlname' =>  strtolower(trim($_POST['p_urlname'])),
				'prod_tags' =>  isset($_POST['p_tags']) ? trim($_POST['p_tags']) : '',
				'prod_description' =>  isset($_POST['p_description']) ? trim($_POST['p_description']) : '',
				'prod_cateid' =>  trim($_POST['p_category']),
				'prod_subcateid' =>  isset($_POST['p_subcategory']) ? trim($_POST['p_subcategory']) : '' ,
				'prod_downloadpassword' =>  isset($_POST['p_downpassword']) ? trim($_POST['p_downpassword']) : '' ,
				'prod_free' =>  $_POST['is_free']
			);

			if( isset($_POST['p_demourl']) ) {
				$dataArr['prod_demourl']=$_POST['p_demourl'];
			}
			
			if( isset($_POST['p_downlink']) ) {
				$dataArr['prod_filename']=$_POST['p_downlink'];
			}
				
			if(isset($_POST['p_price'])) {
				$dataArr['prod_price']=$_POST['p_price'];
			}
			else if( isset($_POST['plan_str']) ) {
				$dataArr['prod_plan']=trim($_POST['plan_str'],',');
			}
			
			if($_POST['prod_id']=='0') {
				$dataArr['prod_date'] = date('Y-m-d H:i:s');
				$dataArr['prod_uniqid'] = substr(str_shuffle("01234123456789123489"), 0, 6);
				$dataArr['prod_uid'] = $uid;
				$dataArr['prod_status'] = 0;

				$prodId =  $this->DatabaseModel->access_database('ts_products','insert',$dataArr,'');
				echo $prodId;
			}
			else {
				$this->DatabaseModel->access_database('ts_products','update',$dataArr, array('prod_id'=>$_POST['oldprod_id']));
				echo $prodId = $_POST['oldprod_id'];
			}
			die();
		
		}
		$data['basepath'] = base_url();
		$data['oldprod_id'] = '0';
		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('vendor/add_products_step1',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}
	/***** Add products Step 1 ENDS **********/
	
	
	/***** Add products Step 2 STARTS **********/
	public function add_products_2($prod_id=''){
		$prod_details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$prod_id));
		if( empty($prod_details) ) {
			redirect(base_url().'vendorboard');
		}
		$gallery_det = $this->DatabaseModel->access_database('ts_prodgallery','select','',array('prodgallery_id'=>$prod_id));
		
		$data['gallery_det'] = $gallery_det;
		$data['prod_details'] = $prod_details;
		$data['basepath'] = base_url();
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('vendor/add_products_step2',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}
	/***** Add products Step 2 ENDS **********/
		
	/***** Upload files STARTS **********/
	function upload_prod_files(){
		if(isset($_FILES['file'])) {
		
			$path=dirname(__FILE__);
			$abs_path=explode('/application/',$path);
			$pathToImages = $abs_path[0].'/repo/images/';
			$pathToZip = $abs_path[0].'/repo/mainzipfiles/';
			$pathToGallery = $abs_path[0].'/repo/gallery/';
			$pathToThumbImages = $abs_path[0].'/repo/images/small/';
			$previous_Details = $this->DatabaseModel->access_database('ts_products','select','', array('prod_id'=>$_POST['prod_id']));
			
			$prodId = $_POST['prod_id'];
			
			if( $_POST['prod_name'] == 'Preview.jpg' ) 
			{
				// Preview Image
				$this->load->library('image_lib'); 
				$config['upload_path'] = $pathToImages;
				$config['max_size'] = 0;
				$config['allowed_types'] = 'jpg|jpeg';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('file'))
				{
				
					/***** Remove Previous Uploads STARTS **********/
					
						$prod_upload_det = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$_POST['prod_id']));
						if( $prod_upload_det[0]['prod_image'] != '' ) {
							unlink( $pathToImages.$prod_upload_det[0]['prod_image'] );
							$i = explode('.',$prod_upload_det[0]['prod_image']);
							unlink( $pathToThumbImages.$i[0].'_thumb.'.$i[1] );
						}				
					/***** Remove Previous Uploads ENDS **********/
				
					$uploaddata=$this->upload->data();
					
					$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
					$imgNewname = $randomstr;
					$img_name = $uploaddata['raw_name'];
					$img_ext = $uploaddata['file_ext'];

					$imgNewname = $imgNewname.$img_ext;
					$thumbname = $randomstr.'_thumb'.$img_ext;

					$config2['source_image'] = $pathToImages.$img_name.$img_ext;
					$config2['create_thumb'] = true;
					$config2['maintain_ratio'] = false;
					$config2['width'] = '750';
					$config2['height'] = '400';
					$this->image_lib->initialize($config2);
					$this->image_lib->resize();
					$this->image_lib->clear(); //The clear method resets all of the values
					
					rename($pathToImages.$img_name.'_thumb'.$img_ext, $pathToImages.$imgNewname);
					
					$config3['source_image'] = $pathToImages.$img_name.$img_ext;
					$config3['create_thumb'] = false;
					$config3['maintain_ratio'] = false;
					$config3['width'] = '394';
					$config3['height'] = '210';
					$this->image_lib->initialize($config3);
					$this->image_lib->resize();
					$this->image_lib->clear(); //The clear method resets all of the values
					
					rename($pathToImages.$img_name.$img_ext, $pathToImages.$thumbname);
					copy($pathToImages.$thumbname , $pathToThumbImages.$thumbname);
					
					unlink( $pathToImages.$thumbname );
					$imgDataArr['prod_image']=$imgNewname;
					$this->DatabaseModel->access_database('ts_products','update',$imgDataArr,array('prod_id'=>$_POST['prod_id']));
					echo '1';
					
				}
				else {
					echo '0';
					die();
				}
			}
			elseif( $_POST['prod_name'] == 'Product.zip' ) {
				// Product Zip
				
				$config1['upload_path'] = $pathToZip;
				$config1['allowed_types'] = '*';
				$config1['max_size'] = 0;
				$this->load->library('upload', $config1);
				$this->upload->initialize($config1);

				if ($this->upload->do_upload('file')){
				
				/***** Remove Previous Uploads STARTS **********/
					
					$prod_upload_det = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$_POST['prod_id']));
					if( $prod_upload_det[0]['prod_filename'] != '' ) {
						if( strpos($prod_upload_det[0]['prod_filename'],'/') === false ) {
							unlink( $pathToZip.$prod_upload_det[0]['prod_filename'] );
						}
					}				
				/***** Remove Previous Uploads ENDS **********/
				
				
					$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
					$zipNewname = $randomstr;
					$uploaddata=$this->upload->data();
					$zip_name = $uploaddata['raw_name'];
					$zip_ext = $uploaddata['file_ext'];
					$zipNewname = $zipNewname.$zip_ext;

					rename($pathToZip.$zip_name.$zip_ext, $pathToZip.$zipNewname);
					$imgDataArr['prod_filename']=$zipNewname;
					$this->DatabaseModel->access_database('ts_products','update',$imgDataArr,array('prod_id'=>$_POST['prod_id']));
					echo '1';
				}
				else {
					echo '0';
					die();
				}
				
			}
			else {
				// Preview Files
				
				$config2['upload_path'] = $pathToGallery;
				$config2['allowed_types'] = '*';
				$config2['max_size'] = 0;
				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				
				$productFolderName = 'p_'.$prodId;

				function deleteCompleteDir($finaldirectory) {
					if (substr($finaldirectory, strlen($finaldirectory) - 1, 1) != '/') {
						$finaldirectory .= '/';
					}
					$files = glob($finaldirectory . '*', GLOB_MARK);
					foreach ($files as $file) {
						if (is_dir($file)) {
							deleteCompleteDir($file);
						} else {
							unlink($file);
						}
					}
				}
				
				if( $_POST['prod_type'] == 'Other' ) {
					// Other
					if($this->upload->do_upload('file')){

						$finaldirectory = $abs_path[0].'/repo/gallery/'.$productFolderName;

						if( !file_exists( $finaldirectory ) ) {
							mkdir ($finaldirectory);
						}
						else {
							deleteCompleteDir($finaldirectory);

							$this->DatabaseModel->access_database('ts_prodgallery','delete','', array('prodgallery_pid'=>$prodId));
						}

						$uploaddata=$this->upload->data();

						$zip_name=$uploaddata['raw_name'];
						$zip_ext = $uploaddata['file_ext'];

						$zip = new ZipArchive();
						$x = $zip->open($pathToGallery.$zip_name.$zip_ext);
						if ($x === true) {
							$zip->extractTo($finaldirectory);
							$zip->close();
						}
						$img_str = "";
						if ($handle = opendir($finaldirectory)) {
							while (false !== ($ImageName = readdir($handle))) {

								$ext_array = explode('.',$ImageName);

								if(count($ext_array) == 2 && $ext_array[0] != '') {
								$img_ext = $ext_array[1];
								$imgExtensions = array("jpg", "jpeg", "png", "gif");

								if (in_array($img_ext, $imgExtensions))
									$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);

									$imgdbname = $randomstr.'.'.$img_ext;
									rename($finaldirectory.'/'.$ImageName, $finaldirectory.'/'.$imgdbname);

									$this->DatabaseModel->access_database('ts_prodgallery','insert', array('prodgallery_img'=>$imgdbname ,'prodgallery_pid'=>$prodId) , '');
								}
							}
							closedir($handle);
						}

						unlink($pathToGallery.$zip_name.$zip_ext);
						$this->DatabaseModel->access_database('ts_products','update', array('prod_gallery'=>1), array('prod_id'=>$_POST['prod_id']));
						echo '1';
					}
				}
				else {
					// Text  , Audio and Video
					if($this->upload->do_upload('file')){

						$finaldirectory = $abs_path[0].'/repo/gallery/'.$productFolderName;

						if( !file_exists( $finaldirectory ) ) {
							mkdir ($finaldirectory);
						}
						else {
							deleteCompleteDir($finaldirectory);

							$this->DatabaseModel->access_database('ts_prodgallery','delete','', array('prodgallery_pid'=>$prodId));
						}

						$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
						$zipNewname = $randomstr;
						$uploaddata=$this->upload->data();
						
						$zip_name = $uploaddata['raw_name'];
						$zip_ext = $uploaddata['file_ext'];
						$zipNewname = $zipNewname.$zip_ext;
						copy($pathToGallery.$zip_name.$zip_ext, $finaldirectory.'/'.$zipNewname);
						
						$this->DatabaseModel->access_database('ts_prodgallery','insert', array('prodgallery_img'=>$zipNewname ,'prodgallery_pid'=>$prodId) , '');
						unlink($pathToGallery.$zip_name.$zip_ext);
						
						$this->DatabaseModel->access_database('ts_products','update', array('prod_gallery'=>1), array('prod_id'=>$_POST['prod_id']));
						echo '1';
					}
				}
			}
			
		}
		else {
			echo '0';
		}
		die();
	}
	/***** Upload files ENDS **********/
	
	function use_paste_image(){
		
        if(isset($_POST['currentval']))
        {

            $url_arr = explode('.',$_POST['currentval']);
            $url_arr = array_reverse($url_arr);

            $ext_arr = array('jpg','jpeg','png','gif');

            if(in_array($url_arr[0], $ext_arr )) {

				$path=dirname(__FILE__);
				$abs_path=explode('/application/',$path);
				$pathToImages = $abs_path[0].'/repo/images/';
				$pathToThumbImages = $abs_path[0].'/repo/images/small/';
				$previous_Details = $this->DatabaseModel->access_database('ts_products','select','', array('prod_id'=>$_POST['prod_id']));
			
				$prodId = $_POST['prod_id'];
			
				if( $_POST['prod_name'] == 'Preview.jpg' ) 
				{
					// Preview Image
					$this->load->library('image_lib'); 
					$img_ext = '.'.$url_arr[0];
                	$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);

                	$imageString = file_get_contents($_POST['currentval']);
                	$savetheimage = file_put_contents( $pathToImages.$randomstr.$img_ext ,$imageString);

					if($savetheimage) {

						/***** Remove Previous Uploads STARTS **********/
					
							$prod_upload_det = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$_POST['prod_id']));
							if( $prod_upload_det[0]['prod_image'] != '' ) {
								unlink( $pathToImages.$prod_upload_det[0]['prod_image'] );
								$i = explode('.',$prod_upload_det[0]['prod_image']);
								unlink( $pathToThumbImages.$i[0].'_thumb.'.$i[1] );
							}				
						/***** Remove Previous Uploads ENDS **********/
						
						$randomstr_new = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
						$imgNewname = $randomstr_new;
						$img_name = $randomstr;
						$img_ext = $img_ext;

						$imgNewname = $imgNewname.$img_ext;
						$thumbname = $randomstr_new.'_thumb'.$img_ext;

						$config2['source_image'] = $pathToImages.$img_name.$img_ext;
						$config2['create_thumb'] = true;
						$config2['maintain_ratio'] = false;
						$config2['width'] = '750';
						$config2['height'] = '400';
						$this->image_lib->initialize($config2);
						$this->image_lib->resize();
						$this->image_lib->clear(); //The clear method resets all of the values
					
						rename($pathToImages.$img_name.'_thumb'.$img_ext, $pathToImages.$imgNewname);
					
						$config3['source_image'] = $pathToImages.$img_name.$img_ext;
						$config3['create_thumb'] = false;
						$config3['maintain_ratio'] = false;
						$config3['width'] = '394';
						$config3['height'] = '210';
						$this->image_lib->initialize($config3);
						$this->image_lib->resize();
						$this->image_lib->clear(); //The clear method resets all of the values
					
						rename($pathToImages.$img_name.$img_ext, $pathToImages.$thumbname);
						copy($pathToImages.$thumbname , $pathToThumbImages.$thumbname);
					
						unlink( $pathToImages.$thumbname );
						$imgDataArr['prod_image']=$imgNewname;
						$this->DatabaseModel->access_database('ts_products','update',$imgDataArr,array('prod_id'=>$_POST['prod_id']));
						echo '1';
					}
					else {
						echo '2';
					}
				}
            }
            else {
                echo '3';
            }
        }
        else
        {
            echo '404';
        }
        die();
	}
	
		
	public function update_products($uniq_id=''){
	    if( $uniq_id == '' ) {
	        redirect(base_url().'vendorboard/manage_products');
	    }
		$data['basepath'] = base_url();

		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
    	$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');

        $uid = $this->session->userdata['ts_uid'];
        $productdetails = $this->DatabaseModel->access_database('ts_products','','',array('prod_uniqid'=>$uniq_id,'prod_uid'=>$uid),$join_array);

		$data['productdetails'] = $productdetails;
		$data['oldprod_id'] = $productdetails[0]['prod_id'];
		$data['actionUrl'] = base_url().'vendorboard/modify_products';
		$this->load->view('vendor/include/vheader',$data);
		$this->load->view('vendor/add_products_step1',$data);
		$this->load->view('vendor/include/vfooter',$data);
	}
   

    /*************** Add Products ENDS *****************/


    /****************** Products Download STARTS ********************/

    function self_product_download($uniqid='') {
        if($uniqid != '') {
            $userId = $this->session->userdata['ts_uid'];
            $productDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid , 'prod_uid'=>$userId));
            if(empty($productDetails)) {
                if( $this->session->userdata['ts_level'] != '1' ) {
                    redirect(base_url());
                }
            }
            $productDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid));

            if( strpos($productDetails[0]['prod_filename'],'/') === false ) {

                $filename = $productDetails[0]['prod_filename'];
                $productname = $this->ts_functions->getProductName($productDetails[0]['prod_id']);
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
                redirect($productDetails[0]['prod_filename']);
            }
        }
        else {
            redirect(base_url());
        }
    }
    /**************** View Products STARTS ****************/

    public function view_products($uniqid=''){
        if($uniqid != '') {

            $uid = $this->session->userdata['ts_uid'];
            $data['basepath'] = base_url();
            $productdetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid,'prod_uid'=>$uid));
            if(empty($productdetails)) {
                redirect(base_url().'vendorboard');
            }
            $data['controller'] = 'vendorboard';
            $data['productdetails'] = $productdetails;
            $data['prodDownloads'] = $this->DatabaseModel->access_database('ts_downloadtbl','select','',array('download_pid'=>$productdetails[0]['prod_id']));

            if( !isset($_POST['duration'])) {
                $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid));
                $data['duration'] = $data['pagetype'] = $data['d1'] = $data['d2'] = '';
            }
            else if(isset($_POST['duration'])) {

                if( $_POST['duration'] == '' && $_POST['pagetype'] == '' ) {
                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid));
                }
                elseif($_POST['duration'] == '' && $_POST['pagetype'] != ''){
                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',array('prod_analysis_prodid'=>$uniqid, 'prod_analysis_pagetype'=>$_POST['pagetype']));
                }
                elseif($_POST['duration'] == 'today'){
                    $todaydate = date('Y-m-d');
                    $like_arr = array('prod_analysis_date'=>$todaydate);

                    $havingArr = ($_POST['pagetype']!='') ? array('prod_analysis_pagetype'=>$_POST['pagetype']) : '' ;

                    if( $havingArr == '' ) {
                        $havingArr = array('prod_analysis_prodid'=>$uniqid);
                    }
                    else {
                        $havingArr['prod_analysis_prodid'] = $uniqid;
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','like',$havingArr,$like_arr);

                }
                elseif($_POST['duration'] == 'yesterday'){
                    $yesterdate = date('Y-m-d',strtotime("-1 days"));
                    $like_arr = array('prod_analysis_date'=>$yesterdate);

                    $havingArr = ($_POST['pagetype']!='') ? array('prod_analysis_pagetype'=>$_POST['pagetype']) : '' ;

                    if( $havingArr == '' ) {
                        $havingArr = array('prod_analysis_prodid'=>$uniqid);
                    }
                    else {
                        $havingArr['prod_analysis_prodid'] = $uniqid;
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','like',$havingArr,$like_arr);
                }
                elseif($_POST['duration'] == 'custom'){
                    $fromdate = date_format(date_create ( $_POST['d1'] ) , 'Y-m-d H:i:s');
                    $todate = date_format(date_create ( $_POST['d2'] ) , 'Y-m-d H:i:s');

                    $whr = array(
                            'prod_analysis_date >=' =>  $fromdate,
                            'prod_analysis_date <=' =>  $todate
                    );
                    $whr['prod_analysis_prodid']=$uniqid;

                    if( $_POST['pagetype'] != '' ) {
                        $whr['prod_analysis_pagetype']=$_POST['pagetype'];
                    }

                    $data['analyticsData'] = $this->DatabaseModel->access_database('ts_product_analysis','select','',$whr);

                }
                $data['duration'] = $_POST['duration'];
                $data['pagetype'] = $_POST['pagetype'];
                $data['d1'] = $_POST['d1'];
                $data['d2'] = $_POST['d2'];
            }


            $this->load->view('vendor/include/vheader',$data);
            $this->load->view('vendor/view_products',$data);
        }
        else {
            redirect(base_url());
        }
	}

	/**************** View Products ENDS ****************/

    /******************* Transaction START **************/

    function sales_history(){

	    $uid = $this->session->userdata['ts_uid'];
        $data['transactionDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , array('payment_status'=>'yes','payment_type'=>'products'));
        $data['uid'] = $uid;
        $data['basepath'] = base_url();
        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/sales_history',$data);
        $this->load->view('vendor/include/vfooter',$data);
	}

    function transaction_history_detail(){
        if(isset($_POST['currentId'])){

            $join_array = array('ts_user','ts_user.user_id = ts_paymentdetails.payment_uid');
		    $transactionDetails = $this->DatabaseModel->access_database('ts_paymentdetails','','',array('payment_id'=>$_POST['currentId']),$join_array);

            if(empty($transactionDetails)) {
                echo '<p>Data can not be fetched.</p>';
            }
            else {
                $custom = trim($transactionDetails[0]['payment_pid']);
                $customArr = explode(',',$custom);
                $outputStr = '';

				$sym = $this->ts_functions->getsettings('portal','curreny');
				
                $outputStr .= '<p> User Details </p> <p> Username : <b>'.$transactionDetails[0]['user_uname'].'</b></p> <p> Email : <b>'.$transactionDetails[0]['user_email'].'</b></p> <p> Registration Date : <b>'.date_format(date_create ( $transactionDetails[0]['user_registerdate'] ) , 'M d, Y').'</b></p> <p> Transaction Mode : <b>'.ucfirst($transactionDetails[0]['payment_mode']).'</b></p> <p> Payer\'s Email : <b>'.$transactionDetails[0]['payment_email'].'</b></p> <p> Total Cost : <b>'.$sym.' '.$transactionDetails[0]['payment_total'].'</b></p> <p> Discount Applied : <b>'.$sym.' '.$transactionDetails[0]['payment_discount'].'</b></p> <p> Amount Paid : <b>'.$sym.' '.$transactionDetails[0]['payment_amount'].'</b></p><hr />';

                if($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') {
                    $outputStr .= ' <p> Total amount paid : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$transactionDetails[0]['payment_amount'].'</b> </p> <p> Commission got : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$transactionDetails[0]['payment_earning'].'</b> </p> <hr />';
                }

                for($i=0;$i<count($customArr);$i++) {

                    $pId = $customArr[$i];
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
                                $outputStr .= '<p> Vendor Plan Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findPlan[0]['vplan_amount'].'</b></p>';
                            }
                            else {
                                $outputStr .= '<p> Product Plan Name : <b>'.$findPlan[0]['plan_name'].'</b></p>';
                                $outputStr .= '<p> Product Plan Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findPlan[0]['plan_amount'].'</b></p>';
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
                            $outputStr .= '<p> Product Amount : <b>'.$this->ts_functions->getsettings('portal','curreny').' '.$findProduct[0]['prod_price'].'</b></p>';

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

    /******************* Transaction ENDS **************/
    /********************* Withdrawal Section STARTS ***************/

    function withdrawal(){
        $data['basepath'] = base_url();
        $uid = $this->session->userdata['ts_uid'];
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

        $productdetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uid'=>$uid));
        $venCommArr = array();
        if(!empty($productdetails)) {
            $transactionDetailsArray = array();
            foreach($productdetails as $solo_prod) {
                $trDet = $this->DatabaseModel->access_database('ts_paymentdetails','like', '' , array('payment_pid'=>$solo_prod['prod_uniqid']));
                if(!empty($trDet)) {
                    foreach($trDet as $solotransaction) {
                        $custom = trim($solotransaction['payment_pid']);
                        $customArr = explode(',',$custom);

                        $venStr = trim($solotransaction['payment_vendor_commission']);
                        if( $venStr != '' ) {
                            $venArr = explode(',',$venStr);

                            for($i=0;$i<count($venArr);$i++) {
                                $venSplitArr = explode('@#', trim($venArr[$i]));

                                if($solo_prod['prod_uniqid'] == $venSplitArr[0] ) {
                                    $venCommArr[] = $venSplitArr[1];
                                }
                            }
                        }
                    }
                }
            }
            $data['totalCommissionAmount'] = array_sum($venCommArr);
        }
        else {
            $data['totalCommissionAmount'] = 0;
        }

        $data['withdrawalDetails_received'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','totalvalue', array('venwith_text','totalReceivedAmount') , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

        $data['withdrawalReceivedDetails'] = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select', '' , array('venwith_uid'=>$uid,'venwith_type'=>'payed_amount'));

        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/withdrawal',$data);
        $this->load->view('vendor/include/vfooter',$data);
    }

    /**** Ajax function to handel updation of Withdrawal settings ****/
	public function update_withdrawaldetails() {
	    if(isset($_POST['updateform'])) {
	        $updatedata = json_decode($_POST['updatedata']);
	        foreach( $updatedata as $soloKey=>$soloValue ) {
	            $uid = $this->session->userdata['ts_uid'];
	            $data_array = array(
                    'venwith_uid'   =>  $uid,
                    'venwith_type'  =>  $soloKey
                );
                $res = $this->DatabaseModel->access_database('ts_vendorwithdrawal','select','', $data_array);

                if(!empty($res)) {
                    $this->DatabaseModel->access_database('ts_vendorwithdrawal','update',array('venwith_text'=>$soloValue) , array('venwith_id'=>$res[0]['venwith_id']));
                }
                else {
                    $data_array['venwith_text'] = $soloValue;
                    $this->DatabaseModel->access_database('ts_vendorwithdrawal','insert', $data_array , '');
                }
	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}
    /********************* Withdrawal Section ENDS ***************/

    /************** Wallet Statements STARTS ************/
	public function wallet_statement() {
	    $uid = $this->session->userdata['ts_uid'];
        $data['walletDetails'] = $this->DatabaseModel->access_database('ts_paymentdetails','orderby', array('payment_date','desc') , array('payment_status'=>'yes','payment_mode'=>'wallet','payment_uid'=>$uid));
        $data['uid'] = $uid;
        $data['basepath'] = base_url();
        $this->load->view('vendor/include/vheader',$data);
        $this->load->view('vendor/wallet_statement',$data);
        $this->load->view('vendor/include/vfooter',$data);
	}
    /********************* Wallet Statements ENDS ***************/
	
	/******************* Fetching Sub Category STARTS *****************/
	
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
    
	/******************* Fetching Sub Category ENDS *****************/
}
?>
