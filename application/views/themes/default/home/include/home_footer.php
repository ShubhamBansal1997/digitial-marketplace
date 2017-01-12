
<!-- Footer wrappe Start -->
<div class="ts_top_footer ts_toppadder60 ts_bottompadder60" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="500">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_top_footer_section">
					<a href="javascript:;"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"></a>
				</div>
				<div class="ts_top_footer_section ts_toppadder30">
					<ul>

					<?php if( $this->ts_functions->getsettings('menuSupport','checkbox') == '1' ) { ?>
						<li><a href="<?php echo $basepath;?>home/contact"><?php echo $this->ts_functions->getlanguage('supporttext','menus','solo'); ?></a></li>
					<?php }
                    if( $this->ts_functions->getsettings('menuTnC','checkbox') == '1' ) { ?>
						<li><a href="<?php echo $basepath;?>home/terms"><?php echo $this->ts_functions->getlanguage('tnctext','menus','solo'); ?></a></li>
					<?php }
                    if( $this->ts_functions->getsettings('menuPrivacy','checkbox') == '1' ) { ?>
						<li><a href="<?php echo $basepath;?>home/privacy"><?php echo $this->ts_functions->getlanguage('privacytext','menus','solo'); ?></a></li>
					<?php }
                    if( $this->ts_functions->getsettings('menuAboutUs','checkbox') == '1' ) { ?>
						<li><a href="<?php echo $basepath;?>home/aboutus"><?php echo $this->ts_functions->getlanguage('abouttext','menus','solo'); ?></a></li>
					<?php } ?>

					</ul>
				</div>
				<div class="ts_top_footer_section ts_toppadder30">
					<?php if( $this->ts_functions->getsettings('siteaddress','checkbox') == '1' ) { ?>
                        <p><i class="fa fa-map-marker"></i> <?php echo $this->ts_functions->getsettings('siteaddress','text');?></p>
                    <?php }
                    if( $this->ts_functions->getsettings('sitephone','checkbox') == '1' ) { ?>
                        <p><i class="fa fa-phone"></i>  <?php echo $this->ts_functions->getsettings('sitephone','text');?></p>
                    <?php }
                    if( $this->ts_functions->getsettings('siteemail','checkbox') == '1' ) { ?>
                        <p><a href="mailto:<?php echo $this->ts_functions->getsettings('siteemail','text');?>?Subject=Hi" target="_top"><i class="fa fa-envelope"></i> <?php echo $this->ts_functions->getsettings('siteemail','text');?></a></p>
                    <?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="ts_bottom_footer ts_toppadder30 ts_bottompadder30">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
				<div class="ts_copyright">
				    <?php if( $this->ts_functions->getsettings('copyright','checkbox') == '1' ) { ?>
					<p>&copy; <a href="<?php echo $basepath;?>"><?php echo $this->ts_functions->getsettings('sitename','text');?></a> <?php echo $this->ts_functions->getsettings('copyright','text');?> </p>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
				<div class="ts_footer_link">
					<ul>
					    <?php if( $this->ts_functions->getsettings('fblink','checkbox') == '1' ) { ?>
						<li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('fblink','url');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<?php }
						if( $this->ts_functions->getsettings('googlelink','checkbox') == '1' ) { ?>
						<li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('googlelink','url');?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<?php }
						if( $this->ts_functions->getsettings('twitterlink','checkbox') == '1' ) { ?>
						<li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('twitterlink','url');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Footer wrappe End -->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>">

<!--Main js file Start-->
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/plugins/jquery.stellar.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/plugins/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/plugins/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/custom.js"></script>
<!--Main js file End-->

</body>
</html>
