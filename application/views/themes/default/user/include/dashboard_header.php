<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $pageHeading;?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Profile wrapper Start -->
<div class="ts_profile_wrapper ts_toppadder100 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_info_menu">
				<?php
				    if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
				        $mCls = 'ts_3_menu';
				    }
				    else {
				        $mCls = '';
				    }
				?>
					<ul class="<?php echo $mCls;?>">

						<li><a class="<?php echo isset($purchase_active) ? $purchase_active : '' ;?>" href="<?php echo $basepath;?>dashboard/purchased"><?php echo $this->ts_functions->getlanguage('paiddowntext','menus','solo'); ?> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></li>

						<li><a class="<?php echo isset($download_active) ? $download_active : '' ;?>" href="<?php echo $basepath;?>dashboard/free_downloads"><?php echo $this->ts_functions->getlanguage('freedowntext','menus','solo'); ?> <i class="fa fa-cloud-download" aria-hidden="true"></i></a></li>

						<?php if($mCls == '') { ?>
						<li><a class="<?php echo isset($plans_active) ? $plans_active : '' ;?>" href="<?php echo $basepath;?>dashboard/subscription"><?php echo $this->ts_functions->getlanguage('substext','menus','solo'); ?> <i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
						<?php } ?>

						<li><a class="<?php echo isset($profile_active) ? $profile_active : '' ;?>" href="<?php echo $basepath;?>dashboard/profile"><?php echo $this->ts_functions->getlanguage('profiletext','menus','solo'); ?> <i class="fa fa-user" aria-hidden="true"></i></a></li>
					</ul>
				</div>
