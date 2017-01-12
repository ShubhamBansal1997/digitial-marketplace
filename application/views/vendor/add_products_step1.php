<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">
<?php $topText = (isset($productdetails) ? $this->ts_functions->getlanguage('updateprodstep1text','vendorboard','solo') : $this->ts_functions->getlanguage('addprodstep1text','vendorboard','solo') );?>
    <div class="theme_panel_section">
                    <h4 class="th_title">
                    <?php echo $topText;?>
                    </h4>
                <div class="th_content_section">
                
     <div class="alert alert-info th_setting_text">
		<p><i style="color:red;" class="fa fa-bell" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('addprodnoticetext','vendorboard','solo');?> (<b style="color:red;">*</b>) .</p>
	</div>
								           
                	<div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('aptypetext','vendorboard','solo');?> <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
							<select class="form-control productfields" id="p_type">
								<option value="0"><?php echo $this->ts_functions->getlanguage('aptypetext','vendorboard','solo');?></option>
								<option value="Audio" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Audio') ? 'selected' : ''  : '' ; ?>><?php echo $this->ts_functions->getlanguage('apaudiotext','vendorboard','solo');?></option>
								<option value="Video" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Video') ? 'selected' : ''  : '' ; ?>><?php echo $this->ts_functions->getlanguage('apvideotext','vendorboard','solo');?></option>
								<option value="Text" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Text') ? 'selected' : ''  : '' ; ?>><?php echo $this->ts_functions->getlanguage('aptexttext','vendorboard','solo');?></option>
								<option value="Other" <?php echo isset($productdetails) ? ($productdetails[0]['prod_type'] == 'Other') ? 'selected' : ''  : '' ; ?>><?php echo $this->ts_functions->getlanguage('apothertext','vendorboard','solo');?></option>
							</select>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('apnametext','vendorboard','solo');?> <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" id="p_name" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_name']; } ?>">
                            <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('apnamehelptext','vendorboard','solo');?> </span>
                            <span class="p_name_counter name_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_name']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('apurlnametext','vendorboard','solo');?> <b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control productfields" id="p_urlname" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_urlname']; } ?>">
                            <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('apurlhelp1text','vendorboard','solo');?> <br/> <?php echo $this->ts_functions->getlanguage('apurlhelp2text','vendorboard','solo');?> </span>
                            <span class="p_name_counter urlname_counter"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_urlname']); } else { echo 80;} ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('prodcatetext','vendorboard','solo');?><b style="color:red;">*</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control productfields" id="p_category" onchange="getSubCategories(this)">
                             <option value="0"><?php echo $this->ts_functions->getlanguage('choosetext','vendorboard','solo');?></option>
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
                            <label><?php echo $this->ts_functions->getlanguage('prodsubcatetext','vendorboard','solo');?></label>
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
                             <option value="0"><?php echo $this->ts_functions->getlanguage('choosetext','vendorboard','solo');?></option>
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
                            <label><?php echo $this->ts_functions->getlanguage('prevlinktext','vendorboard','solo');?></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control rest_fields" id="p_demourl" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_demourl']; } ?>"  placeholder="http://">
                        </div>
                    </div>

                   <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('tagstext','vendorboard','solo');?></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control rest_fields" id="p_tags"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_tags']; } ?></textarea>
                            <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('taghelptext','vendorboard','solo');?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('desctext','vendorboard','solo');?></label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <textarea rows="8" class="form-control rest_fields" id="p_description"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_description']; } ?></textarea>
                            <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('deschelptext','vendorboard','solo');?></span>
                        </div>
                    </div>

                    
                    <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label><?php echo $this->ts_functions->getlanguage('proddownlinktext','vendorboard','solo');?></label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control rest_fields" placeholder="http://" id="p_downlink" value="<?php if(isset($productdetails)) {  if( strpos($productdetails[0]['prod_filename'],'/') !== false ) { echo $productdetails[0]['prod_filename']; } } ?>">
                                <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('proddownhelptext','vendorboard','solo');?>  </span>
                            </div>
                        </div>
                        
                    <div class="form-group">
						<div class="col-lg-3 col-md-3">
							<label><?php echo $this->ts_functions->getlanguage('proddownpasswordtext','vendorboard','solo');?></label>
						</div>
						<div class="col-lg-6 col-md-6">
							<input type="text" class="form-control rest_fields" id="p_downpassword" value="<?php if(isset($productdetails)) {  echo $productdetails[0]['prod_downloadpassword']; }  ?>">
							<span class="input_help_info"><?php echo $this->ts_functions->getlanguage('proddownpasswordhelptext','vendorboard','solo');?>  </span>
						</div>
					</div>



                    <?php
                        $revenueModel = $this->ts_functions->getsettings('portal','revenuemodel');
                        if( $revenueModel == 'singlecost') {
                            // Single Cost
                        ?>

                          <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label><?php echo $this->ts_functions->getlanguage('pricetext','vendorboard','solo');?> <b style="color:red;">*</b></label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control" id="p_price" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_price']; } ?>">
                                <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('pricehelptext','vendorboard','solo');?> </span>
                            </div>
                        </div>

                    <?php } else { ?>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label><?php echo $this->ts_functions->getlanguage('planstext','vendorboard','solo');?> <b style="color:red;">*</b></label>
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
                            <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('planhelptext','vendorboard','solo');?></span>
                            </div>
                        </div>

                    <?php }
                    ?>


                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label><?php echo $this->ts_functions->getlanguage('apfreetext','vendorboard','solo');?></label>
                        </div>
                        <div class="col-lg-6 col-md-6">

                            <div class="th_footer_text">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="p_free" value="1" <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_free'] == '1') ? 'checked' : '' ; } ?> >
                                <label for="p_free"></label>

                                </div>
                                <input type="text" class="form-control" readonly value="<?php echo $this->ts_functions->getlanguage('freetext','commontext','solo');?>">
                                <span class="input_help_info"><?php echo $this->ts_functions->getlanguage('apfreehelp1text','vendorboard','solo');?></span><br/>
                                <span class="input_help_info" style="color:#f0ad4e;"><?php echo $this->ts_functions->getlanguage('apfreehelp2text','vendorboard','solo');?></span>
                            </div>
                        </div>
                    </div>

								
                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                    <?php $btnText = (isset($productdetails) ? $this->ts_functions->getlanguage('apbtn1text','vendorboard','solo') : $this->ts_functions->getlanguage('apbtn2text','vendorboard','solo') );?>
                            <a class="btn theme_btn" onclick="addproductsbutton_vendors(this)"><?php echo $btnText; ?></a>
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


<input type="hidden" id="urlnameerror" value="<?php echo $this->ts_functions->getlanguage('urlnameerror','vendorboard','solo');?>">
<input type="hidden" id="starfielderror" value="<?php echo $this->ts_functions->getlanguage('starfielderror','vendorboard','solo');?>">
<input type="hidden" id="prodnameerror" value="<?php echo $this->ts_functions->getlanguage('prodnameerror','vendorboard','solo');?>">
<input type="hidden" id="urllengtherror" value="<?php echo $this->ts_functions->getlanguage('urllengtherror','vendorboard','solo');?>">
<input type="hidden" id="freetexterror" value="<?php echo $this->ts_functions->getlanguage('freetexterror','vendorboard','solo');?>">
<input type="hidden" id="freetext2error" value="<?php echo $this->ts_functions->getlanguage('freetext2error','vendorboard','solo');?>">
<input type="hidden" id="inputvalueserror" value="<?php echo $this->ts_functions->getlanguage('inputvalueserror','vendorboard','solo');?>">
<input type="hidden" id="validlinkerror" value="<?php echo $this->ts_functions->getlanguage('validlinkerror','vendorboard','solo');?>">
<input type="hidden" id="pricenumberrror" value="<?php echo $this->ts_functions->getlanguage('pricenumberrror','vendorboard','solo');?>">
<input type="hidden" id="checksubcatetext" value="<?php echo $this->ts_functions->getlanguage('checksubcatetext','vendorboard','solo');?>">
<input type="hidden" id="checksubcateerror" value="<?php echo $this->ts_functions->getlanguage('checksubcateerror','vendorboard','solo');?>">
<input type="hidden" id="checkcateerror" value="<?php echo $this->ts_functions->getlanguage('checkcateerror','vendorboard','solo');?>">
