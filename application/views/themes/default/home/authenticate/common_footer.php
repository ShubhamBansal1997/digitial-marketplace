		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_backlink">
					<a href="<?php echo $basepath;?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('backtohometext','authentication','solo');?></a>
				</div>
			</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ts_copyright ts_toppadder30 ts_bottompadder30">
			        <?php if( $this->ts_functions->getsettings('copyright','checkbox') == '1' ) { ?>
					<p>&copy; <a href="<?php echo $basepath;?>"><?php echo $this->ts_functions->getsettings('sitename','text');?></a> <?php echo $this->ts_functions->getsettings('copyright','text');?> </p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Login Section End -->

<!-- Error Messages Start -->
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('username','message','solo');?>" id="usernameerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('usernameexists','message','solo');?>" id="usernameexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('emailexists','message','solo');?>" id="emailexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('password','message','solo');?>" id="pwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('repassword','message','solo');?>" id="repwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginsuc','message','solo');?>" id="loginsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('forgotpassword','message','solo');?>" id="forgotpwdsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('registersuc','message','solo');?>" id="registersuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('activateerror','message','solo');?>" id="actvtacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('blockederror','message','solo');?>" id="blockacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginerror','message','solo');?>" id="loginerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('forgotpwderror','message','solo');?>" id="forgotpwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('resetpwdsuc','message','solo');?>" id="pwdchngsuc_text">

<!-- Error Messages End -->
<input type="hidden" value="<?php echo $basepath;?>" id="basepath">
<!--Main js file Start-->
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/authenticate/custom_login.js"></script>
<!--Main js file End-->

</body>
</html>
