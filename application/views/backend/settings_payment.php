<div class="main_body">
	<!-- user content section -->
	<div class="theme_wrapper">
		<div class="container-fluid">
			<div class="theme_section">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="theme_page">
							<div class="theme_panel_section">


								<div class="panel-group theme_panel" id="accordion5" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="four">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
                                                Paypal <img src="<?php echo $basepath;?>adminassets/images/paypal_logo.png" style="margin-left: 56px;"/>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="four">
                                        <div class="panel-body">

            <div class="alert alert-info th_setting_text">
                <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Must Do</strong> Please enable the IPN in your paypal account</p><br/>
                <p><strong>How to get started</strong></p><br/>
                <p>1) Login to PayPal. Go to your PayPal Profile.</p><br/>
                <p>2) Click " Seller preferences".</p><br/>
                <p>3) Under " Getting paid and managing my risk ", Click on Instant Payment Notification's Update link.</p><br/>
                <p>4) Copy this URL <b><?php echo base_url(); ?>pages/paypal_ipn</b> and Paste in Notification URL box and Enable the --- Receive IPN messages.</p>
            </div>

                                            <div class="col-lg-12 col-md-12">
                <div class="th_registration_wrapper">
                <div class="th_registration_msg">

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Show paypal option to users</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="th_checkbox">
                                <input type="checkbox" id="paypal_status" class="paypalSettings" value="1" <?php echo $this->ts_functions->getsettings('paypal','status') == '1' ? 'checked' : '' ; ?>>
                                <label for="paypal_status"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-md-3">
                        <label>Paypal Email</label>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <input type="text" class="form-control paypalSettings" id="paypal_email" value="<?php echo $this->ts_functions->getsettings('paypal','email');?>">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <a onclick="updatePaymentSettings('paypalSettings')" class="btn theme_btn">UPDATE</a>
                        </div>
                    </div>

                </div>

                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="one">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion1" aria-expanded="true" aria-controls="accordion1" class="collapsed">
													PayU Money  <img src="<?php echo $basepath;?>adminassets/images/payu_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="one">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> You need to have merchant account for these details. You can contact PayUMoney using this <b>merchantcare@payumoney.com</b> </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show PayUMoney option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="payu_status" class="payuSettings" value="1"  <?php echo $this->ts_functions->getsettings('payu','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="payu_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Merchant Key</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control payuSettings" id="payu_merchantKey" value="<?php echo $this->ts_functions->getsettings('payu','merchantKey');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Merchant Salt</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control payuSettings" id="payu_merchantSalt" value="<?php echo $this->ts_functions->getsettings('payu','merchantSalt');?>">
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('payuSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="three">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion3" aria-expanded="true" aria-controls="accordion3" class="collapsed">
													Stripe  <img src="<?php echo $basepath;?>adminassets/images/stripe_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="three">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> After login to Stripe account, go to <a href="https://dashboard.stripe.com/account/apikeys"> https://dashboard.stripe.com/account/apikeys </a> </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Stripe option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="stripe_status" class="stripeSettings" value="1"  <?php echo $this->ts_functions->getsettings('stripe','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="stripe_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Live Secret Key</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control stripeSettings" id="stripe_secretKey" value="<?php echo $this->ts_functions->getsettings('stripe','secretKey');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Live Publishable Key</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control stripeSettings" id="stripe_publishableKey" value="<?php echo $this->ts_functions->getsettings('stripe','publishableKey');?>">
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('stripeSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="two">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion2" aria-expanded="true" aria-controls="accordion2" class="collapsed">
													2Checkout  <img src="<?php echo $basepath;?>adminassets/images/2checkout_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="two">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Setup you 2CheckOut account first, to enable selling.</a> </p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <a href="http://help.2checkout.com/articles/FAQ/Where-is-my-Seller-ID"> Where to find Account Number ? </a> </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show 2Checkout option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="2checkout_status" class="2checkoutSettings" value="1"  <?php echo $this->ts_functions->getsettings('2checkout','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="2checkout_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>2Checkout Account Number</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control 2checkoutSettings" id="2checkout_acntnumber" value="<?php echo $this->ts_functions->getsettings('2checkout','acntnumber');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('2checkoutSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="six">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion6" aria-expanded="true" aria-controls="accordion6" class="collapsed">
													Manual Transfer Details  <img src="<?php echo $basepath;?>adminassets/images/banktransfer_logo.png" />
												</a>
											</h4>
										</div>
										<div id="accordion6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="six">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Write down you bank details or any note which you want customer should get. </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Manual Transfer Details option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="banktransfer_status" class="banktransferSettings" value="1"  <?php echo $this->ts_functions->getsettings('banktransfer','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="banktransfer_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Manual Transfer Details</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <textarea rows="5" class="form-control banktransferSettings" id="banktransfer_details" ><?php echo $this->ts_functions->getsettings('banktransfer','details');?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('banktransferSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>



								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="seven">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion7" aria-expanded="true" aria-controls="accordion7" class="collapsed">
													Bitcoin  <img src="<?php echo $basepath;?>adminassets/images/bitcoin_logo.png"/>
												</a>
											</h4>
										</div>
										<div id="accordion7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="seven">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Setup your account on <a href="https://gourl.io/"> gourl.io </a> </p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <a href="https://gourl.io/editrecord/coin_boxes/0"> Where to create Public Key and Private Key ? </a> </p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Place this as the Callback URL : <b><?php echo $basepath;?>pages/bit_success</b>  </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Bitcoin option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="bitcoin_status" class="bitcoinSettings" value="1"  <?php echo $this->ts_functions->getsettings('bitcoin','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="bitcoin_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Public Key</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control bitcoinSettings" id="bitcoin_publickey" value="<?php echo $this->ts_functions->getsettings('bitcoin','publickey');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Private Key</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control bitcoinSettings" id="bitcoin_privatekey" value="<?php echo $this->ts_functions->getsettings('bitcoin','privatekey');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('bitcoinSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="eight">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion8" aria-expanded="true" aria-controls="accordion8" class="collapsed">
													WebMoney  <img src="<?php echo $basepath;?>adminassets/images/webmoney_logo.png"/>
												</a>
											</h4>
										</div>
										<div id="accordion8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="eight">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <p style="color:red;text-align:center;"> Please contact support team of Script to complete the integration, only for <b>WebMoney Transfer</b></p>
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> After login to your WebMoney account , Setup your account to receive payments</p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Select the purse in which you want to receive the payment.  </p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Check " Let to use URL sent in form " , so that after payment process can be handled by the application  </p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show WebMoney option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="webmoney_status" class="webmoneySettings" value="1"  <?php echo $this->ts_functions->getsettings('webmoney','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="webmoney_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Purse Unique Number</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control webmoneySettings" id="webmoney_purse" value="<?php echo $this->ts_functions->getsettings('webmoney','purse');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('webmoneySettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="nine">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion9" aria-expanded="true" aria-controls="accordion9" class="collapsed">
													Yandex  <img src="<?php echo $basepath;?>adminassets/images/yandex_logo.png"/>
												</a>
											</h4>
										</div>
										<div id="accordion9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="nine">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                        <p style="color:red;text-align:center;"> Please contact support team of Script to complete the integration, only for <b>Yandex Transfer</b></p>
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> After login to your yandex account , Setup your account to receive payments</p>
                        </div>

                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show yandex option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="yandex_status" class="yandexSettings" value="1"  <?php echo $this->ts_functions->getsettings('yandex','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="yandex_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Wallet Number</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control yandexSettings" id="yandex_wallet" value="<?php echo $this->ts_functions->getsettings('yandex','wallet');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('yandexSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>


									
									

								<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="ten">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion10" aria-expanded="true" aria-controls="accordion10" class="collapsed">
													Tpay  <img src="<?php echo $basepath;?>adminassets/images/tpay_logo.png"/>
												</a>
											</h4>
										</div>
										<div id="accordion10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ten">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                       
                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show tpay option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="tpay_status" class="tpaySettings" value="1"  <?php echo $this->ts_functions->getsettings('tpay','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="tpay_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Merchant ID</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control tpaySettings" id="tpay_merchantid" value="<?php echo $this->ts_functions->getsettings('tpay','merchantid');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('tpaySettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>
									
									
									
					<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="eleven">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion11" aria-expanded="true" aria-controls="accordion11" class="collapsed">
													Pagseguro  <img src="<?php echo $basepath;?>adminassets/images/pagseguro_logo.png"/>
												</a>
											</h4>
										</div>
										<div id="accordion11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="eleven">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">
                    
                        <div class="alert alert-info th_setting_text">
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> You need to set few things in your Pagseguro account.</p><br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Redirect URL : <b> <?php echo base_url().'pages/pagseguro_redirect'; ?></b></p> <br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Unique Key : <b> transaction_id </b></p> <br/>
                            <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please, follow the below image for help and click to zoom the image</p> <br/>
                            <p style="text-align: center;display: block;"><a href="<?php echo base_url().'adminassets/images/pagseguro_help.png'?>" target="_blank"> <img src="<?php echo base_url().'adminassets/images/pagseguro_help.png'?>" width="500" /></a></p>
                        </div>
                        
                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Pagseguro option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="pagseguro_status" class="pagseguroSettings" value="1"  <?php echo $this->ts_functions->getsettings('pagseguro','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="pagseguro_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Pagseguro's account email</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control pagseguroSettings" id="pagseguro_email" value="<?php echo $this->ts_functions->getsettings('pagseguro','email');?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Pagseguro's token</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control pagseguroSettings" id="pagseguro_token" value="<?php echo $this->ts_functions->getsettings('pagseguro','token');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('pagseguroSettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>
									
									
									
									
				<!--	<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="twelve">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion5" href="#accordion12" aria-expanded="true" aria-controls="accordion12" class="collapsed">
													Perfect Money  <img src="<?php echo $basepath;?>adminassets/images/permoney_logo.png" style="width: 175px;" />
												</a>
											</h4>
										</div>
										<div id="accordion12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="twelve">
											<div class="panel-body">
												<div class="col-lg-12 col-md-12">
                    <div class="th_registration_wrapper">                        
                    <div class="th_registration_msg">

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Show Perfect Money option to users</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="th_checkbox">
                                    <input type="checkbox" id="permoney_status" class="permoneySettings" value="1"  <?php echo $this->ts_functions->getsettings('permoney','status') == '1' ? 'checked' : '' ; ?> >
                                    <label for="permoney_status"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                            <label>Enter Perfectmoney's account to receive payments automatically</label>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control permoneySettings" id="permoney_account" value="<?php echo $this->ts_functions->getsettings('permoney','account');?>">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updatePaymentSettings('permoneySettings')" class="btn theme_btn">UPDATE</a>
                            </div>
                        </div>
                    </div>

                    </div>
												</div>
											</div>
										</div>
									</div>  -->
									
									
									
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
