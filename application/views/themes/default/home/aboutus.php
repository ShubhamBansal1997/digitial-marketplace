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
					<h3><?php echo $this->ts_functions->getlanguage('abouttext','menus','solo'); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- About Us Wrapper wrapper Start -->
<div class="ts_aboutus_wrapper ts_toppadder100 ts_bottompadder80">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_aboutus_info_section">
					<h3><?php echo $pageContent[0]['page_heading'];?></h3>
					
					<?php echo $pageContent[0]['page_content'];?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- About Us Wrapper wrapper End -->
