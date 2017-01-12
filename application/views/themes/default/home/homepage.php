<!-- Slider wrappe Start -->
<div class="ts_slider_wrapper ts_toppadder100 ts_bottompadder100" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="300">
<?php if( $this->ts_functions->getsettings('homepageoverlayshow','checkbox') == '1' ) { ?>
	<div class="ts_overlay" style="background-color:#<?php echo $this->ts_functions->getsettings('homepageoverlay','color');?>;opacity:<?php echo $this->ts_functions->getsettings('homepageoverlay','opacity');?>;"></div>
<?php } ?>
	<div class="container-fluid">
		<div class="row">
			<h1><?php echo $this->ts_functions->getlanguage('bannerheading','homepage','solo');?></h1>
			<h4><?php echo $this->ts_functions->getlanguage('bannersubheading','homepage','solo');?></h4>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
					<div class="input-group ts_search_field">
						<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('searchplaceholder','homepage','solo');?>" id="searchInput">
						<span class="input-group-btn">
							<button class="ts_search_btn" type="button" id="searchInputBtn"><?php echo $this->ts_functions->getlanguage('searchtext','homepage','solo');?></button>
						</span>
					</div>
				</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ts_bottompadder50">
				<a href="<?php echo $basepath;?>home/products" class="ts_btn"><?php echo $this->ts_functions->getlanguage('topbutton','homepage','solo');?></a>
			</div>
		</div>
	</div>
</div>
<!-- Slider wrappe End -->

<!-- Content wrapper Start -->
<div class="ts_single_theme_wrapper ts_bottompadder50">
	<div class="container">
		<div class="row">

		    <?php if(!empty($featuredprod)) {
		        $prodName = $this->ts_functions->getProductName($featuredprod[0]['prod_id']);
		        if( $featuredprod[0]['prod_image'] != '' ) {
					$image_a = explode('.',$featuredprod[0]['prod_image']);
					$dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
					$img_style = '';
		        }
		        else {
		        	$dis_img = '';
		        	$img_style = 'style="width:394px;height:210px;"';
		        }
		    ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_single_theme_box">
					<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
						<div class="ts_single_theme_box_img">
							<a href="<?php echo $basepath;?>item/<?php echo $prodName.$featuredprod[0]['prod_uniqid'];?>"><img src="<?php echo $dis_img != '' ? $basepath.'repo/images/'.$dis_img : $basepath.'adminassets/images/white_image.jpeg' ; ?>" title="<?php echo $featuredprod[0]['prod_name'];?>" class="img-responsive" <?php echo $img_style; ?>></a>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
					    <?php
                            $catename = strtolower($featuredprod[0]['cate_urlname']);
                            $catename = str_replace(' ','-',$catename);
                            $catename = preg_replace('!-+!', '-', $catename);
					    ?>
						<div class="ts_single_theme_box_detail">
							<h3><?php echo $featuredprod[0]['prod_name'];?></h3>
							<h5><a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo $featuredprod[0]['cate_name'];?> </a></h5>
							<p><?php echo substr(strip_tags($featuredprod[0]['prod_description']),0,150).' ...';?> </p>
							<ul>
							<?php
							if( $featuredprod[0]['prod_free'] == '0') {
                                if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {

                                $purDetail = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_prodid'=>$featuredprod[0]['prod_id']));

                                ?>
                                    <li><i class="fa fa-money" aria-hidden="true"></i> <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?> <?php echo $featuredprod[0]['prod_price'];?> <span>price</span> </li>

                                    <?php if($this->ts_functions->getsettings('showfeaturedsales','checkbox') == '1' ) { ?>
                                    <li><i class="fa fa-cart-plus" aria-hidden="true"></i> <?php echo count($purDetail);?> <span><?php echo $this->ts_functions->getlanguage('salestext','commontext','solo');?></span> </li>
                                    <?php } ?>

                                <?php }
							    } ?>

							</ul>
							<div class="ts_share_box">
		<a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'item/'.$prodName.$featuredprod[0]['prod_uniqid']);?>"
								 class="pull-left" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> </a>
								<a href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'item/'.$prodName.$featuredprod[0]['prod_uniqid']);?>&text=<?php echo urlencode($featuredprod[0]['prod_name']);?>" class="pull-left" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> </a>
							</div>
                            <?php if( $featuredprod[0]['prod_free'] == '0') {
                                if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) { ?>
                                    <a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $featuredprod[0]['prod_uniqid'];?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?></a>
                                <?php } else { ?>
                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $featuredprod[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> </a>
                                <?php }
							} else { ?>
							    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $featuredprod[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?> </a>
							<?php } ?>
						
						<?php 
						 if( is_numeric(stripos($featuredprod[0]['prod_demourl'],'http'))) { 
							if( is_numeric(stripos($featuredprod[0]['prod_demourl'],'https:'))) { 
						  ?>
							<a href="<?php echo $featuredprod[0]['prod_demourl'];?>" class="ts_btn pull-left"  target="_blank"><?php echo $this->ts_functions->getlanguage('livedemotab','homepage','solo');?></a>
						<?php } else { ?>
							<a href="<?php echo $basepath;?>item/<?php echo $prodName.'live_demo/'.$featuredprod[0]['prod_uniqid'];?>" class="ts_btn pull-left" target="_blank"><?php echo $this->ts_functions->getlanguage('livedemotab','homepage','solo');?></a>
						<?php } } ?>
						
						</div>
					</div>
					<div class="rs_tag_box" style="background: #<?php echo $this->ts_functions->getsettings('featuredcolor','code');?>"><?php echo $this->ts_functions->getlanguage('featuredbox','homepage','solo');?></div>
				</div>
			</div>
			<?php } ?>

            <?php if(!empty($productdetails)) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_heading ts_toppadder50 ts_bottompadder50">
					<h3><?php echo $this->ts_functions->getlanguage('ourlatestthemetext','homepage','solo');?></h3>
					<p><?php echo $this->ts_functions->getlanguage('latestsubheading','homepage','solo');?></p>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_theme_filter_wrapper">
					<ul>
                    <?php
                        echo '<li><a class="cateCls ts_cate_active" id="0">'.$this->ts_functions->getlanguage('alltext','homepage','solo').'</a></li>';
                        foreach($categoryList as $soloCate) {
                            if( $this->ts_functions->getsettings('dontshow','emptycate') == '1' ) {
                                $checkProd = $this->DatabaseModel->access_database('ts_products','select','',array('prod_cateid'=>$soloCate['cate_id']));

                                echo  !empty($checkProd) ? '<li><a class="cateCls" id="'.$soloCate['cate_id'].'" >'.$soloCate['cate_name'].'</a></li>' : '';
                            }
                            else{
                                echo '<li><a class="cateCls" id="'.$soloCate['cate_id'].'" >'.$soloCate['cate_name'].'</a></li>';
                            }
                        }
                    ?>
					</ul>
				</div>
			</div>

                <div class="hideme" id="inside_loader">
                    <img src="<?php echo $this->ts_functions->getsettings('preloader','url');?>" alt="loading" />
                </div>
                <div class="LatestThemeDiv">
                    <?php foreach($productdetails as $soloProd) {
                        $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
                       
		        		if( $soloProd['prod_image'] != '' ) {
							$image_a = explode('.',$soloProd['prod_image']);
							$dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
							$img_style = '';
						}
						else {
							$dis_img = '';
							$img_style = 'style="width:360px;height:192px;"';
						}
				
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <div class="ts_theme_boxes">
                            <div class="ts_theme_boxes_img">
                                <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>"> <img src="<?php echo $dis_img != '' ? $basepath.'repo/images/'.$dis_img : $basepath.'adminassets/images/white_image.jpeg' ; ?>" title="<?php echo $soloProd['prod_name'];?>" <?php echo $img_style; ?> > </a>
                            </div>
                            <!--<span><?php echo $soloProd['cate_name'];?></span>-->
                            <div class="ts_theme_boxes_info">
                                <div class="ts_theme_details">
                                    <h4><?php echo $soloProd['prod_name'];?></h4>
                                    <?php
                                        $catename = strtolower($soloProd['cate_urlname']);
                                        $catename = str_replace(' ','-',$catename);
                                        $catename = preg_replace('!-+!', '-', $catename);

                                        $vendorName = $this->ts_functions->getVendorName($soloProd['prod_uid']);
                                    ?>
                                    <p> <a href="<?php echo $basepath;?>vendor/<?php echo $vendorName;?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo ucfirst($vendorName);?></a> <a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo strtoupper($soloProd['cate_name']);?></a></p>
                                </div>
                                <div class="ts_theme_price">

                                <?php if( $soloProd['prod_free'] == '0') {
                                /*** buy now section ***/
                                    if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) { ?>
                                        <a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $soloProd['prod_uniqid'];?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloProd['prod_uniqid'];?>" class="ts_price"><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?> <?php echo $soloProd['prod_price'];?></a>
                                    <?php }
                                } else {
                                    // Free
                                ?>
                                    <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $soloProd['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?> </a>
                                <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
			<?php } ?>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ts_toppadder30">
		<div class="ts_loadmore_btn">
	<a href="<?php echo $basepath;?>home/products" class="ts_btn"><?php echo $this->ts_functions->getlanguage('viewmoretext','commontext','solo');?></a>
		</div>
	</div>
</div>
<!-- Content wrapper End -->
<?php if(!empty($testi_details)) { ?>
<!-- Client say wrapper Start -->
<div class="ts_client_say_wrapper ts_bottompadder50">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_heading ts_toppadder50 ts_bottompadder50">
					<h3><?php echo $this->ts_functions->getlanguage('ourclientsaystext','homepage','solo');?></h3>
					<p><?php echo $this->ts_functions->getlanguage('ourclientssubtext','homepage','solo');?></p>
				</div>
			</div>

			<?php
			    if( count($testi_details) > 1 ) {
			?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_client_say_slider">
					<div id="owl-demo" class="owl-carousel owl-theme">
					<?php  foreach($testi_details as $solotesti) {
					?>
						<div class="item">
							<div class="ts_testimonial_data">
							<p><?php echo $solotesti['testi_msg'];?></p>
							 <?php if( $solotesti['testi_image'] != '' ) { ?>
							<img src="<?php echo $basepath;?>webimage/<?php echo $solotesti['testi_image'];?>" alt="<?php echo $solotesti['testi_name'];?>">
							<?php } else { ?>
							<img src="<?php echo $basepath;?>webimage/dummy_testi.jpg" alt="<?php echo $solotesti['testi_name'];?>">
							<?php } ?>
							<h5><?php echo $solotesti['testi_name'];?></h5>
							<?php if($solotesti['testi_showdesig'] == '1') { ?>
							<span><?php echo $solotesti['testi_desig'];?></span>
							<?php } ?>
							</div>
						</div>

					<?php } ?>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_client_say_slider">
				    <div class="ts_testimonial_data">
                        <p><?php echo $testi_details[0]['testi_msg'];?></p>
                        <img src="<?php echo $basepath;?>webimage/<?php echo $testi_details[0]['testi_image'];?>" alt="<?php echo $testi_details[0]['testi_name'];?>">
                        <h5><?php echo $testi_details[0]['testi_name'];?></h5>
                        <?php if($testi_details[0]['testi_showdesig'] == '1') { ?>
                        <span><?php echo $testi_details[0]['testi_desig'];?></span>
                        <?php } ?>
                    </div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</div>
<!-- Client say wrapper End -->
<?php } ?>

<?php if( $this->ts_functions->getsettings('shownewsletter','checkbox') == '1' ) { ?>
<!-- Newsletter wrapper Start -->
<div class="ts_newsletter_wrapper ts_toppadder40 ts_bottompadder40" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="400">
<?php if( $this->ts_functions->getsettings('homepageoverlayshow','checkbox') == '1' ) { ?>
	<div class="ts_overlay" style="background-color:#<?php echo $this->ts_functions->getsettings('homepageoverlay','color');?>;opacity:<?php echo $this->ts_functions->getsettings('homepageoverlay','opacity');?>;"></div>
<?php } ?>
	<div class="container-fluid">
		<div class="row">
			<h2><?php echo $this->ts_functions->getlanguage('newsletterheading','homepage','solo');?></h2>
			<h4><?php echo $this->ts_functions->getlanguage('newslettersubheading','homepage','solo');?></h4>
			<form>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
					<div class="input-group ts_search_field">
						<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('newsletterplaceholder','homepage','solo');?>" id="email_from_newsletter">
						<span class="input-group-btn">
							<button class="ts_search_btn" type="button" onclick="subscribe_email('newsletter')"><?php echo $this->ts_functions->getlanguage('newsletterbutton','homepage','solo');?></button>
						</span>
					</div>
					<p class="ts_subsvribe_msg"><sup>*</sup> <?php echo $this->ts_functions->getlanguage('newsletterinfo','homepage','solo');?></p>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Newsletter wrapper End -->
<?php } ?>

<!-- Language Content STARTS -->
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('newslettersuc','message','solo');?>" id="newslettersucsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('newslettererr','message','solo');?>" id="newslettersucerr_text">
<!-- Language Content ENDS -->
