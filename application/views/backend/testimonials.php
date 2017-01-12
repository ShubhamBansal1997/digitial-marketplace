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
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="one">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
                                <?php echo (!empty($solotesti) ? 'Update Testimonial' : 'Add Testimonial');?>
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">
                        <form action="<?php echo $basepath;?>backend/add_testimonial" method="post" enctype="multipart/form-data" id="add_testi_form">
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Client Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_testi_form" name="clientname" value="<?php echo (!empty($solotesti) ? $solotesti[0]['testi_name'] : '');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Designation</label>
                            </div>

                            <?php if(!empty($solotesti)) {
                                $checked = ( $solotesti[0]['testi_showdesig'] == '1' ) ? 'checked' : '' ;
                            } else { $checked = 'checked';} ?>

                            <div class="col-lg-6 col-md-6">
                               <div class="th_footer_text">
                                    <div class="th_checkbox">
                                        <input type="checkbox" id="clientdesignation_checkbox" name="clientdesignation_checkbox" value="1" <?php echo $checked; ?>>
                                        <label for="clientdesignation_checkbox"></label>
                                    </div>
                                    <input type="text" class="form-control add_testi_form" name="clientdesignation" value="<?php echo (!empty($solotesti) ? $solotesti[0]['testi_desig'] : '');?>">
                                    <span class="input_help_info">Checkbox shows, whether it to display to user or not.</span>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($solotesti)) {
                        if( $solotesti[0]['testi_image'] != '' ) {
                    ?>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Previous Image</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <img src="<?php echo $basepath;?>adminwebimage/<?php echo $solotesti[0]['testi_image'];?>" style="width: 80px; height: 80px; border-radius: 100%;" />
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Previous Image</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <img src="<?php echo $basepath;?>adminwebimage/dummy_testi.jpg" style="width: 80px; height: 80px; border-radius: 100%;" />
                            </div>
                        </div>

                    <?php } } ?>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Client Image</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="file" class="form-control" name="clientimage" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Message</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <textarea class="form-control add_testi_form" name="clientmsg"><?php echo (!empty($solotesti) ? $solotesti[0]['testi_msg'] : '');?> </textarea>
                            </div>
                        </div>

                    <input type="hidden" value="<?php echo (!empty($solotesti) ? $solotesti[0]['testi_id'] : '0');?>" name="old_testid" id="old_testid">

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateSettings('add_testi_form')" class="btn theme_btn"><?php echo (!empty($solotesti) ? 'UPDATE' : 'ADD');?></a>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="two">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="collapsed">
                                Manage Testimonial
                            </a>
                        </h4>
                    </div>
                    <div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="two">
                        <div class="panel-body">

                        <div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Designation</th>
											<th>Show Designation</th>
											<th>Message</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Designation</th>
											<th>Show Designation</th>
											<th>Message</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($testi_details)) {
							    $count = 0;
							    foreach($testi_details as $solotesti) {
							    $tid = $solotesti['testi_id'];
							    $count++;
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solotesti['testi_name'];?></td>
										<td><?php echo $solotesti['testi_desig'];?></td>
										<td><?php echo ($solotesti['testi_showdesig'] == 1) ? 'Yes' : 'No';?></td>
										<td><?php echo $solotesti['testi_msg'];?></td>

										<td>
										<select onchange="updatethevalue(this,'testi');" id="<?php echo $tid.'_status';?>">
										    <option value="1" <?php echo ($solotesti['testi_status'] == '1' ? 'selected' : '' ); ?>>Active</option>
										    <option value="0" <?php echo ($solotesti['testi_status'] == '0' ? 'selected' : '' ); ?>>In Active</option>
										</select>
										<td><p><a href="<?php echo $basepath;?>backend/testimonials/<?php echo $tid;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> </p></td>
									</tr>
							<?php } } ?>
									<tbody>
								</table>
								</div>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="three">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion3" aria-expanded="false" aria-controls="accordion3" class="collapsed">
                                Re-Arrange Testimonial
                            </a>
                        </h4>
                    </div>
                    <div id="accordion3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="three">
                        <div class="panel-body">

                            <?php if(!empty($testi_details)) {
							    $count = 0; ?>
							    <ul id="sortable" class="th_gallery">
							  <?php  foreach($testi_details as $solotesti) {
						    ?>
						        <li class="th_gallery_wrapper ui-state-default" id="<?php echo $solotesti['testi_id'];?>"><?php echo $solotesti['testi_name'];?></li>
							<?php } ?>
							    </ul>
							<?php } ?>

							<div class="col-lg-12 col-md-12">
                                <div class="th_btn_wrapper">
                                    <a onclick="save_testimonial_order()" style=" margin-top: 20px;" class="btn theme_btn">UPDATE</a>
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

<!------------ footer codes -------->

</div>
<!-- content section end -->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>" />
<!--Script_start-->
<!--<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jquery-1.12.3.js"></script>-->
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/wow.js"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $basepath;?>adminassets/js/admin_custom.js" type="text/javascript"></script>
</body>
</html>
