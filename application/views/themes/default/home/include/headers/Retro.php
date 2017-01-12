<!-- Header / Menu Start -->
<div class="ts_header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="ts_logo">
					<a href="<?php echo $basepath;?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"> </a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 col-lg-push-6 col-md-push-6 col-sm-push-6 col-xs-push-0">
				<div class="row">
					<div class="ts_right_menu">
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
							
								<?php if( $this->ts_functions->getsettings('registerhome','checkbox') == '1' ) { ?>
									<li><a href="<?php echo $basepath;?>authenticate/register"><i class="fa fa-user-plus" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo'); ?> </a></li>
								<?php } 
								if( $this->ts_functions->getsettings('loginhome','checkbox') == '1' ) {
								?>
									<li><a href="<?php echo $basepath;?>authenticate/login"><i class="fa fa-user" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('logintext','commontext','solo'); ?> </a></li>
								<?php } ?>
								
							<?php } ?>
						</ul>
						<button class="ts_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-pull-3 col-md-pull-3 col-sm-pull-3 col-xs-pull-0">
				<div class="ts_main_menu_wrapper">
				<div class="ts_main_menu">
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
<div class="ts_second_manu">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_second_menu">
					<button id="menu_show" class="ts_menu_btn2"><i class="fa fa-bars" aria-hidden="true"></i></button>
					<ul id="menu_hide">
						<li class="active"><a href="<?php echo $basepath;?>home/products"><?php echo $this->ts_functions->getlanguage('alltext','homepage','solo'); ?></a></li>

					<?php
					    $cateList = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
					    if(!empty($cateList)) {
					        foreach($cateList as $solo_cate) {
					            $catename = strtolower($solo_cate['cate_urlname']);
                                $catename = str_replace(' ','-',$catename);
                                $catename = preg_replace('!-+!', '-', $catename);

                                echo '<li><a href="'.$basepath.'home/products/'.$catename.'" >'.$solo_cate['cate_name'].'</a>';

                                $sub_cateList = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$solo_cate['cate_id']));
                                if(!empty($sub_cateList)) {
                                    echo '<ul class="sub_menu">';
                                    foreach($sub_cateList as $solo_subcate) {
                                        $catename = strtolower($solo_subcate['sub_urlname']);
                                        $catename = str_replace(' ','-',$catename);
                                        $catename = preg_replace('!-+!', '-', $catename);
                                        echo '<li><a href="'.$basepath.'home/products/'.$catename.'" >'.$solo_subcate['sub_name'].'</a></li>';
                                    }
                                    echo '</ul>';
					            }
					            echo '</li>';
					        }
					    }
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
