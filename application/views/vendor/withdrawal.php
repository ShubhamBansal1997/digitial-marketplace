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
										<div class="panel-heading" role="tab" id="two">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion2" aria-expanded="true" aria-controls="accordion2">
													<?php echo $this->ts_functions->getlanguage('payreceitext','vendorboard','solo');?>
												</a>
											</h4>
										</div>
										<div id="accordion2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="two">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">

                    <div class="th_registration_wrapper">

                        <div class="th_content_section">
                            <div class="th_product_detail">
                                <div class="theme_label"> <?php echo $this->ts_functions->getlanguage('amntreceivtext','vendorboard','solo');?> :</div>
                                <div class="product_info status">
                                    <?php echo $this->ts_functions->getsettings('portal','curreny').' ';
                                    echo $withdrawalDetails_received[0]['totalReceivedAmount'] == '' ? 0 : $withdrawalDetails_received[0]['totalReceivedAmount'];
                                    ;?>
                                </div>
                            </div>
<?php
    $totalCommission = $totalCommissionAmount;
    $amountReceived = $withdrawalDetails_received[0]['totalReceivedAmount'];
    $pendingAmount = $totalCommission - $amountReceived;
?>
                            <div class="th_product_detail">
                                <div class="theme_label"> <?php echo $this->ts_functions->getlanguage('amntpendingtext','vendorboard','solo');?> :</div>
                                <div class="product_info status">
                                    <?php echo $this->ts_functions->getsettings('portal','curreny').' '.$pendingAmount;?>
                                </div>
                            </div>

						</div>



                    <div class="th_registration_msg">

                        <div class="table-responsive">
                            <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo');?> </th>
                                        <th> <?php echo $this->ts_functions->getlanguage('notestext','vendorboard','solo');?> </th>
                                        <th> <?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?> </th>
                                    </tr>
                                <thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo');?></th>
                                        <th><?php echo $this->ts_functions->getlanguage('notestext','vendorboard','solo');?></th>
                                        <th><?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?></th>
                                    </tr>
                                <tfoot>
                                <tbody>
                        <?php if(!empty($withdrawalReceivedDetails)) {
                            $count = 0;
                            foreach($withdrawalReceivedDetails as $soloreceived) {
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
											</div>
										</div>
									</div>


                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="four">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion4" aria-expanded="true" aria-controls="accordion4" class="collapsed">
                                                Paypal <img src="<?php echo $basepath;?>adminassets/images/paypal_logo.png" style="margin-left: 56px;"/>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="accordion4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="four">
                                        <div class="panel-body">

            <div class="alert alert-info th_setting_text">
                <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('withdrawalinfotext','vendorboard','solo');?></p>
            </div>

                                            <div class="col-lg-12 col-md-12">
                <div class="th_registration_wrapper">
                <div class="th_registration_msg">

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Paypal Email</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control paypalSettings" id="paypal_email" value="<?php echo (isset($withdrawalDetails_paypal[0]['venwith_text'])) ? $withdrawalDetails_paypal[0]['venwith_text'] : '' ;?>">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <a onclick="updateWithdrawalSettings('paypalSettings')" class="btn theme_btn"><?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?></a>
                        </div>
                    </div>

                </div>

                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="six">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion6" aria-expanded="true" aria-controls="accordion6" class="collapsed">
													Manual Transfer Details  <img src="<?php echo $basepath;?>adminassets/images/banktransfer_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="six">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('withdrawalinfotext','vendorboard','solo');?></p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Manual Transfer Details</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows="5" class="form-control banktransferSettings" id="banktransfer_details" ><?php echo (isset($withdrawalDetails_bnkdetails[0]['venwith_text'])) ? $withdrawalDetails_bnkdetails[0]['venwith_text'] : '' ;?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateWithdrawalSettings('banktransferSettings')" class="btn theme_btn"><?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?></a>
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
													Bitcoin  <img src="<?php echo $basepath;?>adminassets/images/bitcoin_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="seven">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('withdrawalinfotext','vendorboard','solo');?></p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Bitcoin Details</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows="5" class="form-control bitcoinSettings" id="bitcoin_details" ><?php echo (isset($withdrawalDetails_bitcoin[0]['venwith_text'])) ? $withdrawalDetails_bitcoin[0]['venwith_text'] : '' ;?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateWithdrawalSettings('bitcoinSettings')" class="btn theme_btn"><?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?></a>
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
