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
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_theme_filter_wrapper">
					<ul>
                    <?php
                        echo '<li><a href="'.$basepath.'home/products" >'.$this->ts_functions->getlanguage('alltext','homepage','solo').'</a></li>';
                        foreach($categoryList as $soloCate) {

                            if( $this->ts_functions->getsettings('dontshow','emptycate') == '1' ) {
                                $catename = strtolower($soloCate['cate_urlname']);
                                $catename = str_replace(' ','-',$catename);
                                $catename = preg_replace('!-+!', '-', $catename);

                                $checkProd = $this->DatabaseModel->access_database('ts_products','select','',array('prod_cateid'=>$soloCate['cate_id']));

                                echo  !empty($checkProd) ? '<li><a href="'.$basepath.'home/products/'.$catename.'" >'.$soloCate['cate_name'].'</a></li>' : '';
                            }
                            else{
                                $catename = strtolower($soloCate['cate_urlname']);
                                $catename = str_replace(' ','-',$catename);
                                $catename = preg_replace('!-+!', '-', $catename);

                                echo '<li><a href="'.$basepath.'home/products/'.$catename.'" >'.$soloCate['cate_name'].'</a></li>';
                            }
                        }
                    ?>
					</ul>
				</div>
			</div>
			 <?php 
			 if( !empty($productdetails) ) {
			 foreach($productdetails as $soloProd) {
                $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
                $vendorName = $this->ts_functions->getVendorName($soloProd['prod_uid']);
                $image_a = explode('.',$soloProd['prod_image']);
		        $dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
            ?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="ts_theme_boxes">
					<div class="ts_theme_boxes_img">
						<a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>"><img src="<?php echo $basepath;?>repo/images/<?php echo $dis_img;?>" title="<?php echo $soloProd['prod_name'];?>" /></a>
					</div>
					<div class="ts_theme_boxes_info">
						<div class="ts_theme_details">
							 <h4><?php echo $soloProd['prod_name'];?></h4>
                                    <p> <a href="<?php echo $basepath;?>vendor/<?php echo $vendorName;?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo ucfirst($vendorName);?></a> <a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo $soloProd['cate_name'];?></a>
                                    <?php if( $soloProd['prod_free'] == '0') {
                                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
                                        $plan_str = '';
                                        if($soloProd['prod_plan'] != '') {
                                            $plan_id = explode(',',$soloProd['prod_plan']);
                                            $plan_res = $this->DatabaseModel->access_database('ts_plans','wherein',$plan_id,'','plan_id');

                                            if(!empty($plan_res)) {
                                                foreach($plan_res as $solo_plan){
                                                    $plan_str .= $solo_plan['plan_name'].',';
                                                }
                                            }
                                        }
                                    if( $plan_str != '' ) {
                                    ?>
                                    <a title="Plan" href="<?php echo $basepath;?>shop/checkmembership/<?php echo $soloProd['prod_uniqid'];?>"><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo rtrim($plan_str,',');?></a>
                                    <?php } } } ?>
                                     </p>
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

			<?php } } else { ?>
			<!-- 404 Page STARTS -->
			
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<img src="<?php echo $this->ts_functions->getsettings('notfoundimg','url');?>" alt="Oops , there is nothing to show" title="Oops , there is nothing to show">
			</div>
			
			
			<!-- 404 Page ENDS -->
			<?php } ?>
			<div class="ts_pagination">
				<?php echo (isset($pagination_buttons))?$pagination_buttons:''; ?>
			</div>
		</div>
	</div>
</div>
<!-- Content wrapper End -->
