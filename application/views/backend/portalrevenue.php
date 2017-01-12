<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">

    <div class="theme_panel_section">
                    <h4 class="th_title">
                    Portal Revenue
                    </h4>
                <div class="th_content_section">

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Currency</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control revenuefields" id="portal_curreny" value="<?php echo $this->ts_functions->getsettings('portal','curreny');?>" maxlength=3>
                            <span class="input_help_info">This will be used for transactions with Paypal. Use specific currency code. <a href="https://developer.paypal.com/docs/classic/mass-pay/integration-guide/currency_codes/">Click here to get the list.</a></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Currency Symbol</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control revenuefields" id="portalcurreny_symbol" value="<?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?>">
                            <span class="input_help_info">This will be displayed with product price.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Revenue Model</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <select class="form-control revenuefields" id="portal_revenuemodel">
                                <option value="singlecost" <?php echo ($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost') ? 'selected' : '' ; ?>> Single Cost </option>
                                <option value="subscription" <?php echo ($this->ts_functions->getsettings('portal','revenuemodel') == 'subscription') ? 'selected' : '' ; ?>> Member Subscription </option>
                            </select>
                            <span class="input_help_info">To have Multi-Vendor site, you need to have <b>Single Cost</b> revenue model.</span>
                        </div>
                    </div>

                    <div class="subscription_type <?php echo ($this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost') ? '' : 'hideme' ; ?>">
                        <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Marketplace type</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <select class="form-control revenuefields" id="marketplace_typevendor">
                                <option value="single" <?php echo ($this->ts_functions->getsettings('marketplace','typevendor') == 'single') ? 'selected' : '' ; ?>> Single Vendor </option>
                                <option value="multi" <?php echo ($this->ts_functions->getsettings('marketplace','typevendor') == 'multi') ? 'selected' : '' ; ?>> Multi Vendor </option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <?php
                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi' ) {
                            $hdCls = '';
                        } else  {
                            $hdCls = 'hideme';
                        }
                    ?>
                    <div class="marketplace_vendortype <?php echo $hdCls; ?>">
                        <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Vendor revenue model</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <select class="form-control revenuefields" id="vendor_revenuemodel">
                                <option value="commission" <?php echo ($this->ts_functions->getsettings('vendor','revenuemodel') == 'commission') ? 'selected' : '' ; ?>> Commission </option>
                                <option value="plans" <?php echo ($this->ts_functions->getsettings('vendor','revenuemodel') == 'plans') ? 'selected' : '' ; ?>> Plans </option>
                            </select>
                        </div>
                    </div>
                    </div>

                    <?php
                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi' && $this->ts_functions->getsettings('vendor','revenuemodel') == 'commission' ) {
                            $hdCls = '';
                        } else  {
                            $hdCls = 'hideme';
                        }
                    ?>

                    <!-- Set commissions for Vendor STARTS -->
                    <div class="marketvendor_commission <?php echo $hdCls; ?>">
                        <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label>Vendor commission</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control revenuefields" id="vendor_commission" value="<?php echo $this->ts_functions->getsettings('vendor','commission'); ?>">
                            <span class="input_help_info">Should be the number without % symbol.<br/></span><span class="input_help_info" style="color: #F4511E;">This will be commission, Vendor will get on his every sale.</span>
                        </div>
                    </div>
                    </div>
                    <!-- Set commissions for Vendor ENDS -->

                    <!-- Product Selling Plans STARTS -->
                    <div class="plan_products_section <?php echo ($this->ts_functions->getsettings('portal','revenuemodel') == 'subscription') ? '' : 'hideme' ; ?>">
                        <h2 class="th_heading"> Edit plans of Selling products</h2>

                        <div class="plan_section_div">
                        <?php $counter = 0;
                        foreach($plandetails as $solo_time) {
                            $counter++;
                            $uniqid = $solo_time['plan_id'];
                        ?>
                        <h3 class="th_subheading pHeading" id="p_<?php echo $counter; ?>"> Product Plan <?php echo $counter; ?>
                        <!-- <a href="#" class="btn theme_btn delete_btn"><i class="fa fa-trash" aria-hidden="true"></i></a> --> </h3>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product Plan name</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control timetype_input" id="plan_name#<?php echo $uniqid;?>" value="<?php echo $solo_time['plan_name'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product Plan amount</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control timetype_input" id="plan_amount#<?php echo $uniqid;?>" value="<?php echo $solo_time['plan_amount'];?>">
                                <span class="input_help_info">Don't include currency symbol</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product Plan product access duration</label>
                            </div>
                            <?php $planDuration = explode(' ',$solo_time['plan_duration']);?>
                            <div class="col-lg-3 col-md-3">
                                <select class="form-control timetype_input" id="plan_duration#num#<?php echo $uniqid;?>">
                                    <option value="Life Time" <?php echo ( $planDuration[0] == 'Life' ) ? 'selected' : '' ;?>>Life Time</option>
                                <?php for($i=1;$i<31;$i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo ( $planDuration[0] == $i ) ? 'selected' : '' ;?>><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
							</div>
							<div class="col-lg-3 col-md-3">
                                <select class="form-control timetype_input" id="plan_duration#period#<?php echo $uniqid;?>">
                                    <option value="" <?php echo ( $planDuration[1] == 'Time' ) ? 'selected' : '' ;?>> -- </option>
                                    <option value="Days" <?php echo ( $planDuration[1] == 'Days' ) ? 'selected' : '' ; ?>>Days</option>
                                    <option value="Weeks" <?php echo ( $planDuration[1] == 'Weeks' ) ? 'selected' : '' ; ?>>Weeks</option>
                                    <option value="Months" <?php echo ( $planDuration[1] == 'Months' ) ? 'selected' : '' ; ?>>Months</option>
                                    <option value="Years" <?php echo ( $planDuration[1] == 'Years' ) ? 'selected' : '' ; ?>>Years</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Number of Product download</label>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <select class="form-control timetype_input" id="plan_product#type#<?php echo $uniqid;?>" onchange="checkplanprod(this)">
                                    <option value="All" <?php echo $solo_time['plan_product'] == 'All' ? 'selected' : '' ; ?>>All</option>
                                    <option value="limited" <?php echo $solo_time['plan_product'] != 'All' ? 'selected' : '' ; ?>>Limited</option>
                                </select>
							</div>
							<div class="col-lg-3 col-md-3">
                                <input type="text" class="form-control timetype_input" id="plan_product#num#<?php echo $uniqid;?>" data-type="planNum_<?php echo $uniqid;?>" value="<?php echo $solo_time['plan_product'];?>" <?php if ($solo_time['plan_product'] == 'All') {  ?>style="display:none;" <?php } ?>>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product Plan features</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <textarea rows="8" class="form-control timetype_input" id="plan_features#<?php echo $uniqid;?>"> <?php echo $solo_time['plan_features'];?> </textarea>
                                <span class="input_help_info">Separate each feature by new line</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Product Plan status</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <select class="form-control timetype_input" id="plan_status#<?php echo $uniqid;?>">
                                    <option value="1" <?php echo ($solo_time['plan_status'] == 1) ? 'selected' : '' ; ?>>On</option>
                                    <option value="0" <?php echo ($solo_time['plan_status'] == 0) ? 'selected' : '' ; ?>>Off</option>
                                </select>
                                <span class="input_help_info">Customer will not see if its Off</span>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label> Select Coupons </label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control timetype_input" id="plan_coupon#<?php echo $uniqid;?>" >
                             <option value="">Choose one</option>
                             <?php
                             if(!empty($couponsList)) { 
                             foreach($couponsList as $solo_coup) {
                                $selected = ($solo_time['plan_coupon'] == $solo_coup['coup_code']) ? 'selected' : '' ;
                                
                                echo '<option value="'.$solo_coup['coup_code'].'" '.$selected.'>'.$solo_coup['coup_name'].' : '.$solo_coup['coup_code'].'</option>';
                              } } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                        <?php } ?>
                        </div>

                    </div>
                    <!-- Product Selling Plans ENDS -->

                    <?php
                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi' && $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans' ) {
                            $hdCls = '';
                        } else  {
                            $hdCls = 'hideme';
                        }
                    ?>

                   <!-- Vendor Subscription Plans STARTS -->
                    <div class="plan_vendor_section <?php echo $hdCls; ?>">
                        <h2 class="th_heading"> Edit plans of Vendor Subscription</h2>

                        <div class="vplan_section_div">
                        <?php $counter = 0;
                        foreach($vendorplandetails as $solo_vplan) {
                            $counter++;
                            $uniqid = $solo_vplan['vplan_id'];
                        ?>
                        <h3 class="th_subheading vpHeading" id="vp_<?php echo $counter; ?>"> Vendor Plan <?php echo $counter; ?>
                        <!-- <a href="#" class="btn theme_btn delete_btn"><i class="fa fa-trash" aria-hidden="true"></i></a> --> </h3>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Vendor Plan name</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control vendortype_input" id="vplan_name#<?php echo $uniqid;?>" value="<?php echo $solo_vplan['vplan_name'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Vendor Plan amount</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" class="form-control vendortype_input" id="vplan_amount#<?php echo $uniqid;?>" value="<?php echo $solo_vplan['vplan_amount'];?>">
                                <span class="input_help_info">Don't include currency symbol</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Vendor Plan product access duration</label>
                            </div>
                            <?php $planDuration = explode(' ',$solo_vplan['vplan_duration']);?>
                            <div class="col-lg-3 col-md-3">
                                <select class="form-control vendortype_input" id="vplan_duration#num#<?php echo $uniqid;?>">
                                    <option value="Life Time" <?php echo ( $planDuration[0] == 'Life' ) ? 'selected' : '' ;?>>Life Time</option>
                                <?php for($i=1;$i<31;$i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo ( $planDuration[0] == $i ) ? 'selected' : '' ;?>><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
							</div>
							<div class="col-lg-3 col-md-3">
                                <select class="form-control vendortype_input" id="vplan_duration#period#<?php echo $uniqid;?>">
                                    <option value="" <?php echo ( $planDuration[1] == 'Time' ) ? 'selected' : '' ;?>> -- </option>
                                    <option value="Days" <?php echo ( $planDuration[1] == 'Days' ) ? 'selected' : '' ; ?>>Days</option>
                                    <option value="Weeks" <?php echo ( $planDuration[1] == 'Weeks' ) ? 'selected' : '' ; ?>>Weeks</option>
                                    <option value="Months" <?php echo ( $planDuration[1] == 'Months' ) ? 'selected' : '' ; ?>>Months</option>
                                    <option value="Years" <?php echo ( $planDuration[1] == 'Years' ) ? 'selected' : '' ; ?>>Years</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Vendor Plan features</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <textarea rows="8" class="form-control vendortype_input" id="vplan_features#<?php echo $uniqid;?>"> <?php echo $solo_vplan['vplan_features'];?> </textarea>
                                <span class="input_help_info">Separate each feature by new line</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Vendor Plan status</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <select class="form-control vendortype_input" id="vplan_status#<?php echo $uniqid;?>">
                                    <option value="1" <?php echo ($solo_vplan['vplan_status'] == 1) ? 'selected' : '' ; ?>>On</option>
                                    <option value="0" <?php echo ($solo_vplan['vplan_status'] == 0) ? 'selected' : '' ; ?>>Off</option>
                                </select>
                                <span class="input_help_info">Customer will not see if its Off</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                            <label> Select Vendor Coupons </label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                             <select class="form-control vendortype_input" id="vplan_coupon#<?php echo $uniqid;?>" >
                             <option value="">Choose one</option>
                             <?php
                             if(!empty($couponsList)) { 
                             foreach($couponsList as $solo_coup) {
                                $selected = ($solo_vplan['vplan_coupon'] == $solo_coup['coup_code']) ? 'selected' : '' ;
                                
                                echo '<option value="'.$solo_coup['coup_code'].'" '.$selected.'>'.$solo_coup['coup_name'].' : '.$solo_coup['coup_code'].'</option>';
                              } } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                        <?php } ?>
                        </div>

                    </div>
                    <!-- Vendor Subscription Plans ENDS -->


                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <a class="btn theme_btn portalBtn" id="update_revenuemodel">UPDATE</a>
                            <a class="btn theme_btn green_btn prod_plan_btn <?php echo ($this->ts_functions->getsettings('portal','revenuemodel') != 'subscription') ? 'hideme' : '' ; ?>" onclick="addnewplan('products')">add product plans</a>

                    <?php
                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'singlecost' && $this->ts_functions->getsettings('marketplace','typevendor') == 'multi' && $this->ts_functions->getsettings('vendor','revenuemodel') == 'plans' ) {
                            $hdCls = '';
                        } else  {
                            $hdCls = 'hideme';
                        }
                    ?>

                            <a class="btn theme_btn green_btn vend_plan_btn <?php echo $hdCls; ?>" onclick="addnewplan('vendor')">add vendor plans</a>
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


<div style="display:none;" id="plan_html_content"> <h3 class="th_subheading" id="p_CNUM"> Product Plan CNUM </h3> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Product Plan name</label> </div> <div class="col-lg-6 col-md-6"> <input type="text" class="form-control timetype_input" id="plan_name#UNIQNUM" value=""> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Product Plan amount</label> </div> <div class="col-lg-6 col-md-6"> <input type="text" class="form-control timetype_input" id="plan_amount#UNIQNUM" value=""> <span class="input_help_info">Don't include currency symbol</span> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Product Plan product access duration</label> </div> <div class="col-lg-3 col-md-3"> <select class="form-control timetype_input" id="plan_duration#num#UNIQNUM"> <option value="Life Time">Life Time</option> <?php for($i=1;$i<31;$i++){ ?> <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option> <?php } ?> </select> </div> <div class="col-lg-3 col-md-3"> <select class="form-control timetype_input" id="plan_duration#period#UNIQNUM"> <option value=""> -- </option> <option value="Days">Days</option> <option value="Weeks">Weeks</option> <option value="Months">Months</option> <option value="Years">Years</option> </select> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Number of Product download</label> </div> <div class="col-lg-3 col-md-3"> <select class="form-control timetype_input" id="plan_product#type#UNIQNUM" onchange="checkplanprod(this)"> <option value="All">All</option> <option value="limited">Limited</option> </select> </div> <div class="col-lg-3 col-md-3"> <input type="text" class="form-control timetype_input" id="plan_product#num#UNIQNUM" data-type="planNum_UNIQNUM" value="" style="display:none;"> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Product Plan features</label> </div> <div class="col-lg-6 col-md-6"> <textarea rows="8" class="form-control timetype_input" id="plan_features#UNIQNUM"></textarea> <span class="input_help_info">Separate each feature by new line</span> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Product Plan status</label> </div> <div class="col-lg-6 col-md-6"> <select class="form-control timetype_input" id="plan_status#UNIQNUM"> <option value="1">On</option> <option value="0">Off</option> </select> <span class="input_help_info">Customer will not see if its Off</span> </div> </div> <div class="form-group"><div class="col-lg-3 col-md-3"><label> Select Coupons </label></div><div class="col-lg-6 col-md-6"> <select class="form-control timetype_input" id="plan_coupon#UNIQNUM" > <option value="">Choose one</option> <?php if(!empty($couponsList)) { foreach($couponsList as $solo_coup) {echo '<option value="'.$solo_coup['coup_code'].'" '.$selected.'>'.$solo_coup['coup_name'].' : '.$solo_coup['coup_code'].'</option>'; } } ?></select></div></div></div>



<div style="display:none;" id="vplan_html_content"> <h3 class="th_subheading" id="vp_CNUM"> Vendor Plan CNUM </h3> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Vendor Plan name</label> </div> <div class="col-lg-6 col-md-6"> <input type="text" class="form-control vendortype_input" id="vplan_name#UNIQNUM" value=""> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Vendor Plan amount</label> </div> <div class="col-lg-6 col-md-6"> <input type="text" class="form-control vendortype_input" id="vplan_amount#UNIQNUM" value=""> <span class="input_help_info">Don't include currency symbol</span> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Vendor Plan product access duration</label> </div> <div class="col-lg-3 col-md-3"> <select class="form-control vendortype_input" id="vplan_duration#num#UNIQNUM"> <option value="Life Time">Life Time</option> <?php for($i=1;$i<31;$i++){ ?> <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option> <?php } ?> </select> </div> <div class="col-lg-3 col-md-3"> <select class="form-control vendortype_input" id="vplan_duration#period#UNIQNUM"> <option value=""> -- </option> <option value="Days">Days</option> <option value="Weeks">Weeks</option> <option value="Months">Months</option> <option value="Years">Years</option> </select> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Vendor Plan features</label> </div> <div class="col-lg-6 col-md-6"> <textarea rows="8" class="form-control vendortype_input" id="vplan_features#UNIQNUM"></textarea> <span class="input_help_info">Separate each feature by new line</span> </div> </div> <div class="form-group"> <div class="col-lg-3 col-md-3"> <label>Vendor Plan status</label> </div> <div class="col-lg-6 col-md-6"> <select class="form-control vendortype_input" id="vplan_status#UNIQNUM"> <option value="1">On</option> <option value="0">Off</option> </select> <span class="input_help_info">Customer will not see if its Off</span> </div> </div> <div class="form-group"><div class="col-lg-3 col-md-3"><label> Select Vendor Coupons </label></div><div class="col-lg-6 col-md-6"> <select class="form-control vendortype_input" id="vplan_coupon#UNIQNUM" > <option value="">Choose one</option> <?php if(!empty($couponsList)) { foreach($couponsList as $solo_coup) {echo '<option value="'.$solo_coup['coup_code'].'" '.$selected.'>'.$solo_coup['coup_name'].' : '.$solo_coup['coup_code'].'</option>'; } } ?></select></div></div></div>
