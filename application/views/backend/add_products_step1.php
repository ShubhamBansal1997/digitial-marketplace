<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">
<?php $topText = (isset($productdetails) ? 'Update Products ( Step 1 )' : 'Add Products ( Step 1 )' );?>
    <div class="theme_panel_section">
                    <h4 class="th_title">
                    <?php echo $topText;?>
                    </h4>
                <div class="th_content_section">
                
     <div class="alert alert-info th_setting_text">
		<p><i style="color:red;" class="fa fa-bell" aria-hidden="true"></i> Fill in those details which you want, remember fields with (<b style="color:red;">*</b>) are mandatory. <br/> The empty fields will not show up to the user.</p>
	</div>
								           
                	<div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Type <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
							<select class="form-control productfields" id="p_type">
								<option value="0">Choose a type</option>
								<option value="Audio" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Audio') ? 'selected' : ''  : '' ; ?>>Audio</option>
								<option value="Video" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Video') ? 'selected' : ''  : '' ; ?>>Video</option>
								<option value="Text" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Text') ? 'selected' : ''  : '' ; ?>>Text</option>
								<option value="Other" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Other') ? 'selected' : ''  : '' ; ?>>Others</option>
							</select>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Name <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" id="p_name" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_name']; } ?>">
                            <span class="input_help_info">Name , will be displayed to customers.</span>
                            <span class="p_name_counter name_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_name']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>URL Name <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" id="p_urlname" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_urlname']; } ?>">
                            <span class="input_help_info">URL Name can have hyphen(-), space( ), numbers(0-9) but not other special characters.<br/> This will be used for links and URLs.</span>
                            <span class="p_name_counter urlname_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_urlname']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Product Category <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control productfields" id="p_category" onchange="getSubCategories(this)">
                             <option value="0">Choose one</option>
                             <?php
                             foreach($categoryList as $soloCate) {
                                if( isset($productdetails) ) {
                                    $selected = ($productdetails[0]['prod_cateid'] == $soloCate['cate_id']) ? 'selected' : '' ;
                                }
                                else {
                                    $selected = '';
                                }
                                echo '<option value="'.$soloCate['cate_id'].'" '.$selected.'>'.$soloCate['cate_name'].'</option>';
                              } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Product Sub Category</label>
                        </div>
                        <?php
                            if( isset($productdetails) ) {
                                $subCate = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$productdetails[0]['prod_cateid']));
                            }
                            else {
                                $subCate = '';
                            }

                        ?>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control rest_fields" id="p_subcategory">
                             <option value="0">Choose one</option>
                             <?php
                             if(!empty($subCate)) {
                             foreach($subCate as $solo_subCate) {
                                if( isset($productdetails) ) {
                                    $selected = ($productdetails[0]['prod_subcateid'] == $solo_subCate['sub_id']) ? 'selected' : '' ;
                                }
                                else {
                                    $selected = '';
                                }
                                echo '<option value="'.$solo_subCate['sub_id'].'" '.$selected.'>'.$solo_subCate['sub_name'].'</option>';
                              }
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Live preview link</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control rest_fields" id="p_demourl" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_demourl']; } ?>"  placeholder="http://">
                        </div>
                    </div>

                   <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Tags</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control rest_fields" id="p_tags"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_tags']; } ?></textarea>
                            <span class="input_help_info">Separate each tag by comma (,)</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Description</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control rest_fields" id="p_description"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_description']; } ?></textarea>
                            <span class="input_help_info">Paste HTML content here</span>
                        </div>
                    </div>

                    
                    <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product download link</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control rest_fields" placeholder="http://" id="p_downlink" value="<?php if(isset($productdetails)) {  if( strpos($productdetails[0]['prod_filename'],'/') !== false ) { echo $productdetails[0]['prod_filename']; } } ?>">
                                <span class="input_help_info">Any server URL which customer will get redirected when tries to download the product  </span>
                            </div>
                        </div>
                        
                    <div class="form-group">
						<div class="col-lg-3 col-md-3">
							<label>Password to access products via External Link</label>
						</div>
						<div class="col-lg-6 col-md-6">
							<input type="text" class="form-control rest_fields" id="p_downpassword" value="<?php if(isset($productdetails)) {  echo $productdetails[0]['prod_downloadpassword']; }  ?>">
							<span class="input_help_info">This password will be shown only after the purchase of product, in download area  </span>
						</div>
					</div>

                    <?php
                        $revenueModel = $this->ts_functions->getsettings('portal','revenuemodel');
                        if( $revenueModel == 'singlecost') {
                            // Single Cost
                        ?>

                          <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Price <b style="color:red;">*</b></label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control" id="p_price" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_price']; } ?>">
                                <span class="input_help_info">Just the number </span>
                            </div>
                        </div>

                    <?php } else { ?>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Plans <b style="color:red;">*</b></label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <?php
                            // Subscription Based on Time
                            $plandetails_time = $this->DatabaseModel->access_database('ts_plans','select','','');
                            foreach($plandetails_time as $solo_time) {
                                if( isset($productdetails) ) {
                                    $pos = strpos($productdetails[0]['prod_plan'] , $solo_time['plan_id']);
                                    $checked = ( $pos === false ) ? '' : 'checked' ;
                                }
                                else {
                                    $checked = '';
                                }
                                echo '<div class="th_checkbox">
                                <input type="checkbox" class="priceSettings" id="p_plan_'.$solo_time['plan_id'].'" value="'.$solo_time['plan_id'].'" '.$checked.' ><label for="p_plan_'.$solo_time['plan_id'].'">'.$solo_time['plan_name'].'</label></div><br/>';
                            }
                            ?>
                            <span class="input_help_info">This product will come under selected plan </span>
                            </div>
                        </div>

                    <?php }
                    ?>


                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Make product <b>FREE</b> for all</label>
                        </div>
                        <div class="col-lg-6 col-md-6">

                            <div class="th_footer_text">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="p_free" value="1" <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_free'] == '1') ? 'checked' : '' ; } ?> >
                                <label for="p_free"></label>

                                </div>
                                <input type="text" class="form-control" readonly value="FREE">
                                <span class="input_help_info">It will overwrite all other Price or plan settings.</span><br/>
                                <span class="input_help_info" style="color:#f0ad4e;">User can access this product after registration only.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label> Select Coupons </label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control rest_fields" id="p_coupons" >
                             <option value="">Choose one</option>
                             <?php
                             if(!empty($couponsList)) { 
                             foreach($couponsList as $solo_coup) {
                                if( isset($productdetails) ) {
                                    $selected = ($productdetails[0]['prod_coupon'] == $solo_coup['coup_code']) ? 'selected' : '' ;
                                }
                                else {
                                    $selected = '';
                                }
                                echo '<option value="'.$solo_coup['coup_code'].'" '.$selected.'>'.$solo_coup['coup_name'].' : '.$solo_coup['coup_code'].'</option>';
                              } } ?>
                            </select>
                        </div>
                    </div>

								
                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                    <?php $btnText = (isset($productdetails) ? 'UPDATE  ( Step 1 )' : 'ADD  ( Step 1 )' );?>
                            <a class="btn theme_btn" onclick="addproductsbutton(this)"><?php echo $btnText; ?></a>
                        </div>
                    </div>
                    <input type="hidden" id="oldprod_id" class="rest_fields" value="<?php echo $oldprod_id;?>">
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
