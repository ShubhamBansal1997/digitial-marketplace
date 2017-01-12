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
                                                Facebook 
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="four">
                                        <div class="panel-body">

            <div class="alert alert-info th_setting_text">
                <!--<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Must Do</strong> Please enable the IPN in your paypal account</p><br/>-->
                <p><strong>How to get started</strong></p><br/>
                <p>1) Follow this <a href="https://developers.facebook.com/docs/apps/register" target="_blank">link</a> OR use <b>https://developers.facebook.com/docs/apps/register</b> to create your first App , and get your App Id and App Secret.</p><br/>
                <p>2) For " Choose Platform " , choose " Website ".</p><br/><br/>
                <p>Once you are done with creating App, go to " Settings " tab</p><br/>
                <p>1) Put domain name, your email and site url in fields asking for App Domains , Contact Email and Site URL , respectively.</p>
				<br/><br/>
				<p>Then go to " App Review " tab, and make your App public.</p>
				<br/><br/>
				<p>Finally copy  App Id and App Secret from " Settings - Basic " tab.</p>
            </div>

                                            <div class="col-lg-12 col-md-12">
                <div class="th_registration_wrapper">
                <div class="th_registration_msg">

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Show Facebook option to users</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="th_checkbox">
                                <input type="checkbox" id="facebook_status" class="facebookSettings" value="1" <?php echo $this->ts_functions->getsettings('facebook','status') == '1' ? 'checked' : '' ; ?>>
                                <label for="facebook_status"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>App Id</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control facebookSettings" id="facebook_appid" value="<?php echo $this->ts_functions->getsettings('facebook','appid');?>">
                        </div>
                    </div>
					
					<div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>App Secret</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control facebookSettings" id="facebook_appsecret" value="<?php echo $this->ts_functions->getsettings('facebook','appsecret');?>">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <a onclick="updatePaymentSettings('facebookSettings')" class="btn theme_btn">UPDATE</a>
                        </div>
                    </div>

                </div>

                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="one">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion1" aria-expanded="true" aria-controls="accordion1" class="collapsed">
													Google +
												</a>
											</h4>
										</div>
										<div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="one">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                         <div class="alert alert-info th_setting_text">
							<!--<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Must Do</strong> Please enable the IPN in your paypal account</p><br/>-->
							<p><strong>How to get started</strong></p><br/>
							<p>1) Follow this <a href="https://developers.google.com/identity/sign-in/web/devconsole-project" target="_blank">link</a> OR use <b>https://developers.google.com/identity/sign-in/web/devconsole-project</b> to create your first Google API Console project , and get your Client Id and Client Secret.</p><br/>
							<br/>
							<p>Once you are done with creating a project, go to " Credentials " tab , click on your project name , which you have just created.</p><br/>
							<p>1) Copy your domain name with http:// or https:// , and put it in " Authorized JavaScript origins " field.</p><br/>
							<p>2) Copy this url <b><?php echo base_url();?>authenticate/googlelogin</b>, and put it in " Authorized redirect URIs " field.</p><br/>
							<p>3) Click Save.</p><br/>
							<p>4) Copy the Client ID and Client secret, which is under " Credentials " tab.</p>
						</div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Google+ option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="google_status" class="googleSettings" value="1"  <?php echo $this->ts_functions->getsettings('google','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="google_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Client Id</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control googleSettings" id="google_clientid" value="<?php echo $this->ts_functions->getsettings('google','clientid');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Client Secret</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control googleSettings" id="google_clientsecret" value="<?php echo $this->ts_functions->getsettings('google','clientsecret');?>">
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('googleSettings')" class="btn theme_btn">UPDATE</a>
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
			</div>
		</div>
	</div>
	<!-- user content section -->
</div>
