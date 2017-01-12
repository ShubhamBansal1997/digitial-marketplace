				<?php
				if(isset($updatemsg)) { ?>
				    <p style="text-align: center;color: #66BB6A;font-weight: bold;"><?php echo $updatemsg; ?></p>
				<?php }
				    if(isset($errormsg)) {
				?>
				    <p style="text-align: center;color: #F44336;font-weight: bold;"><?php echo $errormsg; ?></p>
				<?php } ?>
				<div class="ts_info_wrapper">
					<h4><?php echo $this->ts_functions->getlanguage('basicheadingtext','userdashboard','solo');?></h4>
					<form method="post" action="" class="ts_inner_info_box">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('usernametext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('usernametext','userdashboard','solo');?>" readonly="readonly" value="<?php echo $userDetail[0]['user_uname'];?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('emailtext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('emailtext','userdashboard','solo');?>" readonly="readonly" value="<?php echo $userDetail[0]['user_email'];?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('fnametext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('fnametext','userdashboard','solo');?>" name="fname" value="<?php echo $userDetail[0]['user_fname'];?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('lnametext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('lnametext','userdashboard','solo');?>" name="lname" value="<?php echo $userDetail[0]['user_lname'];?>">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<input type="submit" name="basic_btn" class="ts_btn pull-right" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
							</div>
						</div>
					</form>
				</div>
				<div class="ts_info_wrapper">
					<h4><?php echo $this->ts_functions->getlanguage('billingheadingtext','userdashboard','solo');?></h4>
					<form method="post" action="" class="ts_inner_info_box">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('mobiletext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('mobiletext','userdashboard','solo');?>" name="mobile" value="<?php echo $userDetail[0]['user_mobile'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('addtext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('addtext','userdashboard','solo');?>" name="address" value="<?php echo $userDetail[0]['user_address'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('countrytext','userdashboard','solo');?></label>
									<?php if(!empty($countryDetails)) {
									    $selected = ( $userDetail[0]['user_country'] == '0' ) ? 'selected' : '' ;
									echo '<select name="country" class="form-control">';
									echo '<option value="0" '.$selected.'>'.$this->ts_functions->getlanguage('countrytext','userdashboard','solo').'</option>';
									    foreach($countryDetails as $soloCountry) {

									    $selected = ( $soloCountry['countryId'] == $userDetail[0]['user_country'] ) ? 'selected' : '' ;

									    echo '<option value="'.$soloCountry['countryId'].'" '.$selected.'>'.$soloCountry['countryName'].'</option>';

									} echo "</select>"; } ?>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('statetext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('statetext','userdashboard','solo');?>" name="state" value="<?php echo $userDetail[0]['user_state'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('citytext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('citytext','userdashboard','solo');?>" name="city" value="<?php echo $userDetail[0]['user_city'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('zipcodetext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('zipcodetext','userdashboard','solo');?>" name="zip" value="<?php echo $userDetail[0]['user_zip'];?>">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<input type="submit" name="billing_btn" class="ts_btn pull-right" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
							</div>
						</div>
					</form>
				</div>
				<div class="ts_info_wrapper">
					<h4><?php echo $this->ts_functions->getlanguage('pwdheadingtext','userdashboard','solo');?></h4>
					<form method="post" action="" class="ts_inner_info_box">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('passwordtext','userdashboard','solo');?></label>
									<input type="password" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('passwordtext','userdashboard','solo');?>" name="pwd">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label><?php echo $this->ts_functions->getlanguage('resetpwdtext','userdashboard','solo');?></label>
									<input type="password" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('resetpwdtext','userdashboard','solo');?>" name="repwd">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<input type="submit" name="chngpwd_btn" class="ts_btn pull-right" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Profile wrapper End -->
