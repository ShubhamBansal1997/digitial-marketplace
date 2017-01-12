<script>
function open_window(url){
    var w = 880, h = 600,
        left = Number((screen.width/2)-(w/2)), tops = Number((screen.height/2)-(h/2)),
        popupWindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
    popupWindow.focus(); return false;
}
</script>
<!-- Breadcrumb wrapper Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder50 ts_bottompadder50" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="600">
	<div class="ts_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $this->ts_functions->getlanguage('checkoutheading','commontext','solo'); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrapper End -->
<!-- Cart Table wrapper Start -->
<div class="ts_cart_table_wrapper ts_toppadder100 ts_bottompadder100">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_cart_table">
					<table class="table">
						<tr>
							<th><?php echo $this->ts_functions->getlanguage('plannametext','commontext','solo'); ?></th>
							<th><?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo'); ?></th>
							<th><?php echo $this->ts_functions->getlanguage('coupontext','commontext','solo'); ?></th>
							<th><?php echo $this->ts_functions->getlanguage('canceltext','commontext','solo'); ?></th>
						</tr>
					<?php 
						$cart_total = $discount_total = array();
					if( count($cartArr) != '0' ) {
					for($i=0;$i<count($cartArr);$i++) {
					    $details = base64_decode($cartArr[$i]);
					    $detailsArr = explode('#',$details);

					    if($detailsArr[0] == 'plan') {
                            $product_details = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_id'=>$detailsArr[1]));

                            if(!empty($product_details)) { ?>
                                <tr>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('plannametext','commontext','solo'); ?>"><p><?php echo $product_details[0]['plan_name'];?></p></td>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo'); ?>"><span><small><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?></small> <?php echo $product_details[0]['plan_amount'];array_push($cart_total,$product_details[0]['plan_amount']);?></span></td>
                                    
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('coupontext','commontext','solo'); ?>"> 
                                     
                 <?php $pCode = 'prodID_'.$product_details[0]['plan_id'].'_plans'; 
                 	if(isset($_COOKIE[$pCode])) { 
                 		$disCount_arr = explode('@#',$_COOKIE[$pCode]);
                 		array_push($discount_total,$disCount_arr[0]);
                 	?>
                 			 <a id="coup_<?php echo $product_details[0]['plan_id'];?>" onclick="remove_coupon(this)" data-type="plans"> <?php echo $this->ts_functions->getlanguage('appliedtext','commontext','solo'); ?> <i class="fa fa-times"></i> </a> 
                 	<?php } else { ?>
                 			 <a id="coup_<?php echo $product_details[0]['plan_id'];?>" class="apply_coupons" data-type="plans"> <?php echo $this->ts_functions->getlanguage('applytext','commontext','solo'); ?></a> 
                 	<?php } ?>
                                     
                                     </td> 
                                     
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('canceltext','commontext','solo'); ?>"><div class="ts_cancel_btn"><a href="<?php echo $basepath;?>shop/remove_cart/<?php echo $i; ?>" class="ts_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                    </td>
                                </tr>
                        <?php  }
                        }
                        elseif($detailsArr[0] == 'vendor_plan') {
                            $product_details = $this->DatabaseModel->access_database('ts_vendorplans','select','',array('vplan_id'=>$detailsArr[1]));

                            if(!empty($product_details)) { ?>
                                <tr>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('plannametext','commontext','solo'); ?>"><p><?php echo $product_details[0]['vplan_name'];?></p></td>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo'); ?>"><span><small><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?></small> <?php echo $product_details[0]['vplan_amount'];array_push($cart_total,$product_details[0]['vplan_amount']);?></span></td>
                                     
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('coupontext','commontext','solo'); ?>"> 
                                     
                 <?php $pCode = 'prodID_'.$product_details[0]['vplan_id'].'_vplans'; 
                 	if(isset($_COOKIE[$pCode])) { 
                 		$disCount_arr = explode('@#',$_COOKIE[$pCode]);
                 		array_push($discount_total,$disCount_arr[0]);
                 	?>
                 			 <a id="coup_<?php echo $product_details[0]['vplan_id'];?>" onclick="remove_coupon(this)" data-type="vplans"> <?php echo $this->ts_functions->getlanguage('appliedtext','commontext','solo'); ?> <i class="fa fa-times"></i> </a> 
                 	<?php } else { ?>
                 			 <a id="coup_<?php echo $product_details[0]['vplan_id'];?>" class="apply_coupons" data-type="vplans"> <?php echo $this->ts_functions->getlanguage('applytext','commontext','solo'); ?></a> 
                 	<?php } ?>
                                     
                                     </td> 
                                     
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('canceltext','commontext','solo'); ?>"><div class="ts_cancel_btn"><a href="<?php echo $basepath;?>shop/remove_cart/<?php echo $i; ?>" class="ts_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                    </td>
                                </tr>
                        <?php  }
                        }
                        else {
                            $product_details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$detailsArr[1]));
                            if(!empty($product_details)) { 
                            
		        			if( $product_details[0]['prod_image'] != '' ) {
								$image_a = explode('.',$product_details[0]['prod_image']);
								$dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
								$img_style = '';
							}
							else {
								$dis_img = '';
								$img_style = 'style="width:360px;height:192px;"';
							}
						
                            ?>
                                <tr>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('plannametext','commontext','solo'); ?>"> <p> <img src="<?php echo $dis_img != '' ? $basepath.'repo/images/'.$dis_img : $basepath.'adminassets/images/white_image.jpeg' ; ?>" title="<?php echo $product_details[0]['prod_name'];?>" style="width: 150px;"> <?php echo $product_details[0]['prod_name'];?></p> </td>
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo'); ?>"><span><small><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?></small> <?php echo $product_details[0]['prod_price']; array_push($cart_total,$product_details[0]['prod_price']);?></span></td>
                                     <td data-title="<?php echo $this->ts_functions->getlanguage('coupontext','commontext','solo'); ?>"> 
                                     
                 <?php $pCode = 'prodID_'.$product_details[0]['prod_id'].'_products'; 
                 	if(isset($_COOKIE[$pCode])) { 
                 		$disCount_arr = explode('@#',$_COOKIE[$pCode]);
                 		array_push($discount_total,$disCount_arr[0]);
                 	?>
                 			 <a id="coup_<?php echo $product_details[0]['prod_id'];?>" onclick="remove_coupon(this)" data-type="products"> <?php echo $this->ts_functions->getlanguage('appliedtext','commontext','solo'); ?> <i class="fa fa-times"></i> </a> 
                 	<?php } else { ?>
                 			 <a id="coup_<?php echo $product_details[0]['prod_id'];?>" class="apply_coupons" data-type="products"> <?php echo $this->ts_functions->getlanguage('applytext','commontext','solo'); ?></a> 
                 	<?php } ?>
                                     
                                     </td> 
                                    <td data-title="<?php echo $this->ts_functions->getlanguage('canceltext','commontext','solo'); ?>"><div class="ts_cancel_btn"><a href="<?php echo $basepath;?>shop/remove_cart/<?php echo $i; ?>" class="ts_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                    </td>
                                </tr>
                         <?php }
                        }
					 }  }
					 else {
					 	echo '<tr> <input type="hidden" id="prod_count" value="0"></tr>';
					 }?>
					</table>
				</div>
				<div class="ts_total_section">
				<div class="ts_total_box">
					<ul>
						<li><?php echo $this->ts_functions->getlanguage('carttotaltext','commontext','solo'); ?>  <span>$ <?php echo array_sum($cart_total);?></span></li>
						<li><?php echo $this->ts_functions->getlanguage('coupdiscounttext','commontext','solo'); ?> <span class="discount_total">$ <?php echo array_sum($discount_total);?></span></li>
						<li><?php echo $this->ts_functions->getlanguage('finalamounttext','commontext','solo'); ?> <span class="paid_total">$ <?php echo array_sum($cart_total) - array_sum($discount_total);?></span></li>
					</ul>
				</div>
				</div>
				<a href="<?php echo $basepath;?>" class="ts_btn"><?php echo $this->ts_functions->getlanguage('continueshopbtn','commontext','solo'); ?></a>
				<a class="ts_btn pull-right" id="checkoutBtnCart"><?php echo $this->ts_functions->getlanguage('checkoutbtn','commontext','solo'); ?></a>
			</div>
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
			    <?php if( !isset($this->session->userdata['ts_uid']) ) { ?>
                    <!-- Login box -->
                    <div class="ts_login_box ts_cmn_checkoutbox hideme" id="login_checkoutbox">
                    	
                    	<div class="social_access">
							<div class="row">
							<?php if( $this->ts_functions->getsettings('fbcartlogin','checkbox') == '1' ) { ?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button onclick="open_window('<?php echo $basepath;?>authenticate/facebooklogin');" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('fbtext','authentication','solo');?> </button>
								</div>
							 <?php } if( $this->ts_functions->getsettings('googlecartlogin','checkbox') == '1' ) { ?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button onclick="open_window('<?php echo $basepath;?>authenticate/googlelogin');" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('googletext','authentication','solo');?></button>
								</div>
							<?php } ?>
							</div>  
						</div> 
	
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('logusernametext','authentication','solo');?>" id="users_uname" class="form-control cartloginfields" value="<?php if(isset($_COOKIE['ts_emanu'])){ echo $_COOKIE['ts_emanu'];} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" class="form-control cartloginfields" value="<?php if(isset($_COOKIE['ts_dwp'])){ echo $_COOKIE['ts_dwp'];} ?>">
                                </div>
                            </div>
                            <a class="ts_btn pull-right" onclick="loginfromcartpage();" > <?php echo $this->ts_functions->getlanguage('logintext','commontext','solo'); ?>  <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>
                            <div class="ts_links"><?php echo $this->ts_functions->getlanguage('logbottomtext','authentication','solo');?> <a class="authenticateBtnCart" data-type="register"> <?php echo $this->ts_functions->getlanguage('logbottomhreftext','authentication','solo');?></a></div>
                        </form>
                    </div>

                    <!-- Register box -->
                    <div class="ts_login_box ts_cmn_checkoutbox hideme" id="register_checkoutbox">
                    
                    	<div class="social_access">
							<div class="row">
							<?php if( $this->ts_functions->getsettings('fbcartlogin','checkbox') == '1' ) { ?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button onclick="open_window('<?php echo $basepath;?>authenticate/facebooklogin');" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('fbtext','authentication','solo');?> </button>
								</div>
							 <?php } if( $this->ts_functions->getsettings('googlecartlogin','checkbox') == '1' ) { ?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<button onclick="open_window('<?php echo $basepath;?>authenticate/googlelogin');" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i><?php echo $this->ts_functions->getlanguage('googletext','authentication','solo');?></button>
								</div>
							<?php } ?>
							</div>  
						</div> 
						
						
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regusernametext','authentication','solo');?>" id="reg_uname" class="form-control cartregisterfields">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regemailtext','authentication','solo');?>" id="reg_email" class="form-control cartregisterfields">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="reg_pwd" class="form-control cartregisterfields">
                                </div>
                            </div>
                            <a class="ts_btn pull-right" onclick="registerfromcartpage();" > <?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo'); ?>  <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>
                            <div class="ts_links">
<?php echo $this->ts_functions->getlanguage('regbottomtext','authentication','solo');?><a class="authenticateBtnCart" data-type="login"> <?php echo $this->ts_functions->getlanguage('regbottomhreftext','authentication','solo');?></a>
                            </div>
                        </form>
                    </div>
				<?php } ?>
				<div class="ts_payment_box ts_cmn_checkoutbox hideme" id="payment_checkoutbox">
					<h4> <?php echo $this->ts_functions->getlanguage('paymentboxheading','commontext','solo'); ?> </h4>


					<select class="paymentmethod">
					    <?php if ( $this->ts_functions->getsettings('paypal','status') == '1' ) { ?>
						<option value="paypal"> Paypal</option>
					<?php } if ( $this->ts_functions->getsettings('payu','status') == '1' ) { ?>
						<option value="payu"> PayU Money</option>
					<?php }  if ( $this->ts_functions->getsettings('stripe','status') == '1' ) { ?>
					    <option value="stripe">Stripe</option>
					<?php }  if ( $this->ts_functions->getsettings('2checkout','status') == '1' ) { ?>
					    <option value="2checkout">2checkout</option>
					<?php }  if ( $this->ts_functions->getsettings('banktransfer','status') == '1' ) { ?>
					    <option value="banktransfer">Manual Transfer</option>
					<?php } if ( $this->ts_functions->getsettings('bitcoin','status') == '1' ) { ?>
					    <option value="bitcoin">Bitcoin</option>
					<?php } if ( $this->ts_functions->getsettings('webmoney','status') == '1' ) { ?>
					    <option value="webmoney">WebMoney</option>
					<?php } if ( $this->ts_functions->getsettings('yandex','status') == '1' ) { ?>
					    <option value="yandex">Yandex</option>
					<?php } if ( $this->ts_functions->getsettings('tpay','status') == '1' ) { ?>
					    <option value="tpay">Tpay</option>
					<?php } if ( $this->ts_functions->getsettings('pagseguro','status') == '1' ) { ?>
					    <option value="pagseguro">Pagseguro</option>
					<?php } if ( $this->ts_functions->getsettings('permoney','status') == '7' ) { ?>
					    <option value="permoney">Perfect Money</option>
					<?php }?>
					<?php if($this->session->userdata['ts_level'] == 3) {
					    echo '<option value="wallet">Wallet Credit</option>';
					} ?>
					</select>

					<?php if ( $this->ts_functions->getsettings('paypal','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/paypal_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('payu','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/payu_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('stripe','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/stripe_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('2checkout','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/2checkout_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('banktransfer','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/banktransfer_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('bitcoin','status') == '1' ) { ?>
						<img src="<?php echo $basepath;?>themes/default/images/bitcoin_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('webmoney','status') == '1' ) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/webmoney_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('yandex','status') == '1' ) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/yandex_logo.png" class="paymentmethod_cls" style="width: 140px;"/>
					<?php } elseif ( $this->ts_functions->getsettings('tpay','status') == '1' ) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/tpay_logo.png" class="paymentmethod_cls" />
					<?php } elseif ( $this->ts_functions->getsettings('pagseguro','status') == '1' ) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/pagseguro_logo.png" class="paymentmethod_cls" />
					<?php }  elseif ( $this->ts_functions->getsettings('permoney','status') == '7' ) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/permoney_logo.png" class="paymentmethod_cls" />
					<?php } else { ?>
					<?php if($this->session->userdata['ts_level'] == 3) { ?>
					    <img src="<?php echo $basepath;?>themes/default/images/wallet_logo.png" class="paymentmethod_cls" />
					<?php }
					} ?>


					<a onclick="initiatepayment();" class="ts_btn pull-right"> <?php echo $this->ts_functions->getlanguage('paymentboxbtn','commontext','solo'); ?>  <i class="fa fa-spinner fa-spin ts_proceed_wait hideme" aria-hidden="true"></i></a>
				</div>
				<div id="pay_form_box" style="text-align:center;">

				</div>
			</div>
		</div>
	</div>
</div>
<?php if( isset($this->session->userdata['ts_uid']) ) { ?>
<input type="hidden" value="1" id="whetherlogin" />
<?php } else { ?>
<input type="hidden" value="0" id="whetherlogin" />
<?php } ?>

<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('activateerror','message','solo');?>" id="actvtacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('blockederror','message','solo');?>" id="blockacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginerror','message','solo');?>" id="loginerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginsuc','message','solo');?>" id="loginsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('emptycart','message','solo');?>" id="emptycart_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('password','message','solo');?>" id="pwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('usernameexists','message','solo');?>" id="usernameexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('registersuc','message','solo');?>" id="registersuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('emailexists','message','solo');?>" id="emailexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('coupemptyerr','message','solo');?>" id="coupemptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('coupincorrecterr','message','solo');?>" id="coupincorrecterr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('coupexpirederr','message','solo');?>" id="coupexpirederr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('coupsuccess','message','solo');?>" id="coupsuccess_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('coupremoved','message','solo');?>" id="coupremoved_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('appliedtext','commontext','solo');?>" id="appliedtext_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('applytext','commontext','solo');?>" id="applytext_text">
<!-- Cart Table wrapper End -->

<div class="modal fade" id="apply_coupons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title"><?php echo $this->ts_functions->getlanguage('entercouptext','commontext','solo'); ?> </h4>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" id="coup_code_text">
			</div>
			<div class="modal-footer">
			    				<button type="button" class="ts_btn coup_code_btn"><?php echo $this->ts_functions->getlanguage('applytext','commontext','solo'); ?></button>
			</div>
		</div>
  </div>
</div>