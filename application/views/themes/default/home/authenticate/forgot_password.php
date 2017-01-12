    <div class="form-group" id="forgotpwd_typepage">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('fgpwdinputtext','authentication','solo');?>" id="users_uname" class="form-control validate">
        </div>
    </div>
    <div class="ts_login_btn_field">
        <a onclick="checkformvalidation();" class="ts_btn pull-right" ><?php echo $this->ts_functions->getlanguage('submittext','authentication','solo');?> <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>
    </div>

</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="ts_get_link ts_toppadder20">
    	<?php if( $this->ts_functions->getsettings('registerhome','checkbox') == '1' ) { ?>
        	<?php echo $this->ts_functions->getlanguage('logbottomtext','authentication','solo');?> <a href="<?php echo $basepath; ?>authenticate/register"><?php echo $this->ts_functions->getlanguage('logbottomhreftext','authentication','solo');?></a>
        <?php } ?>
    </div>
