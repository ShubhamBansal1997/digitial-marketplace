<script>
function open_window(url){
    var w = 880, h = 600,
        left = Number((screen.width/2)-(w/2)), tops = Number((screen.height/2)-(h/2)),
        popupWindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
    popupWindow.focus(); return false;
}
</script>
	<div class="social_access">
		<div class="row">
		<?php if( $this->ts_functions->getsettings('facebook','status') == '1' ) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button onclick="open_window('<?php echo $basepath;?>authenticate/facebooklogin');" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('fbtext','authentication','solo');?></button>
			</div>
		 <?php } if( $this->ts_functions->getsettings('google','status') == '1' ) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button onclick="open_window('<?php echo $basepath;?>authenticate/googlelogin');" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('googletext','authentication','solo');?></button>
			</div>
		<?php } ?>
		</div>  
	</div> 
	
    <div class="form-group" id="register_typepage">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regusernametext','authentication','solo');?>" id="users_uname" class="form-control validate username">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regemailtext','authentication','solo');?>" id="users_email" class="form-control validate email">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" class="form-control validate pwd">
        </div>
    </div>
    <div class="ts_login_btn_field">
        <a onclick="checkformvalidation();" class="ts_btn pull-right" ><?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo');?>  <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>

    </div>

</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="ts_get_link ts_toppadder20">
    	<?php if( $this->ts_functions->getsettings('loginhome','checkbox') == '1' ) { ?>
       		<?php echo $this->ts_functions->getlanguage('regbottomtext','authentication','solo');?><a href="<?php echo $basepath; ?>authenticate/login"> <?php echo $this->ts_functions->getlanguage('regbottomhreftext','authentication','solo');?></a>
       	<?php } ?>
    </div>
