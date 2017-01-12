<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
	    redirect(base_url().'settings/texts');
	}

	public function texts(){
	    $data['basepath'] = base_url();
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/settings_text',$data);
		$this->load->view('backend/include/footer',$data);
	}

	public function websites(){
	    $data['basepath'] = base_url();
	    $data['useColor'] = '1';
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/settings_website',$data);
		$this->load->view('backend/include/footer',$data);
	}

    /**** Function to upload images to server ****/
    public function upload_imagesettings() {
	    if(isset($_FILES)) {
	        $path=dirname(__FILE__);
            $abs_path=explode('/application/',$path);
            
            $pathToBGImg = $abs_path[0].'/themes/default/images/';
            $pathTo404Img = $abs_path[0].'/themes/default/images/web/';
            
	        foreach( $_FILES as $k=>$v ) {
                if($v['name'] != ''){
                
                	if( $k == 'backgroundimg_url' ) {
                		$pathToImages = $abs_path[0].'/themes/default/images/';
                	}
                	elseif( $k == 'accountaccessimg_url' || $k == 'notfoundimg_url' || $k == 'oopsimg_url' || $k == 'successimg_url' ) {
                		$pathToImages = $abs_path[0].'/themes/default/images/web/';
                	}
                	else {
                		$pathToImages = $abs_path[0].'/webimage/';
                	}
                	
                    $config['upload_path'] = $pathToImages;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|ico';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($k))
                    {
                        $arr = explode('_',$k);
                        $imgNewname = $arr[0];
                        $uploaddata=$this->upload->data();

                        $img_name = $uploaddata['raw_name'];
                        $img_ext = $uploaddata['file_ext'];

                        $imgNewname = $imgNewname.$img_ext;
                        if( $img_name != $arr[0] ) {
                            if( file_exists ($pathToImages.$imgNewname) ) {
                                unlink($pathToImages.$imgNewname);
                            }
                        }

                        rename($pathToImages.$img_name.$img_ext, $pathToImages.$imgNewname);

                        if( $k == 'backgroundimg_url' ) {
							$completeLink = base_url().'themes/default/images/'.$imgNewname;
						}
						elseif( $k == 'accountaccessimg_url' || $k == 'notfoundimg_url' || $k == 'oopsimg_url' || $k == 'successimg_url' ) {
							$completeLink = base_url().'themes/default/images/web/'.$imgNewname;
						}
						else {
							$completeLink = base_url().'webimage/'.$imgNewname;
						}
					
                        
                        $this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$completeLink),array('key_text'=>$arr[0].'_url'));
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
	    }
	    else {
	        redirect(base_url());
	    }
	    die();
	}

    /**** Ajax function to handel updation of settings ****/
	public function update_settingsdetails() {
	    if(isset($_POST['updateform'])) {
	        $updatedata = json_decode($_POST['updatedata']);
	        foreach( $updatedata as $soloKey=>$soloValue ) {
	            if( $soloKey == 'sitecolor_code' ) {
	                $soloValue = ltrim($soloValue,'#');

                    // change color
                    $path=dirname(__FILE__);
                    $abs_path=explode('/application/',$path);
                    $pathToColorFile = $abs_path[0].'/themes/'.$this->theme.'/css/';

                    $curColorCodes = file_get_contents($pathToColorFile.'color.txt');
                    $newColorCodes = str_replace('{ColorCode}',$soloValue,$curColorCodes);

                    file_put_contents($pathToColorFile.'color.css',$newColorCodes);

	            }

	            if( $soloKey == 'sitehighcolor_code' ) {
	                $soloValue = ltrim($soloValue,'#');

                    // change color
                    $path=dirname(__FILE__);
                    $abs_path=explode('/application/',$path);
                    $pathToColorFile = $abs_path[0].'/themes/'.$this->theme.'/css/';

                    $curColorCodes = file_get_contents($pathToColorFile.'color.css');
                    $newColorCodes = str_replace('{ColorCodeHigh}',$soloValue,$curColorCodes);

                    file_put_contents($pathToColorFile.'color.css',$newColorCodes);

	            }
	            $this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$soloValue),array('key_text'=>$soloKey));
	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	/**** Ajax function to handel language text updates ****/
    public function update_languagetext() {
	    if(isset($_POST['currentText'])) {
	        $colArr = explode('#',$_POST['dataId']);

	        $k = 'language_'.$colArr[2];
	        $this->DatabaseModel->access_database('ts_language','update',array($k=>$_POST['currentText']),array('language_key'=>$colArr[0],'language_type'=>$colArr[1]));

	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}

	/**** Function to update main language settings ****/
    public function updatelanguages() {
	    if(isset($_POST['weblanguage_text'])) {
	        if( trim($_POST['addnewlanguage']) != '' ) {
	            $existingLang = $this->ts_functions->getsettings('languageoption','text');
	            $this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$existingLang.','.$_POST['addnewlanguage']),array('key_text'=>'languageoption_text'));

	            $this->load->dbforge();
	            $k = 'language_'.$_POST['addnewlanguage'];
	            $fields = array(
                    $k => array('type' => 'TEXT')
                );
                $this->dbforge->add_column('ts_language', $fields);
	        }

            $this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$_POST['weblanguage_text']),array('key_text'=>'weblanguage_text'));
            
            setcookie("language", $_POST['weblanguage_text'] , time()+60*60*24*30,'/');
            			
			$languageswitch_checkbox = (isset($_POST['languageswitch_checkbox'])) ? 1 : 0 ;
			
$this->DatabaseModel->access_database('ts_settings','update',array('value_text'=>$languageswitch_checkbox),array('key_text'=>'languageswitch_checkbox'));

			redirect($_SERVER['HTTP_REFERER']);
	    }
	    else {
	        redirect(base_url());
	    }
	    die();
	}

	/**** Function to update values of tables ****/

	function updatethevalue() {
	    if(isset($_POST['id'])) {
	        if( $_POST['type'] == 'products' ) {
	            $dArr = explode('_',$_POST['id']);
	            $k = 'prod_'.$dArr[1];
	            $this->DatabaseModel->access_database('ts_products','update',array($k=>$_POST['vlu']),array('prod_id'=>$dArr[0]));
				if( $k == 'prod_status' ) {
					$this->ts_functions->sendnotificationemails_productstatus($dArr[0],$_POST['vlu']);
				}
	        }
	        elseif( $_POST['type'] == 'coupons' ) {
	            $dArr = explode('_',$_POST['id']);
	            $k = 'coup_'.$dArr[1];
	            $this->DatabaseModel->access_database('ts_coupons','update',array($k=>$_POST['vlu']),array('coup_id'=>$dArr[0]));

	        }
	        elseif( $_POST['type'] == 'testi' ) {
	            $dArr = explode('_',$_POST['id']);
	            $k = 'testi_'.$dArr[1];
	            $this->DatabaseModel->access_database('ts_testimonial','update',array($k=>$_POST['vlu']),array('testi_id'=>$dArr[0]));

	        }
	        elseif( $_POST['type'] == 'cate' ) {
	            $dArr = explode('_',$_POST['id']);
	            $k = 'cate_'.$dArr[1];
	            $this->DatabaseModel->access_database('ts_categories','update',array($k=>$_POST['vlu']),array('cate_id'=>$dArr[0]));

	        }
	        elseif( $_POST['type'] == 'categories' ) {
	            $this->ts_functions->updatesettings($_POST['id'],$_POST['vlu']);
	        }
	        elseif( $_POST['type'] == 'user' ) {
	            $dArr = explode('_',$_POST['id']);
	            $k = 'user_'.$dArr[1];
	            $this->DatabaseModel->access_database('ts_user','update',array($k=>$_POST['vlu']),array('user_id'=>$dArr[0]));

	        }
	        echo '1';
	    }
	    else {
	        echo '0';
	    }
	    die();
	}


	/*************** payments settings STARTS *********************/
	function payment(){
	    $data['basepath'] = base_url();
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/settings_payment',$data);
		$this->load->view('backend/include/footer',$data);
	}

	/*************** payments settings STARTS *********************/
	function menus(){
	    $data['basepath'] = base_url();
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/settings_menus',$data);
		$this->load->view('backend/include/footer',$data);
	}

	/*************** payments settings STARTS *********************/
	function account_access(){
	    $data['basepath'] = base_url();
		$this->load->view('backend/include/header',$data);
		$this->load->view('backend/settings_account_access',$data);
		$this->load->view('backend/include/footer',$data);
	}

}
?>
