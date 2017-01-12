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
									<!-- Language Settings -->
									    <div class="panel panel-default">
											<div class="panel-heading" role="tab" id="one">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
														Language Settings
													</a>
												</h4>
											</div>
											<div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
												<div class="panel-body">
												<form action="<?php echo $basepath;?>settings/updatelanguages" method="post" id="languageForm">
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Show language switch</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_checkbox">
																<input type="checkbox" id="languageswitch_checkbox" name="languageswitch_checkbox"  class="languageSettings" value="1" <?php echo $this->ts_functions->getsettings('languageswitch','checkbox') == '1' ? 'checked' : '' ; ?>>
																<label for="languageswitch_checkbox"></label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Language</label>
														</div>
														<?php
														$langArr = explode(',',$this->ts_functions->getsettings('languageoption','text'));
														?>
														<div class="col-lg-6 col-md-6">
															<select class="form-control" name="weblanguage_text" >
														<?php for($i=0;$i<count($langArr);$i++) {
														$selected = ( $this->ts_functions->getsettings('weblanguage','text') == $langArr[$i] ) ? 'selected' : '' ;
														echo '<option '.$selected.' value="'.$langArr[$i].'">'.$langArr[$i].'</option>';
														}?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Add new language</label>
														</div>

														<div class="col-lg-6 col-md-6">
														    <input type="hidden" id="existinglanguage" value="<?php echo $this->ts_functions->getsettings('languageoption','text');?>">
															<input type="text" class="form-control" name="addnewlanguage" id="addnewlanguage">
															<span class="input_help_info">Should be in lower case , and one at a time</span>
														</div>
													</div>
													<div class="col-lg-12 col-md-12">
														<div class="th_btn_wrapper">
															<a onclick="updateSettings('languageSettings')" class="btn theme_btn">UPDATE</a>
														</div>
													</div>
													
													<h3 class="th_subheading" style="color:#F44336;"> Delete Language Section </h3>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Delete Language</label>
														</div>
														<?php
														$langArr = explode(',',$this->ts_functions->getsettings('languageoption','text'));
														?>
														<div class="col-lg-6 col-md-6">
															<select class="form-control" id="lan_to_delete" >
														<?php for($i=0;$i<count($langArr);$i++) {
														echo '<option value="'.$langArr[$i].'">'.$langArr[$i].'</option>';
														}?>
															</select>
														</div>
													</div>
													
													<div class="col-lg-12 col-md-12">
														<div class="th_btn_wrapper">
															<a onclick="delete_selected_language()" class="btn theme_btn">DELETE</a>
														</div>
													</div>
													
													
												</form>
												</div>
											</div>
										</div>

									<!-- SEO Settings -->
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="one">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="collapsed">
														SEO Settings
													</a>
												</h4>
											</div>
											<div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="one">
												<div class="panel-body">
												    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Site Name</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<input type="text" class="form-control settingsfields" id="sitename_text" value=" <?php echo $this->ts_functions->getsettings('sitename','text');?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Site Title</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<input type="text" class="form-control settingsfields" id="sitetitle_text" value=" <?php echo $this->ts_functions->getsettings('sitetitle','text');?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Site Author</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<input type="text" class="form-control settingsfields" id="siteauthor_text" value=" <?php echo $this->ts_functions->getsettings('siteauthor','text');?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Meta Tags</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<textarea class="form-control settingsfields" id="metatags_text"><?php echo $this->ts_functions->getsettings('metatags','text');?></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Description</label>
														</div>
														<div class="col-lg-6 col-md-6">
														    <textarea class="form-control settingsfields" id="seodescr_text"> <?php echo $this->ts_functions->getsettings('seodescr','text');?></textarea>
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

									<!-- Site Images Settings -->
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="two">
												<h4 class="panel-title">
													<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion2" aria-expanded="false" aria-controls="accordion2">
													  Site Images Settings
													</a>
												</h4>
											</div>
											<div id="accordion2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="two">
												<div class="panel-body">
												    <form id="logoform" method="post" action="<?php echo $basepath;?>settings/upload_imagesettings"  enctype="multipart/form-data">
												    <h3 class="th_subheading"> Upload one at a time </h3>
												    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Pre Loader</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="preloader_url">
																<span class="input_help_info">Preferred logo size 100x100px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_preloader_img">
																<img src="<?php echo $this->ts_functions->getsettings('preloader','url');?>">
																</div>
															</div>
														</div>
													</div>
                                                    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Favicon</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
															<input type="file" name="favicon_url">
															<span class="input_help_info">Preferred favicon size 32x32px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_fev_icon">
																<img src="<?php echo $this->ts_functions->getsettings('favicon','url');?>">
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Logo</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="logo_url">
																<span class="input_help_info">Preferred image size 180x43px , but maximum it can be 250x50px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('logo','url');?>">
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Home page background image</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="backgroundimg_url">
																<span class="input_help_info">Preferred image size 1920x1280px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('backgroundimg','url');?>">
																</div>
															</div>
														</div>
													</div>
													
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Login / SignUp background image</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="accountaccessimg_url">
																<span class="input_help_info">Preferred image size 1583x775px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('accountaccessimg','url');?>">
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>404 image</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="notfoundimg_url">
																<span class="input_help_info">Preferred image size 1124x679px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('notfoundimg','url');?>">
																</div>
															</div>
														</div>
													</div>
													
																										
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>OOPs image</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="oopsimg_url">
																<span class="input_help_info">Preferred image size 300x240px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('oopsimg','url');?>">
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Success image</label>
														</div>
														<div class="col-lg-7 col-md-7">
															<div class="th_upload_text">
																<input type="file" name="successimg_url">
																<span class="input_help_info">Preferred image size 300x240px </span>
															</div>
															<div class="ts_img_div">
																<div class="ts_logo_img">
																	<img src="<?php echo $this->ts_functions->getsettings('successimg','url');?>">
																</div>
															</div>
														</div>
													</div>
													
																										
													<div class="col-lg-12 col-md-12">
														<div class="th_btn_wrapper">
															<a onclick="updateSettings('logoform')" class="btn theme_btn">UPDATE</a>
														</div>
													</div>
													</form>
												</div>
											</div>
										</div>

									<!-- Section Settings -->
									    <div class="panel panel-default">
											<div class="panel-heading" role="tab" id="seven">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion7" aria-expanded="false" aria-controls="accordion1" class="collapsed">
														Section Settings
													</a>
												</h4>
											</div>
											<div id="accordion7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="seven">
												<div class="panel-body">

                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Show Newsletter section</label>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="th_checkbox">
                                                <input type="checkbox" id="shownewsletter_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('shownewsletter','checkbox') == '1' ? 'checked' : '' ; ?>>
                                                <label for="shownewsletter_checkbox"></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Show Sales of Featured Product</label>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="th_checkbox">
                                                <input type="checkbox" id="showfeaturedsales_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('showfeaturedsales','checkbox') == '1' ? 'checked' : '' ; ?>>
                                                <label for="showfeaturedsales_checkbox"></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Site Color</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" class="form-control settingsfields jscolor" id="sitecolor_code" value="#<?php echo $this->ts_functions->getsettings('sitecolor','code');?>">
                                            <span class="input_help_info"> Default color code is : FBC02D </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Button focus / highlight color</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" class="form-control settingsfields jscolor" id="sitehighcolor_code" value="#<?php echo $this->ts_functions->getsettings('sitehighcolor','code');?>">
                                            <span class="input_help_info"> Default color code is : DCAD39 </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Featured Tag Color</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" class="form-control settingsfields jscolor" id="featuredcolor_code" value="#<?php echo $this->ts_functions->getsettings('featuredcolor','code');?>">
                                            <span class="input_help_info"> Default color code is : 03A9F4 </span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Show homepage overlay</label>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="th_checkbox">
                                                <input type="checkbox" id="homepageoverlayshow_checkbox" class="settingsfields" value="1" <?php echo $this->ts_functions->getsettings('homepageoverlayshow','checkbox') == '1' ? 'checked' : '' ; ?>>
                                                <label for="homepageoverlayshow_checkbox"></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Overlay Color</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" class="form-control settingsfields jscolor" id="homepageoverlay_color" value="#<?php echo $this->ts_functions->getsettings('homepageoverlay','color');?>">
                                            <span class="input_help_info"> Default color code is : 000000 </span>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <div class="col-lg-3 col-md-3">
                                            <label>Overlay Color Opacity</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <select class="form-control settingsfields" id="homepageoverlay_opacity">
                                            <?php 
                                            	for($i=0;$i<10;$i++) {
                                            		$op = $i/10;
                                            		$sel = ($this->ts_functions->getsettings('homepageoverlay','opacity') == $op) ? 'selected' : '' ;
                                            		echo '<option value="'.$op.'" '.$sel.'>'.$op.'</option>';
                                            	}
                                            ?>
                                            </select>
                                            <span class="input_help_info"> Default overlay opacity is : 0.8 </span>
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

									<!-- Footer Settings -->
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="three">
												<h4 class="panel-title">
													<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion3" aria-expanded="false" aria-controls="accordion3">
													  Footer Settings
													</a>
												</h4>
											</div>
											<div id="accordion3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="three">
												<div class="panel-body">
												    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Copyright Text</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields"id="copyright_checkbox" value="1" <?php echo $this->ts_functions->getsettings('copyright','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="copyright_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="copyright_text" value=" <?php echo $this->ts_functions->getsettings('copyright','text');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
                                                    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Facebook Link</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="fblink_checkbox" value="1" <?php echo $this->ts_functions->getsettings('fblink','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="fblink_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="fblink_url" value=" <?php echo $this->ts_functions->getsettings('fblink','url');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Twitter Link</label>
														</div>
														<div class="col-lg-6 col-md-6">
	                                                       <div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="twitterlink_checkbox" value="1" <?php echo $this->ts_functions->getsettings('twitterlink','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="twitterlink_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="twitterlink_url" value=" <?php echo $this->ts_functions->getsettings('twitterlink','url');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Google+ Link</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="googlelink_checkbox" value="1" <?php echo $this->ts_functions->getsettings('googlelink','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="googlelink_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="googlelink_url" value=" <?php echo $this->ts_functions->getsettings('googlelink','url');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Address</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="siteaddress_checkbox" value="1" <?php echo $this->ts_functions->getsettings('siteaddress','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="siteaddress_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="siteaddress_text" value=" <?php echo $this->ts_functions->getsettings('siteaddress','text');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Phone</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="sitephone_checkbox" value="1" <?php echo $this->ts_functions->getsettings('sitephone','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="sitephone_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="sitephone_text" value=" <?php echo $this->ts_functions->getsettings('sitephone','text');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Email</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<div class="th_footer_text">
																<div class="th_checkbox">
																	<input type="checkbox" class="settingsfields" id="siteemail_checkbox" value="1" <?php echo $this->ts_functions->getsettings('siteemail','checkbox') == '1' ? 'checked' : '' ; ?>>
																	<label for="siteemail_checkbox"></label>
																</div>
																<input type="text" class="form-control settingsfields" id="siteemail_text" value=" <?php echo $this->ts_functions->getsettings('siteemail','text');?>">
																<span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
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
