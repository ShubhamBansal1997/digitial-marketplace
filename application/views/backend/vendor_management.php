<div class="main_body">
	<!-- user content section -->
	<div class="theme_wrapper">
		<div class="container-fluid">
			<div class="theme_section">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="theme_page">
							<div class="theme_panel_section">


								<div class="panel-group theme_panel" id="accordion5" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="four">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
                                                Vendor's Terms &amp; Conditions
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="four">
                                        <div class="panel-body">

            <div class="alert alert-info th_setting_text">
                <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Separate each terms by pressing Enter key</p>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="th_registration_wrapper">

                <form action="" method="post">
                <div class="th_registration_msg">

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Show Terms &amp; Conditions</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="th_checkbox">
                                <input type="checkbox" id="vendor_tncstatus" name="vendor_tncstatus" value="1" <?php echo $this->ts_functions->getsettings('vendor','tncstatus') == '1' ? 'checked' : '' ; ?>>
                                <label for="vendor_tncstatus"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Terms &amp; Conditions Text</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <textarea class="form-control" rows="6" name="vendor_tnctext"><?php echo $this->ts_functions->getsettings('vendor','tnctext');?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <input type="submit" value="UPDATE" class="btn theme_btn">
                        </div>
                    </div>

                </div>
                </form>

                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- user content section -->
</div>
<?php $_SESSION['ts_success'] = "";?>
