<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $headlineText;?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Content wrapper Start -->
<div class="ts_single_theme_wrapper ts_toppadder100 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="row">
					<?php foreach($productdetails as $soloProd) {
						$prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
						$catename = strtolower($soloProd['cate_urlname']);
                        $catename = str_replace(' ','-',$catename);
                        $catename = preg_replace('!-+!', '-', $catename);
					?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="ts_theme_boxes">
							<div class="ts_theme_boxes_img">
								<a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>"><img src="<?php echo $basepath;?>repo/images/<?php echo $soloProd['prod_image'];?>" title="<?php echo $soloProd['prod_name'];?>" /></a>
							</div>
							<div class="ts_theme_boxes_info">
								<div class="ts_theme_details">
									<h4><?php echo $soloProd['prod_name'];?></h4>
									<p> <a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo strtoupper($soloProd['cate_name']);?></a></p>
								</div>

								<div class="ts_theme_price">

								<?php if( $soloProd['prod_free'] == '0') {
									if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
									/*** buy now section ***/
									?>
										<a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $soloProd['prod_uniqid'];?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?></a>
									<?php } else { ?>
										<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloProd['prod_uniqid'];?>" class="ts_price"><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?> <?php echo $soloProd['prod_price'];?></a>
								<?php   }
									} else { ?>
										<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloProd['prod_uniqid'];?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="ts_sidebar_wrapper">
					<aside class="widget widget_meta_attributese">
						<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('vendorinfotext','homepage','solo');?></h4>
						<dl>
						    <dt><?php echo $this->ts_functions->getlanguage('usernametext','userdashboard','solo');?></dt>
							<dd> : <?php echo $userDetail[0]['user_uname'];?> </dd>

							<div class="clearfix"></div>

							<dt><?php echo $this->ts_functions->getlanguage('membersincetext','homepage','solo');?></dt>
							<dd> : <?php echo date_format(date_create ( $userDetail[0]['user_registerdate'] ) , 'M d, Y');?> </dd>

							<div class="clearfix"></div>

							<dt><?php echo $this->ts_functions->getlanguage('productsnumtext','homepage','solo');?></dt>
							<dd> : <?php echo count($productdetails);?> </dd>

							<div class="clearfix"></div>

						</dl>
					</aside>
					<aside class="widget widget_author_contact">
						<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('contactvendortext','homepage','solo');?></h4>
						<?php if(isset($this->session->userdata['ts_uid'])) { ?>

						<div class="ts_author_contact_box">

                            <textarea rows="4" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('yourmsgtext','commontext','solo'); ?>" id="vendorMessage"></textarea>

                            <a onclick="sendvendorcontactform(this);" data-vendor="<?php echo $userDetail[0]['user_id'];?>" class="ts_btn pull-right"><?php echo $this->ts_functions->getlanguage('sendtext','commontext','solo'); ?> <i class="fa fa-rocket" aria-hidden="true"></i></a>
						</div>

						<?php } else { ?>

						<div class="ts_author_contact_box">
                            <p style="text-align:center;"><a href="<?php echo $basepath;?>authenticate/login"><?php echo $this->ts_functions->getlanguage('logintocontacttext','homepage','solo');?></a></p>
						</div>

						<?php } ?>
					</aside>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Content wrapper End -->
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('contactsuc','message','solo');?>" id="contactsuc_text">
