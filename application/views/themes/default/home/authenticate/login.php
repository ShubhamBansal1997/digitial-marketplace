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
				<button onclick="open_window('<?php echo $basepath;?>authenticate/facebooklogin');" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('fbtext','authentication','solo');?> </button>
			</div>
		 <?php } if( $this->ts_functions->getsettings('google','status') == '1' ) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button onclick="open_window('<?php echo $basepath;?>authenticate/googlelogin');" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('googletext','authentication','solo');?></button>
			</div>
		<?php } ?>
		</div>  
	</div> 
	
    <div class="form-group" id="login_typepage">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('logusernametext','authentication','solo');?>" id="users_uname" class="form-control validate" value="<?php if(isset($_COOKIE['ts_emanu'])){ echo $_COOKIE['ts_emanu'];} ?>">

        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" class="form-control validate pwd" value="<?php if(isset($_COOKIE['ts_dwp'])){ echo $_COOKIE['ts_dwp'];} ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="ts_checkbox">
            <input type="checkbox" id="remember_me"  <?php if(isset($_COOKIE['ts_dwp'])){ echo "checked";} ?>  />
            <label for="remember_me"><?php echo $this->ts_functions->getlanguage('logremembertext','authentication','solo');?></label>
        </div>
        <div class="ts_forgot_link">
            <a href="<?php echo $basepath;?>authenticate/forgot_password"><?php echo $this->ts_functions->getlanguage('logforgotpwdtext','authentication','solo');?></a>
        </div>
    </div>
    <div class="ts_login_btn_field">
        <a onclick="checkformvalidation();" class="ts_btn pull-right" ><?php echo $this->ts_functions->getlanguage('logintext','commontext','solo');?> <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>
    </div>

</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="ts_get_link ts_toppadder20">
    	<?php if( $this->ts_functions->getsettings('registerhome','checkbox') == '1' ) { ?>
        	<?php echo $this->ts_functions->getlanguage('logbottomtext','authentication','solo');?> <a href="<?php echo $basepath; ?>authenticate/register"> <?php echo $this->ts_functions->getlanguage('logbottomhreftext','authentication','solo');?></a>
        <?php } ?>
    </div>
