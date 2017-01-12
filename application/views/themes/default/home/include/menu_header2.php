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
<!-- Header / Menu Start -->
<div class="ts_header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="ts_logo">
					<a href="<?php echo $basepath;?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"> </a>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="ts_second_menu header_style3">
					<ul>
						<li class="active"><a href="#">All Items</a></li>
						<li><a href="#">WordPress</a></li>
						<li><a href="#">HTML</a>
							<ul class="sub_menu">
								<li><a href="#">HTML</a></li>
								<li><a href="#">Marketing</a></li>
								<li><a href="#">CMS</a>
									<ul class="sub_menu">
										<li><a href="#">HTML</a></li>
										<li><a href="#">Marketing</a></li>
										<li><a href="#">CMS</a></li>
										<li><a href="#">eCommerce</a></li>
									</ul>
								</li>
								<li><a href="#">eCommerce</a></li>
							</ul>
						</li>
						<li><a href="#">Marketing</a></li>
						<li><a href="#">CMS</a></li>
						<li><a href="#">eCommerce</a></li>
						<li><a href="#">Muse</a></li>
						<li><a href="#">UI Design</a></li>
						<li><a href="#">Plugins</a></li>
						<li><a href="#">More</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ts_second_manu">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 col-lg-push-9 col-md-push-9 col-sm-push-9 col-xs-push-0">
					<div class="ts_right_menu header_style3">
						<ul>
						<?php
							$cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;
						?>
							<li><a href="<?php echo $basepath;?>shop/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><?php echo count($cartArr); ?></span></a></li>
							<?php if(isset($this->session->userdata['ts_uname'])) { ?>
								<li><a href="<?php echo $basepath;?>authenticate/login">
								<?php if($this->session->userdata['ts_level'] == 3) { ?>
								<i class="fa fa-users" aria-hidden="true" id="vendor_icon"></i>
								<?php } else { ?>
								<i class="fa fa-user-secret" aria-hidden="true"></i>
								<?php } ?> Hi, <?php echo $this->session->userdata['ts_uname']; ?> </a></li>
								<li><a href="<?php echo $basepath;?>home/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('logouttext','commontext','solo'); ?> </a></li>
							<?php } else { ?>
								<li><a href="<?php echo $basepath;?>authenticate/register"><i class="fa fa-user-plus" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo'); ?> </a></li>
								<li><a href="<?php echo $basepath;?>authenticate/login"><i class="fa fa-user" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('logintext','commontext','solo'); ?> </a></li>
							<?php } ?>
						</ul>
						<button class="ts_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
					</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-lg-pull-3 col-md-pull-3 col-sm-pull-3 col-xs-pull-0">
				<div class="ts_main_menu_wrapper">
				<div class="ts_main_menu header_style3">
					<ul class="mail_asd">
                <?php
                    $urlpath = $_SERVER['REQUEST_URI'];
				    $urlpath_arr = explode('aboutus',$urlpath);
				    $urlpath_arr1 = explode('dashboard',$urlpath);
				    $urlpath_arr2 = explode('products',$urlpath);
				    $urlpath_arr3 = explode('plans_pricing',$urlpath);
				    $urlpath_arr4 = explode('contact',$urlpath);
                ?>

					<?php if( $this->ts_functions->getsettings('menuHome','checkbox') == '1' ) { ?>
						<li <?php if(count($urlpath_arr) != 2 && count($urlpath_arr1) != 2 && count($urlpath_arr2) != 2 && count($urlpath_arr3) != 2 && count($urlpath_arr4) != 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>"><?php echo $this->ts_functions->getlanguage('hometext','menus','solo'); ?> </a></li>
					<?php }
                    if( $this->ts_functions->getsettings('menuAboutUs','checkbox') == '1' ) { ?>
						<li <?php if(count($urlpath_arr) == 2) { ?>class="active" <?php } ?> ><a href="<?php echo $basepath;?>home/aboutus"><?php echo $this->ts_functions->getlanguage('abouttext','menus','solo'); ?></a></li>
					<?php }
                    if( $this->ts_functions->getsettings('menuProducts','checkbox') == '1' ) { ?>
						<li <?php if(count($urlpath_arr1) == 2 || count($urlpath_arr2) == 2) { ?>class="active" <?php } ?> ><a class="first_sb"> <?php echo $this->ts_functions->getlanguage('producttext','menus','solo'); ?>  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
						<?php
						    $freeProd = $this->DatabaseModel->access_database('ts_products','select','',array('prod_free'=>1,'prod_status'=>1));

						    $paidProd = $this->DatabaseModel->access_database('ts_products','select','',array('prod_free'=>0,'prod_status'=>1));
						?>
                            <ul class="sub_menu">
                                 <li><a href="<?php echo $basepath;?>home/products/freebies" class="second_sb"> <?php echo $this->ts_functions->getlanguage('freetext','menus','solo'); ?> (<?php echo count($freeProd);?>) </a>
                                </li>
                                <li><a href="<?php echo $basepath;?>home/products" class="second_sb"> <?php echo $this->ts_functions->getlanguage('paidtext','menus','solo'); ?>  (<?php echo count($paidProd);?>) </a>
                                </li>
                            </ul>
                        </li>
                    <?php }
                    if( $this->ts_functions->getsettings('menuPricingtbl','checkbox') == '1' ) { ?>

                        <?php if($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi') {
                            // vendor
                            if($this->ts_functions->getsettings('vendor','revenuemodel') != 'commission') {
                        ?>

                            <li <?php if(count($urlpath_arr3) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>home/vendor_plans"> <?php echo $this->ts_functions->getlanguage('plantext','menus','solo'); ?></a></li>

                        <?php } } else {
                            // products
                        ?>

                            <li <?php if(count($urlpath_arr3) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>home/plans_pricing"> <?php echo $this->ts_functions->getlanguage('plantext','menus','solo'); ?></a></li>

                        <?php } ?>
					<?php }
                    if( $this->ts_functions->getsettings('menuContactUs','checkbox') == '1' ) { ?>
						<li  <?php if(count($urlpath_arr4) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>home/contact"><?php echo $this->ts_functions->getlanguage('contacttext','menus','solo'); ?></a></li>
					<?php }	?>

						<?php
						 if(isset($this->session->userdata['ts_uname'])) {
						    if( $this->session->userdata['ts_level'] == '1' ) {
						    // Admin
						    ?>

						    <li <?php if(count($urlpath_arr1) == 2) { ?>class="active" <?php } ?> ><a href="<?php echo $basepath;?>dashboard"><?php echo $this->ts_functions->getlanguage('dashboardtext','menus','solo'); ?></a></li>

						   <?php }
						    elseif( $this->session->userdata['ts_level'] == '2' ) {
						    // Normal User
						?>
						    <li  <?php if(count($urlpath_arr1) == 2) { ?>class="active" <?php } ?> ><a class="first_sb"><?php echo $this->ts_functions->getlanguage('boardtext','menus','solo'); ?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>


						    <ul class="sub_menu">
						         <li><a href="<?php echo $basepath;?>dashboard"><?php echo $this->ts_functions->getlanguage('dashboardtext','menus','solo'); ?></a></li>
                             <?php if($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi') { ?>
						        <li><a class="second_sb" data-toggle="modal" data-target="#tnc_popup"><?php echo $this->ts_functions->getlanguage('becvendortext','menus','solo'); ?> </a></li>
						    <?php } ?>
                            </ul>

						    </li>
						<?php } elseif( $this->session->userdata['ts_level'] == '3' ) { // Already a Vendor
						?>
						    <li  <?php if(count($urlpath_arr1) == 3) { ?>class="active" <?php } ?> ><a  class="first_sb"><?php echo $this->ts_functions->getlanguage('boardtext','menus','solo'); ?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>

						    <ul class="sub_menu">
						         <li><a href="<?php echo $basepath;?>dashboard"><?php echo $this->ts_functions->getlanguage('dashboardtext','menus','solo'); ?></a></li>
                            <?php if($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi') { ?>
                                <li><a href="<?php echo $basepath;?>vendorboard"><?php echo $this->ts_functions->getlanguage('vendorboardtext','menus','solo'); ?> </a></li>
                            <?php } ?>
                            </ul>
						    </li>
						<?php } } ?>

					</ul>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
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

