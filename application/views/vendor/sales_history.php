<div class="main_body">
    <!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
			    <div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title"><?php echo $this->ts_functions->getlanguage('statementtext','vendorboard','solo');?> ( <?php echo $this->ts_functions->getlanguage('totearningtext','vendorboard','solo');?> : <b style="color:#6f5499;"><?php echo $this->ts_functions->getsettings('portal','curreny').' <span id="totEarning"></span>';?></b>) </h3>
								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th><?php echo $this->ts_functions->getlanguage('apnametext','vendorboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('purchasedatetext','userdashboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('purchasecodetext','userdashboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('salecosttext','vendorboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('vendorcommistext','vendorboard','solo');?></th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th><?php echo $this->ts_functions->getlanguage('apnametext','vendorboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('purchasedatetext','userdashboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('purchasecodetext','userdashboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('salecosttext','vendorboard','solo');?></th>
											<th><?php echo $this->ts_functions->getlanguage('vendorcommistext','vendorboard','solo');?></th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($transactionDetails)) {
							    $count = 0;
							    $vendorCommissionArray = array();
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
							            $pId = trim($customArr[$i]);

                                        $findProduct = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$pId));
                                    if(!empty($findProduct) && $uid == $findProduct[0]['prod_uid']) {
                                    $count++;

                                    $vCommission = (isset($venCommArr[$pId])) ? $venCommArr[$pId] : '0' ;
                                    $aCommission = (isset($adminCommArr[$pId])) ? $adminCommArr[$pId] : '0' ;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $findProduct[0]['prod_name'];?></td>
										<td><?php echo date_format(date_create ( $solotransaction['payment_date'] ) , 'M d, Y');?>
										<td><?php echo $solotransaction['payment_uniqid'];?></td>
										<td><?php echo $vCommission + $aCommission;?></td>
										<td><?php echo (isset($venCommArr[$pId])) ? $venCommArr[$pId] : '0' ;
										$v_c = (isset($venCommArr[$pId])) ? $venCommArr[$pId] : '0' ;
										    array_push($vendorCommissionArray,$v_c);
										?></td>
									</tr>
							<?php } } } }
							    $totalVendorCommission = isset($vendorCommissionArray) ? array_sum($vendorCommissionArray) : '0';
							?>
							<script> document.getElementById('totEarning').innerHTML=<?php echo $totalVendorCommission;?></script>
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
