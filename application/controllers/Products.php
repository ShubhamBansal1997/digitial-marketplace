<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
	    $this->theme = $this->ts_functions->current_theme();
	}

	public function index(){
		redirect(base_url().'products/manage_products');
	}

	public function manage_products(){
        $data['basepath'] = base_url();
		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$data['productdetails'] = $this->DatabaseModel->access_database('ts_products','','','',$join_array);
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/manage_products',$data);
		$this->load->view('backend/include/footer',$data);
	}


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
				'prod_coupon' =>  isset($_POST['p_coupons']) ? trim($_POST['p_coupons']) : '' ,
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
		$data['couponsList'] = $this->DatabaseModel->access_database('ts_coupons','select','',array('coup_status'=>1));
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/add_products_step1',$data);
		$this->load->view('backend/include/footer',$data);
	}
	/***** Add products Step 1 ENDS **********/
	
	
	/***** Add products Step 2 STARTS **********/
	public function add_products_2($prod_id=''){
		$prod_details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$prod_id));
		if( empty($prod_details) ) {
			redirect(base_url().'backend');
		}
		$gallery_det = $this->DatabaseModel->access_database('ts_prodgallery','select','',array('prodgallery_id'=>$prod_id));
		
		$data['gallery_det'] = $gallery_det;
		$data['prod_details'] = $prod_details;
		$data['basepath'] = base_url();
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/add_products_step2',$data);
		$this->load->view('backend/include/footer',$data);
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
	        redirect(base_url().'products/manage_products');
	    }
		$data['basepath'] = base_url();

		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
    	$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
    	if( $this->session->userdata['ts_level'] == '1') {
            $productdetails = $this->DatabaseModel->access_database('ts_products','','',array('prod_uniqid'=>$uniq_id),$join_array);
    	}
    	else {
            $uid = $this->session->userdata['ts_uid'];
            $productdetails = $this->DatabaseModel->access_database('ts_products','','',array('prod_uniqid'=>$uniq_id,'prod_uid'=>$uid),$join_array);
    	}
		$data['productdetails'] = $productdetails;
		$data['oldprod_id'] = $productdetails[0]['prod_id'];
		$data['actionUrl'] = base_url().'products/modify_products';
		$data['couponsList'] = $this->DatabaseModel->access_database('ts_coupons','select','',array('coup_status'=>1));
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/add_products_step1',$data);
		$this->load->view('backend/include/footer',$data);
	}


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

            $data['basepath'] = base_url();
            $productdetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid));
            $data['productdetails'] = $productdetails;
            $data['controller'] = 'products';
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


            $this->load->view('backend/include/header',$data);
            $this->load->view('backend/view_products',$data);
        }
        else {
            redirect(base_url());
        }
	}

	/**************** View Products ENDS ****************/
	
	

}
?>
