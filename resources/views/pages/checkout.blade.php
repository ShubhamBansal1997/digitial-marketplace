@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('home_asset/css/carousel.css') }}">
<link id="style-main-color" rel="stylesheet" href="{{ asset('home_asset/css/colors/default.css')}}">
@endsection

@section('content')

	<!-- Section Start -->
	<section>
		<div class="container">
			<div class="container">
				<div class="row text-center">
					<p class="gap60"></p>				
					<h1 class="page-title">How would you like to pay?</h1>
					<div class="page-des">
					Pay securely with credit card or paypal.<br>Either way,you'll get to download instantly onnce payment is successful.
					</div>
				</div>
				<div class="row">

					<div class="payment_design text-center">
						<p class="gap40 m-none"></p>
						
						<!-- Payment Tabs start -->
						<div class="tab-area">
								<ul class="tabs p-none clearfix">
									<li class="box1 active">
										<a href="#card">
											<img src="{{ asset('home_asset/img/credit-card-2.png')}}">&nbsp&nbsp<span class="wallet-button">Credit Card</span>
										</a>
									</li>
									<li class="box1">
										<a href="#paypal">
											 <img src="{{ asset('home_asset/img/paypal@2x.png')}}">
										</a>
									</li>			
								</ul>
								<div class="tab-container">
									<!-- payment 1-->
									<div class="tab-content" id="card" style="display: block;">
									
									<div class="pad-amt">
											<div class="row">
												<p class="checkout-head">Your total amount is</p>
											</div>
											<div class="row">
												<p class="checkout-amt">$24</p>
											</div>
											<div class="row">
												<p class="checkout-head">Note:We dont keep your credit card details</p>
											</div>
									</div>
		
									
									<form class="form-horizontal text-left" role="form">
								<fieldset>
								<form action="/action_page.php" method="get" id="nameform">

									<div class="form-group">

										<div class="col-sm-12">
										   <p class="gap20"></p>
											<label for="fname">Card Holder</label>
											<input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
										</div>
								   
								   

										<div class="col-sm-12">
											<p class="gap20"></p>
											<label for="fname">Card Number</label>
											<input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
										</div>
									 </div>
									
									<div class="form-group">
										
										<div class="col-sm-5">
										<div class="col-xs-6 expiration-control">
												<p class="gap20 m-none"></p>
											   <label for="fname">Expiration</label>
												

													<select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
														<option>MM</option>
														<option value="01">Jan (01)</option>
														<option value="02">Feb (02)</option>
														<option value="03">Mar (03)</option>
														<option value="04">Apr (04)</option>
														<option value="05">May (05)</option>
														<option value="06">June (06)</option>
														<option value="07">July (07)</option>
														<option value="08">Aug (08)</option>
														<option value="09">Sep (09)</option>
														<option value="10">Oct (10)</option>
														<option value="11">Nov (11)</option>
														<option value="12">Dec (12)</option>
													</select>
												</div>
												<div class="col-xs-6 expiration-control">
													<p class="gap40 m-b-5"></p>
													<select class="form-control" name="expiry-year">
														<option>YY</option>
														<option value="13">2013</option>
														<option value="14">2014</option>
														<option value="15">2015</option>
														<option value="16">2016</option>
														<option value="17">2017</option>
														<option value="18">2018</option>
														<option value="19">2019</option>
														<option value="20">2020</option>
														<option value="21">2021</option>
														<option value="22">2022</option>
														<option value="23">2023</option>
													</select>
												</div>
											</div>

											<div class="col-sm-7">
											<p class="gap20 m-none"></p>
											<label for="fname">CVV</label>
												<input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
											</div>
										
									</div>
								</form>
								</fieldset>
							</form>
					
										<div class="gap40"></div>
										<p>By clicking the "PROCEED",you also agree to our LICENSE AGREEMENT.</p>
										<div class="gap40"></div>
										<div class="col-md-6 col-xs-6" style="padding-left:0px;">
											<button type="button" class="back-button">Back</button>
										</div>
									
										<div class="col-md-6 col-xs-6" style="padding-left:0px;">
											<button  type="submit" form="nameform" value="Submit" class="btn btn-primary proceed-button">Proceed</button>
										</div>
						
									</div>
									
									<!-- payment 2-->
									<div class="tab-content" id="paypal" style="display: none;">
										<div class="pad-amt">
											<div class="row">
												<p class="checkout-head">Your total amount is</p>
											</div>
											<div class="row">
												<p class="checkout-amt">$24</p>
											</div>
										   
										</div>

										<div class="gap40"></div>
										<p>By clicking the "PROCEED",you also agree to our LICENSE AGREEMENT.</p>
										<div class="gap40"></div>
										<div class="row">
										<div class="col-md-6 col-xs-6">
											<button type="button" class="back-button">Back</button>
										</div>
										<div class="col-md-6 col-xs-6">
											<button type="button" class="btn btn-primary paypal-button">PayPal Checkout</button>
										</div>
									</div>
									</div>			
								</div>
							</div>
						<!-- Payment Tabs End -->
						
						<!-- paymennt policy start -->
						<div class="account_policy">
							<div class="col-md-6">
								<div class="img-pad-margin">
									<img src="{{ asset('home_asset/img/padlock-2.png')}}">
									<h4 class="title">Your Information is Sale</h4>
									<p class="des">We will not sale or rent your personal contact
										<br>  information for any marketing purposes
										<br> whatsoever.</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="img-pad-margin">
									<img src="{{ asset('home_asset/img/shield.png')}}">
									<h4 class="title">Secure Checkout</h4>
									<p class="des">All information is encrypted and transmitted
										<br> without risk using a Secure Socket Layer
										<br> protocol. You can trust us!</p>
								</div>
							</div>
						</div>
						<!-- paymennt policy end -->
					</div>

				</div>
			</div>
		</div>
	</section>

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('home_asset/js/script.js') }}"></script>
@endsection