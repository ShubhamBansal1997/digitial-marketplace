<div class="main_body">
      	<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">manage products</h3>

								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Category</th>
										<?php if($this->session->userdata['ts_level'] == 1) {
										    echo '<th>Uploaded By</th>';
										}?>
											<th>Type</th>
											<th>Download Count</th>
											<th>Status</th>
											<th>Featured</th>
											<th>Created Date</th>
											<th>Last Update</th>
											<th>Image</th>
											<th>Final Product</th>
											<th>Coupon</th>	
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Category</th>
										<?php if($this->session->userdata['ts_level'] == 1) {
										    echo '<th>Uploaded By</th>';
										}?>
											<th>Type</th>
											<th>Download Count</th>
											<th>Status</th>
											<th>Featured</th>
											<th>Created Date</th>
											<th>Last Update</th>
											<th>Image</th>											
											<th>Final Product</th>										
											<th>Coupon</th>										
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($productdetails)) {
							    $count = 0;
							    foreach($productdetails as $soloprod) {
							    $pid = $soloprod['prod_id'];
							    $prodName = $this->ts_functions->getProductName($soloprod['prod_id']);
							    $count++;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $soloprod['prod_name'];?></td>
										<td><?php echo $soloprod['cate_name'];?></td>
									<?php if($this->session->userdata['ts_level'] == 1) {
									    if( $soloprod['prod_uid'] == '1' ) {
									        echo '<td style="color:#6f5499;font-weight:bold;">Admin</td>';
									    }
									    else {
									    $userDetails = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$soloprod['prod_uid']));
									        echo '<td>'.$userDetails[0]['user_uname'].'</td>';
									    }
									}?>
						                <td><?php echo $soloprod['prod_type'];?></td>
						                
						                <td><?php echo $soloprod['prod_download_count'];?></td>

										<?php if( $this->session->userdata['ts_level'] == 1 ) { ?>
										<td>
										<select onchange="updatethevalue(this,'products');" id="<?php echo $pid.'_status';?>">
										    <option value="1" <?php echo ($soloprod['prod_status'] == '1' ? 'selected' : '' ); ?>>Active</option>
										    <option value="0" <?php echo ($soloprod['prod_status'] == '0' ? 'selected' : '' ); ?>>In Active</option>
										</select>
										</td>
										<?php } else { ?>
										<td>
										    <?php echo ($soloprod['prod_status'] == '1') ? '<span style="color:green;">Active</span>' : '<span style="color:red;">In Active</span>' ; ?>
										</td>
										<?php } ?>

										<?php if( $this->session->userdata['ts_level'] == 1 ) { ?>
										<td>
										<select onchange="updatethevalue(this,'products');" id="<?php echo $pid.'_featured';?>" class="featuredCls">
										    <option value="1" <?php echo ($soloprod['prod_featured'] == '1' ? 'selected' : '' ); ?>>Yes</option>
										    <option value="0" <?php echo ($soloprod['prod_featured'] == '0' ? 'selected' : '' ); ?>>No</option>
										</select>
										</td>
										<?php } else { ?>
										<td>
										    <?php echo ($soloprod['prod_featured'] == '1') ? '<span style="color:green;">Yes</span>' : '<span style="color:red;">No</span>' ; ?>
										</td>
										<?php } ?>

										<td><?php echo date_format(date_create ( $soloprod['prod_date'] ) , 'M d, Y');?></td>
										<td><?php echo date_format(date_create ( $soloprod['prod_update'] ) , 'M d, Y');?></td>
										<?php if( $soloprod['prod_image'] != '' ) { ?>
											<td style="background: rgba(0, 128, 0, 0.79);">Yes</td>
										<?php } else { ?>
											<td style="background: rgb(244, 67, 54);">No</td>
										<?php } ?>
										
										<?php if( $soloprod['prod_filename'] != '' ) { ?>
											<td style="background: rgba(0, 128, 0, 0.79);">Yes</td>
										<?php } else { ?>
											<td style="background: rgb(244, 67, 54);">No</td>
										<?php } ?>

										<td><?php echo $soloprod['prod_coupon'];?></td>
										
										<td><p>
										<?php
										$editUrl = ($this->session->userdata['ts_level'] == 1) ? $basepath.'products/update_products/'.$soloprod['prod_uniqid'] : $basepath.'vendorboard/update_products/'.$soloprod['prod_uniqid'] ;
										?>

										<?php
										if( $soloprod['prod_uid'] == $this->session->userdata['ts_uid']) { ?>
										<a href="<?php echo $editUrl;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<?php }
										elseif($this->session->userdata['ts_level'] == 1){ ?>
                                        <a href="<?php echo $editUrl;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<?php }	?>
										<a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloprod['prod_uniqid'];?>" class="view" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
										<?php
										$viewUrl = ($this->session->userdata['ts_level'] == 1) ? $basepath.'products/view_products/'.$soloprod['prod_uniqid'] : $basepath.'vendorboard/view_products/'.$soloprod['prod_uniqid'] ;
										?>
										    <a href="<?php echo $viewUrl;?>" class="graph"><i class="fa fa-signal" aria-hidden="true"></i></a>

										<?php
										$downloadUrl = ($this->session->userdata['ts_level'] == 1) ? $basepath.'products/self_product_download/'.$soloprod['prod_uniqid'] : $basepath.'vendorboard/self_product_download/'.$soloprod['prod_uniqid'] ;
										?>

										<a href="<?php echo $downloadUrl;?>" class="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
										</p></td>

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
