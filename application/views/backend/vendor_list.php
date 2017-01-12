<div class="main_body">
    <!-- add user modal start -->

		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">

				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Vendor Lists</h3>
								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>User Name</th>
											<th>Email</th>
											<?php if( $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans') { echo '<th>Plan</th>'; } ?>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>User Name</th>
											<th>Email</th>
											<?php if( $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans') { echo '<th>Plan</th>'; } ?>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($userdetails)) {
							    $count = 0;
							    foreach($userdetails as $solouser) {
							    $uid = $solouser['user_id'];
							    $count++;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solouser['user_uname'];?></td>
										<td><?php echo $solouser['user_email'];?></td>
										<?php if( $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans') {
										    $planDetails = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$solouser['user_vplans']));
										echo !empty($planDetails) ? '<td>'.$planDetails[0]['vplan_name'].'</td>' : '<td>-</td>'; } ?>
										<td>

										<select onchange="updatethevalue(this,'user');" id="<?php echo $uid.'_status';?>">
										    <option value="1" <?php echo ($solouser['user_status'] == '1' ? 'selected' : '' ); ?>>Active</option>
										    <option value="2" <?php echo ($solouser['user_status'] == '2' ? 'selected' : '' ); ?>>In Active</option>
										    <option value="3" <?php echo ($solouser['user_status'] == '3' ? 'selected' : '' ); ?>>Blocked</option>
										</select>
										</td>
										<td>
                                        <a href="<?php echo $basepath?>backend/single_vendor/<?php echo $uid;?>"  class="delete" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
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
