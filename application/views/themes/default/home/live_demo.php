<!-- Header End -->
<body>
<!-- Preview Freame Start -->
<div class="ts_preview_freame_wrapper">
	<div class="ts_preview_freame_header ts_toppadder10 ts_bottompadder10">
		<div class="ts_preview_freame_logo">
			<a href="<?php echo $basepath;?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"> </a>
		</div>
		<?php if(!empty($remainigProducts)) { ?>
		<div class="ts_preview_freame_option">
			<ul>
				<li>
					<a><?php echo $this->ts_functions->getlanguage('selectproduct','homepage','solo'); ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
						<ul>
						    <?php foreach($remainigProducts as $soloProduct) {
						        $prodName = $this->ts_functions->getProductName($soloProduct['prod_id']);
						    ?>
							<li><a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProduct['prod_uniqid'];?>" target="_blank"><?php echo $soloProduct['prod_name']; ?><span><?php echo $soloProduct['cate_name']; ?></span></a></li>
							<?php } ?>
						</ul>
				</li>
			</ul>
		</div>
		<?php } ?>
		<div class="ts_preview_freame_btns">

			<ul>
				<li>
				<?php if( $productdetails[0]['prod_free'] == '0') {
                    if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) { ?>
                        <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> - <?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> </a>
                    <?php } else { ?>
                        <a href="<?php echo $basepath;?>shop/checkmembership/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('buynowtab','homepage','solo');?> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> </a>
                <?php   }
                    } else {
                        // Free
                    ?>
                        <a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> </a>

                <?php } ?>
                </li>

                <li><a href="<?php echo $productdetails[0]['prod_demourl'];?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('removeframe','commontext','solo'); ?>  <i class="fa fa-close" aria-hidden="true"></i> </a></li>
			</ul>
		</div>
	</div>
	<iframe src="<?php echo $productdetails[0]['prod_demourl'];?>"></iframe>
</div>
<!-- Preview Freame End -->
