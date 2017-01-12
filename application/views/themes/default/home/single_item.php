<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $productdetails[0]['prod_name'];?></h3>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Contact wrapper Start -->
<div class="ts_singletheme_wrapper ts_toppadder100 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="ts_theme_detail_wrapper">
					<div class="ts_theme_shortinfo">
						<div class="row">
						<?php
                        $prodName = $this->ts_functions->getProductName($productdetails[0]['prod_id']);
                        ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="ts_theme_boxes">
									<div class="ts_theme_boxes_img">
						<?php if( is_numeric(stripos($productdetails[0]['prod_demourl'],'http'))) { 
							if( is_numeric(stripos($productdetails[0]['prod_demourl'],'https:'))) { 
							
							if( $productdetails[0]['prod_image'] != '' ) {
								$live_demo_url = '<a href="'.$productdetails[0]['prod_demourl'].'" target="_blank"><img src="'.$basepath.'repo/images/'.$productdetails[0]['prod_image'].'" title="'. $productdetails[0]['prod_name'].'" class="img-responsive"></a>';
							}
							else {
								$live_demo_url = '<a href="'.$productdetails[0]['prod_demourl'].'" target="_blank"><img src="'.$basepath.'adminassets/images/white_image.jpeg" title="'. $productdetails[0]['prod_name'].'" style="width:730px;height:390px;" class="img-responsive"></a>';
							}
							
						} else { 
						
							if( $productdetails[0]['prod_image'] != '' ) {
								$live_demo_url = '<a href="'.$basepath.'item'.$prodName.'live_demo/'.$productdetails[0]['prod_uniqid'].'" target="_blank"><img src="'.$basepath.'repo/images/'.$productdetails[0]['prod_image'].'" title="'. $productdetails[0]['prod_name'].'" class="img-responsive"></a>';
							}
							else {
								$live_demo_url = '<a href="'.$basepath.'item'.$prodName.'live_demo/'.$productdetails[0]['prod_uniqid'].'" target="_blank"><img src="'.$basepath.'adminassets/images/white_image.jpeg" title="'. $productdetails[0]['prod_name'].'" style="width:730px;height:390px;" class="img-responsive"></a>';
							}
							
						} } else { 
						
							if( $productdetails[0]['prod_image'] != '' ) {
							$live_demo_url = '<img src="'.$basepath.'repo/images/'.$productdetails[0]['prod_image'].'" title="'. $productdetails[0]['prod_name'].'" class="img-responsive">';
							}
							else {
								$live_demo_url = '<img src="'.$basepath.'adminassets/images/white_image.jpeg" title="'. $productdetails[0]['prod_name'].'" style="width:730px;height:390px;" class="img-responsive">';
							}
							
						} ?>
						
									<?php echo $live_demo_url; ?>	
									</div>
									<!--<span><?php echo $productdetails[0]['cate_name'];?></span>-->

									<div class="ts_theme_boxes_info">
									
									<?php 
									
							$prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$productdetails[0]['prod_id']) );	
							 if( is_numeric(stripos($productdetails[0]['prod_demourl'],'http'))) { 
							 	if( is_numeric(stripos($productdetails[0]['prod_demourl'],'https:'))) { 
							  ?>
								<a href="<?php echo $productdetails[0]['prod_demourl'];?>" class="ts_btn pull-left"  target="_blank"><?php echo $this->ts_functions->getlanguage('livedemotab','homepage','solo');?></a>
							<?php } else { ?>
								<a href="<?php echo $basepath;?>item/<?php echo $prodName.'live_demo/'.$productdetails[0]['prod_uniqid'];?>" class="ts_btn pull-left"  target="_blank"><?php echo $this->ts_functions->getlanguage('livedemotab','homepage','solo');?></a>
							<?php } } ?>

							<?php		
								if(!empty($prod_gallery)) { 
						if($productdetails[0]['prod_type'] == 'Audio') {
							$btn_kw = 'listenbtn'; $prod_type = 'audio';
						}
						elseif( $productdetails[0]['prod_type'] == 'Video' ){
							$btn_kw = 'videobtn'; $prod_type = 'video';
						}
						elseif( $productdetails[0]['prod_type'] == 'Text' ){
							$btn_kw = 'viewbtn'; $prod_type = 'text';
						}
						else {
							$btn_kw = 'gallerybtn'; $prod_type = 'other';
						} 
						
						if( $productdetails[0]['prod_type'] == 'Text' ) { 
						$down_link = base_url().'home/download_preview_text/'.$productdetails[0]['prod_id'];
						
						?>
							<a onclick="window.location = '<?php echo $down_link; ?>'" class="ts_btn pull-left popup_open_preview"><?php echo $this->ts_functions->getlanguage($btn_kw,'homepage','solo');?></a>
						<?php } 
						else if( $productdetails[0]['prod_type'] == 'Other' ) { ?>
							
							<a onclick="$('.popup-gallery').find('img:first').trigger('click');" class="ts_btn pull-left popup_open_preview"><?php echo $this->ts_functions->getlanguage($btn_kw,'homepage','solo');?></a>
							
						<?php }
						else { ?>
							
							<a onclick="openthegalleryimages(<?php echo $productdetails[0]['prod_id'];?>,'<?php echo $prod_type;?>');" class="ts_btn pull-left popup_open_preview"><?php echo $this->ts_functions->getlanguage($btn_kw,'homepage','solo');?></a>
						
						<?php } ?>
								<?php 
								 }
							
								 
								 ?>	
										
										<div class="ts_share_box">
											<a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>" class="pull-left" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>

											<a href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>&text=<?php echo urlencode($productdetails[0]['prod_name']);?>" class="pull-left" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ts_singletheme_detail">
						<?php echo $productdetails[0]['prod_description'];?>
					</div></div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ts_sidebar_responsive">
								<div class="ts_sidebar_wrapper">
									<aside class="widget widget_license">
										<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('licenseheading','singleproductpage','solo');?></h4>
										<div class="ts_widget_license_info">
											<p><?php echo $this->ts_functions->getlanguage('licensesubheading','singleproductpage','solo');?></p>

											<?php if( $productdetails[0]['prod_free'] == '0') {
												if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>

													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('addtocart','homepage','solo');?> </a>

													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> - <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?> </a>

												<?php } else { ?>
													<a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
											<?php   }
												} else {
													// Free
												?>
													<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>

											<?php } ?>


											<!-- <a href="javascript:;" class="ts_about_license">Read about the license</a> -->
										</div>
									</aside>
									<aside class="widget widget_meta_attributese">
											<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('productheading','singleproductpage','solo');?></h4>
											<dl>
											<?php
												$vName = $this->ts_functions->getVendorName($productdetails[0]['prod_uid']);
											?>
												<dt><?php echo $this->ts_functions->getlanguage('vendornametext','singleproductpage','solo');?></dt>
												<dd> : <a href="<?php echo $basepath;?>vendor/<?php echo $vName;?>"><?php echo ucfirst($vName); ?></a> </dd>

												<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('createsubheading','singleproductpage','solo');?></dt>
												<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_date'] ) , 'M d, Y');?> </dd>

												<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('updateddatetext','singleproductpage','solo');?></dt>
												<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_update'] ) , 'M d, Y');?></dd>

												<!--<div class="clearfix"></div>

												<dt><?php echo $this->ts_functions->getlanguage('ratingssubheading','singleproductpage','solo');?></dt>
												<dd> : 8.9/10</dd> -->

												<div class="clearfix"></div>

												<?php if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
													$purDetail = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$productdetails[0]['prod_id']));
												?>
												<dt><?php echo $this->ts_functions->getlanguage('downloadssubheading','singleproductpage','solo');?></dt>
												<dd> : <?php echo count($purDetail);?></dd>
												<?php } ?>

												<div class="clearfix"></div>

											</dl>
										</aside>
								<!--	</aside>
											<aside class="widget widget_advertisement">
											<h4 class="widget-title">Advertisement</h4>
											<img src="images/addv_1.jpg" alt="" class="img-responsive">
										</aside> -->
								</div>
							</div>
						</div>
					</div>

					<?php if(!empty($relatedProducts)) { ?>
    					<div class="ts_related_themebox">

						<h3> <?php echo $this->ts_functions->getlanguage('relatedprodtext','commontext','solo'); ?> </h3>
						<div class="row">
						<?php foreach($relatedProducts as $soloRelateProd) {
						    $prodName = $this->ts_functions->getProductName($soloRelateProd['prod_id']);
						    $vendorName = $this->ts_functions->getVendorName($soloRelateProd['prod_uid']);
						    
						    if( $soloRelateProd['prod_image'] != '' ) {
								$image_a = explode('.',$soloRelateProd['prod_image']);
								$dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
								$img_style = '';
							}
							else {
								$dis_img = '';
								$img_style = 'style="width:330px;height:176px;"';
							}
						
						?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="ts_theme_boxes">
									<div class="ts_theme_boxes_img">
										<a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloRelateProd['prod_uniqid'];?>">
										<img src="<?php echo $dis_img != '' ? $basepath.'repo/images/'.$dis_img : $basepath.'adminassets/images/white_image.jpeg' ; ?>" title="<?php echo $soloRelateProd['prod_name'];?>" <?php echo $img_style; ?>  class="img-responsive">
										</a>
									</div>
									<span><?php echo $soloRelateProd['cate_name'];?></span>
									<div class="ts_theme_boxes_info">
										<div class="ts_theme_details">
											<h4><?php echo $soloRelateProd['prod_name'];?></h4>
											<p> <a href="<?php echo $basepath;?>vendor/<?php echo $vendorName;?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo ucfirst($vendorName);?></a></p>
										</div>
										<div class="ts_theme_price">
							    
                                	<?php if( $soloRelateProd['prod_free'] == '0') {
											if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>

												<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloRelateProd['prod_uniqid'];?>" class="ts_btn"> <i class="fa fa-shopping-cart"></i> </a>

												<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $soloRelateProd['prod_price'];?> </a>

											<?php } else { ?>
												<a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $soloRelateProd['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
										<?php   }
											} else {
												// Free
											?>
												<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloRelateProd['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>

										<?php } ?>
										
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ts_sidebar_responsive_none">
				<div class="ts_sidebar_wrapper">
					<aside class="widget widget_license">
						<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('licenseheading','singleproductpage','solo');?></h4>
						<div class="ts_widget_license_info">
							<p><?php echo $this->ts_functions->getlanguage('licensesubheading','singleproductpage','solo');?></p>

							<?php if( $productdetails[0]['prod_free'] == '0') {
                                if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>

                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('addtocart','homepage','solo');?> </a>

                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> - <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?> </a>

                                <?php } else { ?>
                                    <a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
							<?php   }
							    } else {
							        // Free
							    ?>
							        <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?></a>

							<?php } ?>


							<!-- <a href="javascript:;" class="ts_about_license">Read about the license</a> -->
						</div>
					</aside>
					<aside class="widget widget_meta_attributese">
							<h4 class="widget-title"><?php echo $this->ts_functions->getlanguage('productheading','singleproductpage','solo');?></h4>
							<dl>
							<?php
							    $vName = $this->ts_functions->getVendorName($productdetails[0]['prod_uid']);
							?>
							    <dt><?php echo $this->ts_functions->getlanguage('vendornametext','singleproductpage','solo');?></dt>
								<dd> : <a href="<?php echo $basepath;?>vendor/<?php echo $vName;?>"><?php echo ucfirst($vName); ?></a> </dd>

								<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('createsubheading','singleproductpage','solo');?></dt>
								<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_date'] ) , 'M d, Y');?> </dd>

								<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('updateddatetext','singleproductpage','solo');?></dt>
								<dd> : <?php echo date_format(date_create ( $productdetails[0]['prod_update'] ) , 'M d, Y');?></dd>

								<!--<div class="clearfix"></div>

								<dt><?php echo $this->ts_functions->getlanguage('ratingssubheading','singleproductpage','solo');?></dt>
								<dd> : 8.9/10</dd> -->

								<div class="clearfix"></div>

								<?php if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
								    $purDetail = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$productdetails[0]['prod_id']));
								?>
								<dt><?php echo $this->ts_functions->getlanguage('downloadssubheading','singleproductpage','solo');?></dt>
								<dd> : <?php echo count($purDetail);?></dd>
								<?php } ?>

								<div class="clearfix"></div>

							</dl>
						</aside>
				<!--	</aside>
							<aside class="widget widget_advertisement">
							<h4 class="widget-title">Advertisement</h4>
							<img src="images/addv_1.jpg" alt="" class="img-responsive">
						</aside> -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact wrapper End -->

<?php
$prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$productdetails[0]['prod_id']) );
	if( $productdetails[0]['prod_type'] == 'Audio' || $productdetails[0]['prod_type'] == 'Video' ) {
	if(!empty($prod_gallery)) { ?>
	<!-- PopUp wrappe Start -->
<div class="ts_popup_wrapper">
	<div class="ts_popup_close_overlay"></div>
	<a class="ts_popup_close"><i class="fa fa-times" aria-hidden="true"></i></a>
	<div class="ts_popup_inner ts_video_popup" id="popupgallery">
        <ul>
            <li id="img_0" class="currentActive">
            <?php if( $productdetails[0]['prod_type'] == 'Audio' ) { ?>
            
            <audio controls id="tp_audio"> <source src="<?php echo base_url().'repo/gallery/p_'.$productdetails[0]['prod_id'].'/'.$prod_gallery[0]['prodgallery_img']; ?>" type="audio/mpeg">Your browser does not support the audio element.</audio>
            
            <?php } else { ?>
            
            <video controls id="tp_video"> <source src="<?php echo base_url().'repo/gallery/p_'.$productdetails[0]['prod_id'].'/'.$prod_gallery[0]['prodgallery_img']; ?>" type="video/mp4">Your browser does not support the video element.</video>  
                      
            <?php } ?>
            </li>
        </ul>
	</div>
</div>
<!-- PopUp wrappe End -->
<?php } } else { ?>
	
	
	<!-- PopUp wrappe Start -->
	<div class="popup-gallery" style="display:none;">
		
		<a href="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>">
			<img src="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>" width="75" height="75">
		</a>
		
<?php foreach( $prod_gallery as $solo_gallery) { ?>
		<a href="<?php echo base_url().'repo/gallery/p_'.$productdetails[0]['prod_id'].'/'.$solo_gallery['prodgallery_img']; ?>">
			<img src="<?php echo base_url().'repo/gallery/p_'.$productdetails[0]['prod_id'].'/'.$solo_gallery['prodgallery_img']; ?>" width="75" height="75">
		</a>
	
<?php } ?>

	</div>
	<!-- PopUp wrappe End -->
<?php } ?>