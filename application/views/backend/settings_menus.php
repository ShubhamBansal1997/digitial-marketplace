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
                                Menus
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">

                            <h3 class="th_subheading"> Check / Uncheck to make Menu's visible or not </h3>

                                <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label> Home </label>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="th_checkbox">
                                                <input type="checkbox" id="menuHome_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuHome','checkbox') == '1' ? 'checked' : '' ; ?>>
                                                <label for="menuHome_checkbox"></label>
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> About Us </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuAboutUs_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuAboutUs','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuAboutUs_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Products </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuProducts_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuProducts','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuProducts_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Plans</label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuPricingtbl_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuPricingtbl','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuPricingtbl_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Contact Us </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuContactUs_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuContactUs','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuContactUs_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Support </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuSupport_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuSupport','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuSupport_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Terms &amp; Conditions </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuTnC_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuTnC','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuTnC_checkbox"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-3 col-md-3">
                                        <label> Privacy Policy </label>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="th_checkbox">
                                            <input type="checkbox" id="menuPrivacy_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('menuPrivacy','checkbox') == '1' ? 'checked' : '' ; ?>>
                                            <label for="menuPrivacy_checkbox"></label>
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
