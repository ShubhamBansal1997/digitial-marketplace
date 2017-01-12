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
                                <?php echo (!empty($solo_sub_cate) ? 'Update Sub Category' : 'Add Sub Category');?>
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">
                        <form action="<?php echo $basepath;?>backend/add_sub_categories" method="post" enctype="multipart/form-data" id="add_sub_cate_form">
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Sub Category Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_sub_cate_form" name="sub_catename" value="<?php echo (!empty($solo_sub_cate) ? $solo_sub_cate[0]['sub_name'] : '');?>">
                            <span class="input_help_info">Sub Category name, will be displayed to customers.</span>
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Sub Category URL Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_sub_cate_form" name="sub_cateurlname" value="<?php echo (!empty($solo_sub_cate) ? $solo_sub_cate[0]['sub_urlname'] : '');?>">
                            <span class="input_help_info">Sub Category URL name can have hyphen(-), space( ), numbers(0-9) but not other special characters.<br/> This will be used for links and URLs.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Parent Category</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <select class="form-control add_sub_cate_form" name="sub_parent">
                            <?php
                                echo '<option value="">Select One</option>';
                            if(!empty($cate_details)) {
                                foreach($cate_details as $solo_cate) {
                                $sel = (!empty($solo_sub_cate) ? ($solo_sub_cate[0]['sub_parent'] == $solo_cate['cate_id'] ? 'selected' : '' ) : '');
                                    echo '<option value="'.$solo_cate['cate_id'].'" '.$sel.'>'.$solo_cate['cate_name'].'</option>';
                                }
                            } else {
                                echo '<option value="">No Parent</option>';
                            } ?>
                            </select>
                            </div>
                        </div>


                    <input type="hidden" value="<?php echo (!empty($solo_sub_cate) ? $solo_sub_cate[0]['sub_id'] : '0');?>" name="old_sub_cateid" id="old_sub_cateid">

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateSettings('add_sub_cate_form')" class="btn theme_btn"><?php echo (!empty($solo_sub_cate) ? 'UPDATE' : 'ADD');?></a>
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
                                Manage Sub Categories
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
											<th>Parent</th>
											<th>Products Linked</th>
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Parent</th>
											<th>Products Linked</th>
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($sub_cate_details)) {
							    $count = 0;
							    foreach($sub_cate_details as $solo_sub_cate) {
							    $cid = $solo_sub_cate['sub_id'];
							    $parentid = $solo_sub_cate['sub_parent'];
							    $count++;

							    $whr_array = array('prod_subcateid'=>$cid);
    $getProducts = $this->DatabaseModel->access_database('ts_products','select','',$whr_array);

    $ca_array = array('cate_id'=>$parentid);
    $getCategories = $this->DatabaseModel->access_database('ts_categories','select','',$ca_array);
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solo_sub_cate['sub_name'];?></td>
										<td><?php echo $getCategories[0]['cate_name'];?></td>
										<td><?php echo count($getProducts);?></td>
										<td><p><a href="<?php echo $basepath;?>backend/sub_categories/<?php echo $cid;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> </p></td>
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
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>
