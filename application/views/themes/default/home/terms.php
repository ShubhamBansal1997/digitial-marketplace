    <?php
        if( empty($pageContent)){
            redirect(base_url());
        }
    ?>
<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3>Terms & Conditions</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Terms & Conditions Wrapper wrapper Start -->
<div class="ts_terms_wrapper ts_toppadder100 ts_bottompadder80">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_terms_info_section">
					<h3><?php echo $pageContent[0]['page_heading'];?></h3>
					<br/><br/><br/>
					<?php echo $pageContent[0]['page_content'];?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Terms & Conditions Wrapper wrapper End -->