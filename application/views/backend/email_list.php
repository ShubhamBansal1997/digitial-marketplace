<div class="main_body">
    	<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Email list</h3>
								<div class="export_btn_wrapper">
									<a href="<?php echo $basepath;?>backend/email_list_export/csv" class="btn theme_btn">export in CSV</a><a href="<?php echo $basepath;?>backend/email_list_export/xls" class="btn theme_btn">export in EXCEL</a>
								</div>
								<div class="th_table_wrapper">
								<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Email</th>
											<th>List</th>
											<th>Source</th>
											<th>Date</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Email</th>
											<th>List</th>
											<th>Source</th>
											<th>Date</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($listusers)) {
							    $count = 0;
							    foreach($listusers as $solouser) {
							    $idd = $solouser['e_id'];
							    $count++;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solouser['e_email'];?></td>
										<td><?php echo isset($solouser['eplist_name']) ? ( $solouser['e_list'] != '0' ) ? $solouser['eplist_name'] : '-' : '-' ;?></td>
										<td><?php echo $solouser['e_type'];?></td>
										<td><?php echo date_format(date_create ( $solouser['e_date'] ) , 'M d, Y');?></td>
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
		</div>
		<!-- user content section -->
	</div>
