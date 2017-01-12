<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $this->ts_functions->getlanguage('contacttext','menus','solo'); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- Contact wrapper Start -->
<div class="ts_contact_wrapper ts_toppadder100 ts_bottompadder100">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="ts_contact_form">
					<h3><?php echo $this->ts_functions->getlanguage('headingsupporttext','commontext','solo'); ?></h3>
					<!--<p>We have a great team for supporting our customers. fill the form to a get great support</p>-->
						<div class="row">
						<?php if(!isset($this->session->userdata['ts_uid'])) { ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<input type="text" class="form-control validate" placeholder="<?php echo $this->ts_functions->getlanguage('yourname','commontext','solo'); ?>" id="name">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<input type="text" class="form-control validate" placeholder="<?php echo $this->ts_functions->getlanguage('youremail','commontext','solo'); ?>" id="email">
							</div>
						</div>
						<?php } ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<textarea class="form-control validate" rows="6" placeholder="<?php echo $this->ts_functions->getlanguage('yourmsgtext','commontext','solo'); ?>" id="msg"></textarea>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ts_login_btn_field">
								<a onclick="sendcontactform(this);" class="ts_btn"><?php echo $this->ts_functions->getlanguage('sendtext','commontext','solo'); ?> <i class="fa fa-rocket" aria-hidden="true"></i></a>
							</div>
						</div>
						</div>
				</div>
			</div>
			<input type="hidden" id="sendtext" value="<?php echo $this->ts_functions->getlanguage('sendtext','commontext','solo'); ?>">
			<input type="hidden" id="waittext" value="<?php echo $this->ts_functions->getlanguage('waittext','commontext','solo'); ?>">

			<div class="col-lg-4 col-md-4 col-sm-0 col-xs-12">
				<div class="ts_suppport_img">
					<img src="<?php echo $basepath;?>themes/default/images/web/support.png" alt="Support" title="Support">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact wrapper End -->
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('contactsuc','message','solo');?>" id="contactsuc_text">
