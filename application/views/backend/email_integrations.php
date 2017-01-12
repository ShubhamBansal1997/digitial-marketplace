<div class="modal fade theme_modal" id="connectemails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
		  <div class="add_user_form">

			<!-- Mailchimp -->
			<div class="common_form hideme" id="Mailchimp_form" >
                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>API Key</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control Mailchimp_cls" id="Mailchimp_apikey" />
                        <a class="input_help_info" href="http://admin.mailchimp.com/account/api" target="_blank"> Where to get that ? </a>
                    </div>
                </div>
            </div>
             <!-- Mailchimp -->

             <!-- GetResponse -->
             <div class="common_form hideme" id="GetResponse_form" >
                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>API Key</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control GetResponse_cls" id="GetResponse_apikey" />
                        <a class="input_help_info" href="http://support.getresponse.com/faq/where-i-find-api-key" target="_blank"> Where to get that ? </a>
                    </div>
                </div>
            </div>
             <!-- GetResponse -->

             <!-- ConstantContact -->
             <div class="common_form hideme" id="ConstantContact_form" >
                <div class="form-group">
                    <div class="col-lg-3 col-md-3">
                        <label>User Email</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control ConstantContact_cls" id="ConstantContact_uname" />
                        <a class="input_help_info" href="https://www.constantcontact.com/signup.jsp" target="_blank"> Get one now ? </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3 col-md-3">
                        <label>Password</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control ConstantContact_cls" id="ConstantContact_pwd" />
                    </div>
                </div>
            </div>
             <!-- ConstantContact -->

             <!-- Aweber -->
             <div class="common_form hideme" id="Aweber_form" >
                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>Code</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control Aweber_cls" id="Aweber_code" />
                    <a class="input_help_info" href="https://auth.aweber.com/1.0/oauth/authorize_app/9270db74" target="_blank"> Where to get that ? </a>
                    </div>
                </div>
            </div>
             <!-- Aweber -->

             <!-- Sendinblue -->
            <div class="common_form hideme" id="Sendinblue_form" >

                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>API Key</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control Sendinblue_cls" id="Sendinblue_apikey" />
                    </div>
                </div>
            </div>
             <!-- Sendinblue -->

             <!-- Freshmail -->
            <div class="common_form hideme" id="Freshmail_form" >

                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>API Key</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control Freshmail_cls" id="Freshmail_apikey" />
                    </div>
                </div>

                <div class="form-group" >
                    <div class="col-lg-3 col-md-3">
                        <label>API Secret</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control Freshmail_cls" id="Freshmail_apisecret" />
                    </div>
                </div>
            </div>
             <!-- Freshmail -->
             
              <!-- ActiveCampaign -->
            <div class="common_form hideme" id="ActiveCampaign_form" >
            
				<div class="form-group" >
					<div class="col-lg-3 col-md-3">
						<label>API Url</label>
					</div>
					<div class="col-lg-9 col-md-9">
						<input type="text" placeholder="API Url" id="ActiveCampaign_apiurl" class="form-control ActiveCampaign_cls"/>
						 <a class="input_help_info" href="http://www.activecampaign.com/help/using-the-api/" target="_blank" >Find your API URL here</a>
					 </div>
                </div>
                
                <div class="form-group" >
					<div class="col-lg-3 col-md-3">
						<label>API Key</label>
					</div>
					<div class="col-lg-9 col-md-9">
						<input type="text" placeholder="API Key" id="ActiveCampaign_apikey" class="form-control ActiveCampaign_cls"/>
						<a class="input_help_info" href="http://www.activecampaign.com/help/using-the-api/" target="_blank">Find your API Key here</a>
					</div>
				</div>
				
			</div>
             <!-- ActiveCampaign -->
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
        <button type="button" class="btn theme_btn" onclick="emailintegration_fun()">Connect</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade theme_modal" id="dis_connectemails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Disconnect</h4>
      </div>
      <div class="modal-body">
		  <div class="add_user_form">
           
				<div class="form-group" >
					<div class="col-lg-12 col-md-12">
						<p id="dis_message" style="color: red;text-align: center;"> </p>
					</div>
                </div>
                
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">No, Leave it</button>
        <button type="button" class="btn theme_btn dis_btn" onclick="">Yes, I want to</button>
      </div>
    </div>
  </div>
</div>



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
										<div class="panel-heading" role="tab">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion1" aria-expanded="true" aria-controls="accordion1">
													Connect
												</a>
											</h4>
										</div>
										<div id="accordion1" class="panel-collapse collapse in" role="tabpanel">
											<div class="panel-body">
												<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
												    <div class="th_mail_btn">

				<?php
					if( count($left_responders) > 0 ) {
						foreach ($left_responders as $solo_left_respond) {
						?>
								<div class="mail_icon_wrapper">
								<a href="javascript:;" class="mail_icon" id="<?php echo $solo_left_respond;?>">
									<img src="<?php echo $basepath; ?>adminassets/images/email_icons/<?php echo $solo_left_respond.'.png';?>" alt="" />

									<span class="mailchimp_connect" onclick="openEmailIntePopup('<?php echo $solo_left_respond;?>')">Connect</span>
								</a>
								<p><?php echo $solo_left_respond;?></p>
								</div>
					   <?php  }
					}
				?>
												</div>
										        </div>
											</div>
										</div>
									</div>
									
									
									<div class="panel panel-default">
										<div class="panel-heading" role="tab">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion3" aria-expanded="false" aria-controls="accordion3">
												  Disconnect
												</a>
											</h4>
										</div>
            <div id="accordion3" class="panel-collapse collapse" role="tabpanel">
                <div class="panel-body">
												<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
												    <div class="th_mail_btn">

				<?php
					if( count($connect_resp) > 0 ) {
						foreach ($connect_resp as $solo_connect_respond) {
						?>
								<div class="mail_icon_wrapper">
								<a href="javascript:;" class="mail_icon" id="<?php echo $solo_connect_respond;?>">
									<img src="<?php echo $basepath; ?>adminassets/images/email_icons/<?php echo $solo_connect_respond.'.png';?>" alt="" />

									<span class="mailchimp_connect" onclick="openDisconnectPopup('<?php echo $solo_connect_respond;?>')">Disconnect</span>
								</a>
								<p><?php echo $solo_connect_respond;?></p>
								</div>
					   <?php  }
					}
				?>
												</div>
										        </div>
											</div>
            </div>
									</div>
									
									
									<div class="panel panel-default">
										<div class="panel-heading" role="tab">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion2" aria-expanded="false" aria-controls="accordion2">
												  Manage
												</a>
											</h4>
										</div>
            <div id="accordion2" class="panel-collapse collapse" role="tabpanel">
                <div class="panel-body">
                    <div class="th_info_wrapper">

                        <div class="th_info_text"><i class="fa fa-hand-o-down" aria-hidden="true"></i> Check the section below, to subscribe users to list and by default all emails will get saved to internal DB </div>
                        <ul><li>
                            <span><i class="fa fa-newspaper-o" aria-hidden="true"></i></span> <div class="th_checkbox"> <input type="checkbox" id="newsletter" <?php echo ($this->ts_functions->getsettings('newsletter','subs') == '1' ) ? 'checked' : '' ;?>/> <label for="newsletter">Newsletter Emails</label> </div>
                        </li>
                        <li>
                            <span><i class="fa fa-user-plus" aria-hidden="true"></i></span> <div class="th_checkbox"> <input type="checkbox" id="registeredemails"  <?php echo ($this->ts_functions->getsettings('registeredemails','subs') == '1' ) ? 'checked' : '' ;?>/> <label for="registeredemails">Registered Emails</label> </div>
                        </li>
                        <li>
                            <span><i class="fa fa-comment" aria-hidden="true"></i></span> <div class="th_checkbox"> <input type="checkbox" id="contactemails"  <?php echo ($this->ts_functions->getsettings('contactemails','subs') == '1' ) ? 'checked' : ''  ;?>/> <label for="contactemails">Contact Us Emails</label> </div>
                        </li></ul>
                        <div class="th_btn_wrapper">
                        <a class="btn theme_btn brown_btn" onclick="saveListToConnect();"> Save all checked list <i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="table_wrapper">
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped table-bordered mailchimp_table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Email App</th>
                                    <th>Choose List</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Email App</th>
                                    <th>Choose List</th>
                                </tr>
                            </tfoot>
                            <tbody>
        <?php if(!empty($emailresponders)) {
            foreach($emailresponders as $soloResponder) {
        $elistDetails = $this->DatabaseModel->access_database('ts_eplist','select','',array('eplist_parentid'=>$soloResponder['ep_id']));
        ?>
            <tr>
                <td><img src="<?php echo $basepath; ?>adminassets/images/email_icons/<?php echo $soloResponder['ep_name'].'.png';?>" alt=""></td>

                <td>
<?php if(!empty($elistDetails)) {
    foreach($elistDetails as $soloList) {
    $checked = ( $soloList['eplist_use'] == '1' ) ? 'checked' : '' ;
      echo '<p><div class="th_checkbox"> <input type="checkbox" class="elistClasses" id="elist_'.$soloList['eplist_id'].'" '.$checked.'/>								<label for="elist_'.$soloList['eplist_id'].'">'.$soloList['eplist_name'].'</label>						</div></p>';

     } } ?>
                </td>
            </tr>
        <?php } } ?>
                            </tbody>
                        </table>
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
