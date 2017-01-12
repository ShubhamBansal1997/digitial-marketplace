<div class="main_body">
 		<!-- user content section -->

 		<!-- add user modal start -->
        <!-- Modal -->
        <div class="modal fade theme_modal" id="transactiondetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title transactionHeading" id="myModalLabel"> Transaction Details </h4>
              </div>
              <div class="modal-body">
                  <div class="add_user_form" id="trans_data">

                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default close_btn" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- add user modal start -->

		<div class="theme_wrapper">
			<div class="container-fluid">
			    <div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Payment Transactions
								<span style="color:#6f5499;">( Total : <b><?php echo $this->ts_functions->getsettings('portal','curreny').' '.$totalTransaction[0]['totalAmount'];?></b>)</span>
								</h3>
								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Date</th>
											<th>Status</th>
											<th>Purchase Code</th>
											<th class="action">Details</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Date</th>
											<th>Status</th>
											<th>Purchase Code</th>
											<th class="action">Details</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($transactionDetails)) {
							    $count = 0;
							    foreach($transactionDetails as $solotransaction) {
							    $count++;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo ucfirst($solotransaction['payment_mode']);?></td>
										<td><?php echo date_format(date_create ( $solotransaction['payment_date'] ) , 'M d, Y');?>
										<td>
			<?php echo ($solotransaction['payment_status'] == 'yes' ? '<span style="color:green;font-weight:bold;">Complete</span>' : '<span style="color:red;font-weight:bold;">Incomplete</span>' ); ?>
										</td>
										<td><?php echo $solotransaction['payment_uniqid'];?></td>

										<?php if( $solotransaction['payment_mode'] != 'banktransfer' ) { ?>

										<td>
                                            <a class="delete detailss" title="View" id="<?php echo $solotransaction['payment_id'];?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                        </td>

                                        <?php } else { ?>

                                        <td>
                                            <?php if( $solotransaction['payment_status'] == 'yes' ) { ?>
                                                <a class="delete detailss" title="View" id="<?php echo $solotransaction['payment_id'];?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                            <?php } else {
                                                if( $this->session->userdata['ts_level'] == '3' ) {
                                            ?>
                                                <a style="text-decoration: none;" > Waiting for Approval </a>
                                            <?php } else { ?>
                                                 <a class="detailss bankTranscDetails" title="View" style="text-decoration: none;" id="<?php echo $solotransaction['payment_id'];?>" > Check and Approve </a>
                                           <?php } } ?>
                                        </td>

                                        <?php } ?>
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
		<!-- user content section -->
	</div>
