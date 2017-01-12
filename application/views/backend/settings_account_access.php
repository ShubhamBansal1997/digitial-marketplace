<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">

        <div class="theme_panel_section">
            <div class="panel-group theme_panel" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="one">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
                                Account Access Settings
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">

                                <div class="form-group">
                                        <div class="col-lg-6 col-md-6">
                                            <label> Show Login Link </label>
                                        </div>

                                        <div class="col-lg-3 col-md-3">
                                            <div class="th_checkbox">
                                                <input type="checkbox" id="loginhome_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('loginhome','checkbox') == '1' ? 'checked' : '' ; ?>>
                                                <label for="loginhome_checkbox"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
									<div class="col-lg-6 col-md-6">
										<label> Show SignUp Link </label>
									</div>

									<div class="col-lg-3 col-md-3">
										<div class="th_checkbox">
											<input type="checkbox" id="registerhome_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('registerhome','checkbox') == '1' ? 'checked' : '' ; ?>>
											<label for="registerhome_checkbox"></label>
										</div>
									</div>
								</div>
								
								 <div class="form-group">
									<div class="col-lg-6 col-md-6">
										<label> Show FaceBook Login on Cart Page </label>
									</div>

									<div class="col-lg-3 col-md-3">
										<div class="th_checkbox">
											<input type="checkbox" id="fbcartlogin_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('fbcartlogin','checkbox') == '1' ? 'checked' : '' ; ?>>
											<label for="fbcartlogin_checkbox"></label>
										</div>
									</div>
								</div>

								 <div class="form-group">
									<div class="col-lg-6 col-md-6">
										<label> Show Google Login on Cart Page </label>
									</div>

									<div class="col-lg-3 col-md-3">
										<div class="th_checkbox">
											<input type="checkbox" id="googlecartlogin_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('googlecartlogin','checkbox') == '1' ? 'checked' : '' ; ?>>
											<label for="googlecartlogin_checkbox"></label>
										</div>
									</div>
								</div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="th_btn_wrapper">
                                        <a onclick="updateSettings('settingsfields')" class="btn theme_btn">UPDATE</a>
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
