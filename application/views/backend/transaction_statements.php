<div class="main_body">
    <!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
			    <div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Sales Statements ( Total Earnings : <b style="color:#6f5499;"><?php echo $this->ts_functions->getsettings('portal','curreny').' <span id="totEarning"></span>';?></b>) </h3>
								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Vendor Name</th>
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
											<th>Vendor Name</th>
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
							    $totalAdminEarning = array();
							    foreach($transactionDetails as $solotransaction) {
							        $custom = trim($solotransaction['payment_pid']);
                                    $customArr = explode(',',$custom);

                                    $venStr = trim($solotransaction['payment_vendor_commission']);
                                    $venCommArr = array();
                                    if( $venStr != '' ) {
                                        $venArr = explode(',',$venStr);

                                        for($i=0;$i<count($venArr);$i++) {
                                            $venSplitArr = explode('@#', trim($venArr[$i]));
                                            $venCommArr[ $venSplitArr[0] ] = $venSplitArr[1];
                                        }
                                    }

                                    $adminStr = trim($solotransaction['payment_admin_commission']);
                                    $adminCommArr = array();
                                    if( $adminStr != '' ) {
                                        $adminArr = explode(',',$adminStr);

                                        for($i=0;$i<count($adminArr);$i++) {
                                            $adminSplitArr = explode('@#', trim($adminArr[$i]));
                                            $adminCommArr[ $adminSplitArr[0] ] = $adminSplitArr[1];
                                        }
                                    }

							        for($i=0;$i<count($customArr);$i++) {
							            $count++;
							            $pId = trim($customArr[$i]);

                                        $findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId));

                                        $vendorDetails = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$findProduct[0]['prod_uid']));

                                        $vCommission = (isset($venCommArr[$pId])) ? $venCommArr[$pId] : '0' ;
                                        $aCommission = (isset($adminCommArr[$pId])) ? $adminCommArr[$pId] : '0' ;

                                    $totalAdminEarning[] = $aCommission;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $findProduct[0]['prod_name'];?></td>
										<td><?php echo $vendorDetails[0]['user_uname'];?></td>
										<td><?php echo date_format(date_create ( $solotransaction['payment_date'] ) , 'M d, Y');?>
										<td><?php echo $solotransaction['payment_uniqid'];?></td>
										<td><?php echo $vCommission + $aCommission;?></td>
										<td><?php echo (isset($venCommArr[$pId])) ? $venCommArr[$pId] : '0' ;?></td>
										<td><?php echo (isset($adminCommArr[$pId])) ? $adminCommArr[$pId] : '0' ;?></td>
									</tr>
							<?php } } }

							    $totalAdminCommission = isset($totalAdminEarning) ? array_sum($totalAdminEarning) : '0';
							?>
							<script> document.getElementById('totEarning').innerHTML=<?php echo $totalAdminCommission;?></script>

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
