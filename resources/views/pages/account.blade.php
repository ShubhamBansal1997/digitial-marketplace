@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('home_asset/css/carousel.css') }}">
<link rel="stylesheet" href="{{ asset('home_asset/css/cs-select.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('home_asset/css/cs-skin-elastic.css')}}" type="text/css"/>
@endsection

@section('content')
<!-- Section Start -->
	<section>
		<div class="container">
			<div class="container">
				<div class="gap60"></div>		
				
				<div class="tab-box">
					<div class="tab-area">
						<ul class="tabs-menu user-info-tabs">
							<li class="active-tab"><a href="#settings">Profile</a></li>
							<li class=""><a href="#purchases">Purchase Products <span class="badge badge-green">2</span></a></li>
							<li class=""><a href="#services">Services Purchases <span class="badge badge-red">0</span></a></li>
							<li class=""><a href="#payments">Sales/Earnings</a></li>
						</ul>
						<div class="tab-container user-info-content">
							<div id="settings" class="tab-content"> 
								<div class="form-popup-content clearfix">
									
										<form class="clearfix" action="{{ URL::to('user/updateprofile') }}" method="POST">
											{{ csrf_field() }}
											<div class="half-row">
												<input type="text" id="" name="user_fname" placeholder="Firstname" class="form-control tab-input" value="{{ isset($user->user_fname)?$user->user_fname: null }}">
									   		</div>
											<div class="half-row">
												<input type="text" id="" name="user_lname" placeholder="Lastname" class="form-control tab-input" value="{{ isset($user->user_lname)?$user->user_lname: null }}">
											</div>
											<div class="half-row">
												<input type="email" id="" name="user_email" placeholder="Email" class="form-control tab-input" value="{{ isset($user->user_email)?$user->user_email: null }}">
											</div>
											<div class="half-row">
												<input type="text" id="" name="user_address" placeholder="Address" class="form-control tab-input" value="{{ isset($user->user_address)?$user->user_address: null }}">
											</div>
											<div class="half-row">
												<input type="text" id="" name="user_state" placeholder="State" class="form-control tab-input" value="{{ isset($user->user_state)?$user->user_state: null }}">
											</div>
											<div class="half-row">
												<input type="text" id="" name="user_country" placeholder="Country" class="form-control tab-input" value="{{ isset($user->user_country)?$user->user_country: null }}">
											</div>
											<div class="half-row">
												<input type="password" id="" name="user_pwd" placeholder="Password Change" class="form-control tab-input">
											</div>
											<div class="half-row full-row">
												<button type="submit" class="btn btn-primary"> Update Settings</a>
											</div>
										</form>
								</div>
								
							</div>
							
							<div id="purchases" class="tab-content" style="display: none;"> 
								<!-- CART -->
								<div class="cart">
									<!-- CART HEADER -->
									<div class="cart-header clearfix">
										<div class="col-md-6 col-xs-6">
											<p>Item name</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p>Date purchased</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p>Download</p>
										</div>
									</div>
									<!-- /CART HEADER -->
									@foreach(\App\Payments::where('payment_user_id',$user->id)->get() as $payment)
									@foreach(\App\Products::where('id', $payment->payment_prod_id)->where('is_service',false)->get() as $prod)
									<!-- CART ITEM -->
									<div class="cart-item clearfix">
										<div class="col-md-6 col-xs-6 cart-flex">
												<div class="col-md-6 col-xs-6 p-none">
													<a href="{{ URL::to('product') }}/{{ $prod->prod_slug }}/{{ $prod->id }}" class="item-thumb">
														<img src="{{ \App\Products::getFileUrl($prod->prod_image) }}" alt="{{ $prod->prod_image_alt1 }}" class="img-responsive">
													</a>
												</div>
												<div class="col-md-6 col-xs-6">
													<p class="item-title">{{ $prod->prod_name }}</p>
													
													<p class="item-des">By <strong>{{ \App\Uses::username($prod->prod_vendor_id) }}</strong> In 
														<strong>{{ \App\Category::get_cat(explode(",", $prod->prod_categories)[0]) }}</strong>
													</p>
												</div>
												<div class="clearfix"></div>
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="item-date">{{ $payment->created_at }}</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="item-price"><a href="{{ \App\Products::getFileUrl($prod->prod_file) }}" class="btn btn-primary">Download</a></p>
										</div>
									</div>
									<!-- /CART ITEM -->
									@endforeach
									@endforeach
									<hr>
								</div>
								<!-- /CART -->
								
								
							</div>
							
							<div id="services" class="tab-content" style="display: none;"> 
								<!-- CART -->
								<div class="cart">
									<!-- CART HEADER -->
									<div class="cart-header clearfix">
										<div class="col-md-6 col-xs-6">
											<p>Item name</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="hidden-xs">Date purchased</p>
											<p class="visible-xs">Date purchased</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="hidden-xs">Status/Download</p>
											<p class="visible-xs">Status</p>
										</div>
									</div>
									<!-- /CART HEADER -->
									@foreach(\App\Payments::where('payment_user_id',$user->id)->get() as $payment)
									@foreach(\App\Products::where('id', $payment->payment_prod_id)->where('is_service',true)->get() as $prod)
									<!-- CART ITEM -->
									<div class="cart-item clearfix">
										<div class="col-md-6 col-xs-6 cart-flex">
											
												<div class="col-md-6 col-xs-6 p-none">
													<a href="{{ URL::to('product') }}/{{ $prod->prod_slug }}/{{ $prod->id }}" class="item-thumb">
														<img src="{{ \App\Products::getFileUrl($prod->prod_image) }}" class="img-responsive">
													</a>
												</div>
												<div class="col-md-6 col-xs-6">
													<p class="item-title">{{ $prod->prod_name }}</p>
													<p class="item-des">By 
														<strong>{{ \App\Uses::username($prod->prod_vendor_id) }}</strong> In 
														<strong>{{ \App\Category::get_cat(explode(",", $prod->prod_categories)[0]) }}</strong>
													</p>
													<p class="ordertext-small">Need revision on your order ? <a href="#RevisionModal" data-toggle="modal" class="">Click here</a></p>
												</div>
												<div class="clearfix"></div>
											
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="item-date">{{ $payment->created_at }}</p>
										</div>
										<div class="col-md-3 col-xs-3">
											<p class="item-price">
												<a href="#" class="btn btn-primary btn-red">Pending</a>
												<p class="ordertext-small">We will update you one</p>
											</p>
										</div>
									</div>
									<!-- /CART ITEM -->
									@endforeach
									@endforeach
									
									
									<hr>
								</div>
								<!-- /CART -->
								
								
							</div>
								
							<div id="payments" class="tab-content" style="display: none;"> 
								<div class="a-sales">
									<div class="col-md-6 col-xs-12 p-none">
										<h3>Total Earnings : &nbsp;<span class="a-sales-total">$350</span> </h3>
									</div>
									
										<div class="col-md-6 col-xs-12 p-none dropdown-sort">
											<span>Total Sales :&nbsp;</span>
											<div class="dropdown">
												<select class="cs-select cs-skin-elastic">
													<option value="" disabled selected>Today 26th April, 2017</option>
													<option value="1">Today 27th April, 2017</option>
													<option value="2">Today 28th April, 2017</option>
													<option value="3">Today 29th April, 2017</option>
													<option value="4">Today 30th April, 2017</option>
												</select>
											</div>
										</div>		
									
									<div class="clearfix"></div>
								</div>
								<div class="gap20">	</div>
								
								<table class="table table-bordered table-hover table-responsive account-table">
									<tbody>
										<tr class="text-center">
											<th>Date </th>
											<th>Item Name</th>
											<th>Type</th>
											<th>Price</th>
											<th>Commision</th>
										</tr>
										<tr>
											<td><span class="s-date">26th April, 2017</span></td>
											<td><span class="s-name">14 facebook design bundle</span></td>
											<td><span class="s-type">Product</span></td>
											<td><span class="s-price">$6</span></td>
											<td><span class="s-comm">$4</span></td>
										</tr>
										<tr>
											<td><span class="s-date">26th April, 2017</span></td>
											<td><span class="s-name">14 facebook design bundle</span></td>
											<td><span class="s-type">Product</span></td>
											<td><span class="s-price">$6</span></td>
											<td><span class="s-comm">$4</span></td>
										</tr>
										<tr>
											<td><span class="s-date">26th April, 2017</span></td>
											<td><span class="s-name">14 facebook design bundle</span></td>
											<td><span class="s-type">Product</span></td>
											<td><span class="s-price">$6</span></td>
											<td><span class="s-comm">$4</span></td>
										</tr>
										
									</tbody>
								</table>
								
								
							</div>
							
						</div>
					</div>
				</div>
					
				<div class="payment_design">
					<!-- paymennt policy start -->
					<div class="account_policy">
						<div class="row">
							<div class="col-md-6">
								<div class="img-pad-margin">
									<img src="img/padlock-2.png">
									<h4 class="title">Your Information is Sale</h4>
									<p class="des">We will not sale or rent your personal contact
										<br>  information for any marketing purposes
										<br> whatsoever.</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="img-pad-margin">
									<img src="img/shield.png">
									<h4 class="title">Secure Checkout</h4>
									<p class="des">All information is encrypted and transmitted
										<br> without risk using a Secure Socket Layer
										<br> protocol. You can trust us!</p>
								</div>
							</div>
						</div>
					</div>
					<!-- paymennt policy end -->
				</div>	
				
			</div>
		</div>
	</section>

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('home_asset/js/custom-file.js') }}"></script>
<script type="text/javascript" src="{{ asset('home_asset/js/classie.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/js/selectFx.js')}}"></script>
<script type="text/javascript">
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();</script>
@endsection
