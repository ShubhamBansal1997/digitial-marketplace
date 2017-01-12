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
                                <?php echo (!empty($solocate) ? 'Update Category & Settings' : 'Add Category & Settings');?>
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">
                        <form action="<?php echo $basepath;?>backend/add_categories" method="post" enctype="multipart/form-data" id="add_cate_form">
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Category Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_cate_form" name="catename" value="<?php echo (!empty($solocate) ? $solocate[0]['cate_name'] : '');?>">
                            <span class="input_help_info">Category name, will be displayed to customers.</span>
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Category URL Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_cate_form" name="cateurlname" value="<?php echo (!empty($solocate) ? $solocate[0]['cate_urlname'] : '');?>">
                            <span class="input_help_info">Category URL name can have hyphen(-), space( ), numbers(0-9) but not other special characters.<br/> This will be used for links and URLs.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Don't show categories without any products</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="dontshow_emptycate" onchange="updatethevalue(this,'categories');" name="dontshow_emptycate" value="1" <?php echo ($this->ts_functions->getsettings('dontshow','emptycate') == 1 ) ? "checked" : "" ;?>  />
                                    <label for="dontshow_emptycate"></label>
                                </div>
                            </div>
                        </div>

                    <input type="hidden" value="<?php echo (!empty($solocate) ? $solocate[0]['cate_id'] : '0');?>" name="old_cateid" id="old_cateid">

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateSettings('add_cate_form')" class="btn theme_btn"><?php echo (!empty($solocate) ? 'UPDATE' : 'ADD');?></a>
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
                                Manage Categories
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
											<th>Products Linked</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Products Linked</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($cate_details)) {
							    $count = 0;
							    foreach($cate_details as $solocate) {
							    $cid = $solocate['cate_id'];
							    $count++;

							    $whr_array = array('prod_cateid'=>$cid);
    $getProducts = $this->DatabaseModel->access_database('ts_products','select','',$whr_array);
						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solocate['cate_name'];?></td>
										<td><?php echo count($getProducts);?></td>
										<td>
										<select onchange="updatethevalue(this,'cate');" id="<?php echo $cid.'_status';?>">
										    <option value="1" <?php echo ($solocate['cate_status'] == '1' ? 'selected' : '' ); ?>>Active</option>
										    <option value="0" <?php echo ($solocate['cate_status'] == '0' ? 'selected' : '' ); ?>>In Active</option>
										</select>
										<td><p><a href="<?php echo $basepath;?>backend/categories/<?php echo $cid;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> </p></td>
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
