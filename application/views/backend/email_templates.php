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
													Basic email settings
												</a>
											</h4>
										</div>
										<div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="four">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                    <div class="th_registration_msg">
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show logo in email</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="email_logoshow" value="1" <?php echo $this->ts_functions->getsettings('email','logoshow') == '1' ? 'checked' : '' ; ?> >
                                    <label for="email_logoshow"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>From name</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="email_fromname" value="<?php echo $this->ts_functions->getsettings('email','fromname');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>From email</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="email_fromemail" value="<?php echo $this->ts_functions->getsettings('email','fromemail');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Reply-To email </label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="email_replytoshow" value="1" <?php echo $this->ts_functions->getsettings('email','replytoshow') == '1' ? 'checked' : '' ; ?> >
                                    <label for="email_replytoshow"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Reply-to email</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="email_replyemail" value="<?php echo $this->ts_functions->getsettings('email','replyemail');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Email on which you wish to receive Contact page  queries / support </label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="email_contactemail" value="<?php echo $this->ts_functions->getsettings('email','contactemail');?>">
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateEmailtemplates('email')" class="btn theme_btn">UPDATE</a>
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
													Registration Template
												</a>
											</h4>
										</div>
										<div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="one">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use below shortcodes.</p>
                        </div>
						<div class="th_shortcode_wrapper">
                            <p> [username] : To use Registered User's Name </p>
                            <p> [linktext] : Activation link will appear here</p>
                            <p> [break] : To break the line</p>
						</div>
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use above shortcodes.</p>
                        </div>
                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Template text</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows='8' class="form-control" id="registrationemail_text"><?php echo $this->ts_functions->getsettings('registrationemail','text');?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Activation link text</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="registrationemail_linktext" value="<?php echo $this->ts_functions->getsettings('registrationemail','linktext');?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="th_btn_wrapper">
                                <a onclick="updateEmailtemplates('registrationemail')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6">
							<div class="th_send_msg">
								<input type="text" class="form-control" id="registrationemail_emailinput"  placeholder="Enter email to send a test email.">
								<a onclick="sendTestEmails('registrationemail')" class="btn theme_btn">send<i class="fa fa-paper-plane" aria-hidden="true"></i></a>
							</div>
                        </div>

                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>




									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="three">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion3" aria-expanded="true" aria-controls="accordion3" class="collapsed">
													Forgot Password Template
												</a>
											</h4>
										</div>
										<div id="accordion3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="three">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use below shortcodes.</p>
                        </div>
						<div class="th_shortcode_wrapper">
							<p> [username] : To use User's Name </p>
							<p> [linktext] : Reset password link will appear here</p>
							<p> [break] : To break the line</p>
						</div>
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use above shortcodes.</p>
                        </div>
                     <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Template text</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows='8' class="form-control" id="forgotpwdemail_text"><?php echo $this->ts_functions->getsettings('forgotpwdemail','text');?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Forgot password link text</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control" id="forgotpwdemail_linktext" value="<?php echo $this->ts_functions->getsettings('forgotpwdemail','linktext');?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="th_btn_wrapper">
                                <a onclick="updateEmailtemplates('forgotpwdemail')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6">
							<div class="th_send_msg">
								<input type="text" class="form-control" id="forgotpwdemail_emailinput" placeholder="Enter email to send a test email.">
								<a onclick="sendTestEmails('forgotpwdemail')" class="btn theme_btn">send<i class="fa fa-paper-plane" aria-hidden="true"></i></a>
							</div>
                        </div>

                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="seven">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion7" aria-expanded="true" aria-controls="accordion7" class="collapsed">
													Add New User Template
												</a>
											</h4>
										</div>
										<div id="accordion7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="seven">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use below shortcodes.</p>
                        </div>
						<div class="th_shortcode_wrapper">
							<p> [username] : User's Name </p>
							<p> [password] : Password</p>
							<p> [website_link] : Website link</p>
							<p> [break] : To break the line</p>
						</div>
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Use above shortcodes.</p>
                        </div>
                     <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Template text</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows='8' class="form-control" id="addnewuseremail_text"><?php echo $this->ts_functions->getsettings('addnewuseremail','text');?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="th_btn_wrapper">
                                <a onclick="updateEmailtemplates('addnewuseremail')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6">
							<div class="th_send_msg">
								<input type="text" class="form-control" id="addnewuseremail_emailinput" placeholder="Enter email to send a test email.">
								<a onclick="sendTestEmails('addnewuseremail')" class="btn theme_btn">send<i class="fa fa-paper-plane" aria-hidden="true"></i></a>
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
