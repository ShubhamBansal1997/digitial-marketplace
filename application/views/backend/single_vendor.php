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
									<?php if( $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans') {
										    $planDetails = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$userdetails[0]['user_vplans']));

										    echo !empty($planDetails) ? '<h3 class="th_subheading">Vendor Plan : <i>'.$planDetails[0]['vplan_name'].'</i></h3>' : '<h3 class="th_subheading">Vendor Plan : <i>-</i></h3>';

										echo !empty($planDetails) ? '<p>Plan Date: <span>'.date_format(date_create ( $userdetails[0]['user_vplansdate'] ) , 'M d, Y').'</span></p>' : '';
										 } ?>

									<p> Total earnings from <?php echo $userdetails[0]['user_uname'];?> : <b style="color:#6f5499;"><?php echo $this->ts_functions->getsettings('portal','curreny').' <span id="totEarning"></span>';?></b> </p>

									<p> Total commission <?php echo $userdetails[0]['user_uname'];?> received : <b style="color:#6f5499;"><?php echo $this->ts_functions->getsettings('portal','curreny').' <span id="totCommission"></span>';?></b> </p>

								</div>
								<div class="user_product_info">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs theme_tab" role="tablist">
										<li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Profile</a></li>
										<li role="presentation"><a href="#product_purchase" aria-controls="product_purchase" role="tab" data-toggle="tab">Purchase detail</a></li>
										<li role="presentation"><a href="#product_upload" aria-controls="product_upload" role="tab" data-toggle="tab">Products</a></li>
										<li role="presentation"><a href="#earning_section" aria-controls="earning_section" role="tab" data-toggle="tab">Earnings</a></li>
										<li role="presentation"><a href="#withdrawal_section" aria-controls="withdrawal_section" role="tab" data-toggle="tab">Make a Payment</a></li>
										<li role="presentation"><a href="#payment_history_section" aria-controls="payment_history_section" role="tab" data-toggle="tab">Payment History</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
									<!-- Vendor Information STARTS -->
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
									<!-- Vendor Information ENDS -->
									<!-- Purchase details STARTS -->
										<div role="tabpanel" class="tab-pane" id="product_purchase">

											<div class="table-responsive">
												<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
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
									<!-- Purchase details ENDS -->
									<!-- Product Upload details STARTS -->
										<div role="tabpanel" class="tab-pane" id="product_upload">

											<div class="table-responsive">
												<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Product Name</th>
															<th>Price</th>
															<th class="action">View</th>
														</tr>
													<thead>
													<tfoot>
														<tr>
															<th>#</th>
															<th>Product Name</th>
															<th>Price</th>
															<th class="action">View</th>
														</tr>
													<tfoot>
													<tbody>
												<?php if(!empty($uploadedProducts)) {
												    $sno=0;
												foreach($uploadedProducts as $soloProd) {
												$prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
												$sno++;
												 ?>
														<tr>
															<td><p><?php echo $sno;?></p></td>
															<td><p><?php echo $soloProd['prod_name'];?></p></td>
															<td><p><?php echo $soloProd['prod_price'];?></p></td>
															<td><p> <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" class="view" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></p></td>
														</tr>
													<?php } } else { ?>
													    <tr>
                                                            <td colspan="4" align="center"> User has not uploaded any product.</td>
                                                        </tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									<!-- Product Upload details ENDS -->
									<!-- Vendor Earning STARTS -->
										<div role="tabpanel" class="tab-pane" id="earning_section">
											<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Purchase Date</th>
											<th>Purchase Code</th>
											<th>Sale Cost</th>
											<th>Vendor Commission</th>
											<th>Admin Commission</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Purchase Date</th>
											<th>Purchase Code</th>
											<th>Sale Cost</th>
											<th>Vendor Commission</th>
											<th>Admin Commission</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($transactionDetails)) {
							    $count = 0;
							    foreach($transactionDetails as $solotransaction) {
							        $custom = trim($solotransaction['payment_pid']);
                                    $customArr = explode(',',$custom);

                                    $venStr = trim($solotransaction['payment_vendor_commission']);
                                    $venCommArr = array();
                                    if( $venStr != '' ) {
                                        $venArr = explode(',',$venStr);

                                        for($i=0;$i<count($venArr);$i++) {
                                            $venSplitArr = explode('@#', trim($venArr[$i]));
                                            $venCommArr[ $solotransaction['payment_id'].'@'.$venSplitArr[0] ] = $venSplitArr[1];
                                        }
                                    }

                                    $adminStr = trim($solotransaction['payment_admin_commission']);
                                    $adminCommArr = array();
                                    if( $adminStr != '' ) {
                                        $adminArr = explode(',',$adminStr);

                                        for($i=0;$i<count($adminArr);$i++) {
                                            $adminSplitArr = explode('@#', trim($adminArr[$i]));
                                            $adminCommArr[ $solotransaction['payment_id'].'@'.$adminSplitArr[0] ] = $adminSplitArr[1];
                                        }
                                    }
							        for($i=0;$i<count($customArr);$i++) {
							            $pId = trim($customArr[$i]);

                                        $findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId));
                                        if( $userdetails[0]['user_id'] == $findProduct[0]['prod_uid']) {
                                        $count++;

                                        $vCommission = (isset($venCommArr[ $solotransaction['payment_id'].'@'.$pId])) ? $venCommArr[ $solotransaction['payment_id'].'@'.$pId] : '0' ;
                                        $aCommission = (isset($adminCommArr[ $solotransaction['payment_id'].'@'.$pId])) ? $adminCommArr[ $solotransaction['payment_id'].'@'.$pId] : '0' ;

                                        $totalAdminEarning[] = $aCommission;
                                        $totalVendorEarning[] = $vCommission;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $findProduct[0]['prod_name'];?></td>
										<td><?php echo date_format(date_create ( $solotransaction['payment_date'] ) , 'M d, Y');?>
										<td><?php echo $solotransaction['payment_uniqid'];?></td>
										<td><?php echo $vCommission + $aCommission;?></td>
										<td><?php echo (isset($venCommArr[ $solotransaction['payment_id'].'@'.$pId])) ? $venCommArr[ $solotransaction['payment_id'].'@'.$pId] : '0' ;?></td>
										<td><?php echo (isset($adminCommArr[ $solotransaction['payment_id'].'@'.$pId])) ? $adminCommArr[ $solotransaction['payment_id'].'@'.$pId] : '0' ;?></td>
									</tr>
							<?php } } } } else { ?>
                                <tr>
                                    <td colspan="7" align="center"> No data recorded.</td>
                                </tr>
                            <?php }
                                $totalAdminCommission = isset($totalAdminEarning) ? array_sum($totalAdminEarning) : '0';
                                $totalVendorCommission = isset($totalVendorEarning) ? array_sum($totalVendorEarning) : '0';
                            ?>
                            <script> document.getElementById('totEarning').innerHTML=<?php echo $totalAdminCommission;?></script>
                            <script> document.getElementById('totCommission').innerHTML=<?php echo $totalVendorCommission;?></script>
									<tbody>
								</table>
								</div>
										</div>
									<!-- Vendor Earning ENDS -->
									<!-- Vendor Make a Payment STARTS -->
										<div role="tabpanel" class="tab-pane" id="withdrawal_section">
											<div class="th_content_section">
												<div class="th_product_detail">
													<div class="theme_label">Paypal Email :</div>
													<div class="product_info"><?php echo (isset($withdrawalDetails_paypal[0]['venwith_text'])) ? $withdrawalDetails_paypal[0]['venwith_text'] : '' ;?></div>
												</div>
												<div class="th_product_detail">
													<div class="theme_label">Bank Details :</div>
													<div class="product_info status">
													<textarea rows="6" class="form-control"><?php echo (isset($withdrawalDetails_bnkdetails[0]['venwith_text'])) ? $withdrawalDetails_bnkdetails[0]['venwith_text'] : '' ;?></textarea>
													</div>
												</div>
												
												<div class="th_product_detail">
													<div class="theme_label">Bitcoin Details :</div>
													<div class="product_info status">
													<textarea rows="6" class="form-control"><?php echo (isset($withdrawalDetails_bitcoin[0]['venwith_text'])) ? $withdrawalDetails_bitcoin[0]['venwith_text'] : '' ;?></textarea>
													</div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Amount Already Paid :</div>
													<div class="product_info status">
													    <?php echo $this->ts_functions->getsettings('portal','curreny').' ';
                                                        echo $withdrawalDetails_payed[0]['totalPayedAmount'] == '' ? 0 : $withdrawalDetails_payed[0]['totalPayedAmount'];
                                                        ;?>
													</div>
												</div>
<?php
    $commPaid = (isset($venCommArr)) ? array_sum($venCommArr) : 0 ;
    $amountPaid = $withdrawalDetails_payed[0]['totalPayedAmount'];
    $remainingAmount = $commPaid - $amountPaid;
?>
												<div class="th_product_detail">
													<div class="theme_label">Amount Remaining :</div>
													<div class="product_info status">
													    <?php echo $this->ts_functions->getsettings('portal','curreny').' '.$remainingAmount;?>
													</div>
												</div>

                                                <p style="color:red;text-align:center;"> You need to send payment to vendor manually.</p>

												<div class="th_product_detail">
													<div class="theme_label">Enter the amount you want to pay :</div>
													<div class="product_info status">
													<input type="text" class="form-control" id="amounttobepaid" />
													</div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Any note regarding this payment :</div>
													<div class="product_info status">
													<textarea rows="6" class="form-control" id="paymentnote"></textarea>
													</div>
												</div>

												<div class="th_product_detail">
													<div class="theme_label">Want to send notification to Vendor via email :</div>
													<div class="product_info status">
													<input type="checkbox" id="sendnotification" />
													</div>
												</div>
<input type="hidden" value="<?php echo $userdetails[0]['user_id'] ;?>" id="vendorId" />
												<div class="col-lg-12 col-md-12">
                                                    <div class="th_btn_wrapper">
                                                        <a onclick="updateWithdrawal()" class="btn theme_btn">Update payment status</a>
                                                    </div>
                                                </div>

											</div>
										</div>
									<!-- Vendor Make a Payment ENDS -->
									<!-- Vendor Payment History STARTS -->
										<div role="tabpanel" class="tab-pane" id="payment_history_section">
											<div class="th_content_section">

                    <div class="th_registration_msg">

                        <div class="table-responsive">
                            <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Notes</th>
                                        <th>Date</th>
                                    </tr>
                                <thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>Notes</th>
                                        <th>Date</th>
                                    </tr>
                                <tfoot>
                                <tbody>
                        <?php if(!empty($payment_history_details)) {
                            $count = 0;
                            foreach($payment_history_details as $soloreceived) {
                            $count++;
                        ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $soloreceived['venwith_text'];?></td>
                                    <td><?php echo $soloreceived['venwith_notes'];?></td>
                                    <td><?php echo date_format(date_create ( $soloreceived['venwith_date'] ) , 'M d, Y');?>
                                </tr>
                        <?php } } ?>
                                <tbody>
                            </table>
                            </div>

                    </div>

											</div>
										</div>
									<!-- Vendor Payment History ENDS -->
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
