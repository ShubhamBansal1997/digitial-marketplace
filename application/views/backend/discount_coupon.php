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
									<!-- Add Coupon -->
									    <div class="panel panel-default">
											<div class="panel-heading" role="tab" id="four">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
														Add Coupons
													</a>
												</h4>
											</div>
											<div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="four">
												<div class="panel-body">
												<form>
													
													
												    <div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Coupon Name <b style="color:red;">*</b></label>
														</div>
														<div class="col-lg-6 col-md-6">
															<input type="text" class="form-control coup_field" id="coup_name"  value="<?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_name']; } ?>">
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Coupon Code <b style="color:red;">*</b></label>
														</div>
														<div class="col-lg-6 col-md-6">
															<input type="text" class="form-control coup_field" id="coup_code"  value="<?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_code']; } ?>">
															<span class="input_help_info">Customer need to enter this</span>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Coupon Description</label>
														</div>
														<div class="col-lg-6 col-md-6">
															<textarea class="form-control" id="coup_desc"> <?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_desc']; } ?></textarea>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Coupon Amount <b style="color:red;">*</b></label>
														</div>
														<div class="col-lg-3 col-md-3">
															<input type="text" class="form-control coup_field coup_number" id="coup_amount" value="<?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_amount']; } ?>">
															<span class="input_help_info">Numbers only </span>
														</div>
														<div class="col-lg-3 col-md-3">
															
															<select class="form-control" id="coup_type">
														<option value="flat" <?php  if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_type'] == 'flat' ? 'selected' : '' ; } ?>>Flat</option>
														<option value="percent" <?php  if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_type'] == 'percent' ? 'selected' : '' ; } ?>>Percentage</option>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-lg-3 col-md-3">
															<label>Coupon Duration <b style="color:red;">*</b></label>
														</div>
														<div class="col-lg-3 col-md-3">
															<div class="th_footer_text">
															<div class="th_checkbox">
																<input type="checkbox"  id="coup_free" value="1" <?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_duration'] == '1' ? 'checked' : '' ; } ?> >
															<label for="coup_free"></label>

															</div>
															<input type="text" class="form-control" readonly value="LIFE TIME">
														</div>
														</div>
														
									<input type="hidden" id="coup_id"  value="<?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_id']; } else { echo '0';} ?>">
									
														<div class="col-lg-3 col-md-3">
															<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy" id="coup_date" value="<?php if(isset($singleCoupons)) { echo $singleCoupons[0]['coup_duration'] != '1' ? $singleCoupons[0]['coup_duration'] : '' ; } ?>" >
												<span class="input_help_info">It will activate <b> NOW </b> and will expire after the given date </span>
														</div>
													</div>
													
													
													<div class="col-lg-12 col-md-12">
														<div class="th_btn_wrapper">
															<a onclick="coupon_validation()" class="btn theme_btn">UPDATE</a>
														</div>
													</div>
												</form>
												</div>
											</div>
										</div>
									<!-- Add Coupon -->
									
									<!-- Manage Coupon -->

										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="one">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion1" aria-expanded="true" aria-controls="accordion1">
														Manage Coupons
													</a>
												</h4>
											</div>
											<div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="one" class="collapsed">
												<div class="panel-body">
												
												
							<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
								<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Code</th>
											<th>Amount</th>
											<th>Expired On</th>
											<th>Status</th>
											<th>Created On</th>
											<th>Edit</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Code</th>
											<th>Amount</th>
											<th>Expired On</th>
											<th>Status</th>
											<th>Created On</th>
											<th>Edit</th>
										</tr>
									<tfoot>
								<tbody>
							<?php 
								if( !empty($allCoupons)) {
									$counter = 0;
							foreach($allCoupons as $solo_coup) {
							    $counter++;
							?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $solo_coup['coup_name']; ?></td>
                                    <td><?php echo $solo_coup['coup_code']; ?></td>
                                    <td><?php echo $solo_coup['coup_amount'].' '.$solo_coup['coup_type']; ?></td>
                                    <td><?php echo $solo_coup['coup_duration'] == '1' ? 'LIFETIME' : date_format(date_create ( $solo_coup['coup_duration'] ) , 'M d, Y') ; ?></td>
                                    <td>
                                    	<select onchange="updatethevalue(this,'coupons');" id="<?php echo $solo_coup['coup_id'];?>_status">
                                    		<option value="1" <?php echo ($solo_coup['coup_status'] == '1') ? 'selected' : '' ; ?>>Active</option>
                                    		<option value="0" <?php echo ($solo_coup['coup_status'] == '0') ? 'selected' : '' ; ?>>In Active</option>
                                    	</select>
                                    </td>
                                    <td><?php echo date_format(date_create ( $solo_coup['coup_createdate'] ) , 'M d, Y');?></td>
                                    <td><a href="<?php echo $basepath;?>backend/discount_coupon/<?php echo $solo_coup['coup_id'];?>"><i class="fa fa-pencil"></i></a></td>
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
		<!-- user content section -->
	</div>
