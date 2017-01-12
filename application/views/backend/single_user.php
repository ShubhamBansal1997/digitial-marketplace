<?php
    if(empty($userdetails)) {
        redirect(base_url());
    }
?>
<!-- content section start -->
<div class="th_main_wrapper">
	<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<div class="th_user_info">
									<h3><?php echo $userdetails[0]['user_uname'];?></h3>
									<p>registration Date: <span><?php echo date_format(date_create ( $userdetails[0]['user_registerdate'] ) , 'M d, Y');?></span></p>
									<?php if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
										    $planDetails = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$userdetails[0]['user_plans']));

										echo !empty($planDetails) ? '<h3 class="th_subheading">Plan : <i>'.$planDetails[0]['plan_name'].'</i></h3>' : '<h3 class="th_subheading">Plan : <i>FREE</i></h3>';

										echo !empty($planDetails) ? '<p>Plan Date: <span>'.date_format(date_create ( $userdetails[0]['user_plansdate'] ) , 'M d, Y').'</span></p>' : '';
										 } ?>

								</div>
								<div class="user_product_info">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs theme_tab" role="tablist">
										<li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">information</a></li>
										<li role="presentation"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Purchase detail</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="info">
											<div class="th_content_section">
												<div class="th_product_detail">
													<div class="theme_label">Full Name :</div>
													<div class="product_info product_name"><?php echo $userdetails[0]['user_fname'].' '.$userdetails[0]['user_lname'];?></div>
												</div>
												<div class="th_product_detail">
													<div class="theme_label">Email :</div>
													<div class="product_info status"><?php echo $userdetails[0]['user_email'];?></div>
												</div>
												<div class="th_product_detail">
													<div class="theme_label">Status : </div>
													<div class="product_info"><?php if($userdetails[0]['user_status'] == '1') {
                                                        echo '<span style="color:green;">Active</span>';
                                                    } elseif($userdetails[0]['user_status'] == '2') {
                                                        echo '<span style="color:blue;">In Active</span>';
                                                    } else {
                                                        echo '<span style="color:red;">Blocked</span>';
                                                    }?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Mobile Number : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_mobile'];?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Address : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_address'];?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Zip : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_zip'];?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">City : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_city'];?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">State : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_state'];?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Country : </div>
													<div class="product_info"><?php
													$countryDetails = $this->DatabaseModel->access_database('ts_country','select','',array('countryId'=>$userdetails[0]['user_country']));

            										echo !empty($countryDetails) ? $countryDetails[0]['countryName'] : '';
													?></div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Mobile Number : </div>
													<div class="product_info"><?php echo $userdetails[0]['user_mobile'];?></div>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="product">

											<div class="table-responsive">
												<table id="data_table" class="table table-striped table-bordered manage_user" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Product Name</th>
															<th class="action">View</th>
														</tr>
													<thead>
													<tfoot>
														<tr>
															<th>#</th>
															<th>Product Name</th>
															<th class="action">View</th>
														</tr>
													<tfoot>
													<tbody>
												<?php if(!empty($totalProductDetails)) {
												    $sno=0;
												foreach($totalProductDetails as $soloProd) {
												$prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
												$sno++;
												 ?>
														<tr>
															<td><p><?php echo $sno;?></p></td>
															<td><p><?php echo $soloProd['prod_name'];?></p></td>
															<td><p> <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" class="view" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></p></td>
														</tr>
													<?php } } else { ?>
													    <tr>
                                                            <td colspan="3" align="center"> User can not access any product.</td>
                                                        </tr>
													<?php } ?>
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
		<!-- user content section -->
	</div>
</div>
<!-- content section end -->
