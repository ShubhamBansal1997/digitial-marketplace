<?php
    if(isset($this->session->userdata['ts_uid'])) {
    if($this->ts_functions->getsettings('marketplace','typevendor') == 'multi') {
        if($this->ts_functions->getsettings('vendor','revenuemodel') != 'commission') {
            if( $this->session->userdata['ts_level'] != 3) {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_accesslevel'=>3));
                if(!empty($userDetail)) {
                    $this->session->userdata['ts_level'] = 3;
                }
            }
        }
    }
    }
?>
<!-- Header End -->
<body>
<!--- Language Box Start -->
<?php if( $this->ts_functions->getsettings('languageswitch','checkbox') == 1 ) { ?>
	<div class="ts_language_box">
		<div class="ts_lang_section">
<?php
	$langArr = explode(',',$this->ts_functions->getsettings('languageoption','text'));
?>
	<i class="fa fa-language" aria-hidden="true"></i>
			<select onchange="set_cookie_language(this);" >
<?php for($i=0;$i<count($langArr);$i++) {
	$selected = ( $this->ts_functions->getsettings('weblanguage','text') == $langArr[$i] ) ? 'selected' : '' ;
	if( isset($_COOKIE['language']) ) {
		if( $_COOKIE['language'] == $langArr[$i] ) {
			$selected = 'selected';
		}
	}
            
	echo '<option '.$selected.' value="'.$langArr[$i].'">'.$langArr[$i].'</option>';
}?>
			</select>
		</div>
	</div>
<?php } ?>
<!--- Language Box End -->
<!--Preloader Start-->
<div id="preloader">
  <div id="status">
  	<img src="<?php echo $this->ts_functions->getsettings('preloader','url');?>" alt="loading" />
  </div>
</div>
<!--Preloader End-->
<!--Message Popup Start-->
<div class="ts_message_popup">
  <p class="ts_message_popup_text">

  </p>
</div>
<!--Message Popup End-->
<?php
$activeHeader = $this->ts_functions->getsettings('headers','active');
include('headers/'.$activeHeader.'.php');
?>
<!-- Header / Menu End -->
<!-- Modal Start -->
<div class="modal fade ts_tnc_popup" id="tnc_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="ts_btn pull-right" data-dismiss="modal" aria-label="Close">X</button>
				<h4 class="modal-title"><?php echo $this->ts_functions->getlanguage('becvendortext','menus','solo'); ?> </h4>
			</div>
			<div class="modal-body">
				<div class="ts_tnc_section">
				<?php $tnc = $this->ts_functions->getsettings('vendor','tnctext');
				    $tncArr = explode(PHP_EOL, $tnc);
				    for($i=0;$i<count($tncArr);$i++) {
                         echo '<p>'.$tncArr[$i].'</p>';
                    }
				?>
				</div>
				<div class="ts_checkbox">
					<input type="checkbox" id="tnc">
					<label for="tnc"><?php echo $this->ts_functions->getlanguage('vendorpopupcheck','userdashboard','solo'); ?></label>
				</div>
			</div>
			<div class="modal-footer">
			    <?php
			        $vendor_type = $this->ts_functions->getsettings('vendor','revenuemodel') == 'commission' ? 'commission' : 'plans' ;
			    ?>
				<button type="button" class="ts_btn" onclick='become_a_vendor("<?php echo $vendor_type;?>")'><?php echo $this->ts_functions->getlanguage('submittext','authentication','solo'); ?></button>
				<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('vendorpopupcheckerror','userdashboard','solo'); ?>" id="checkpop_error">
			</div>
		</div>
  </div>
</div>
<!-- Modal End -->

