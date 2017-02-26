@extends('app')

@section('content')
<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Your Account</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Account</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		
	<div class="section">
		<div class="tab-area">
			<ul class="tabs-menu user-info-tabs">
			  <li><a href="#settings">Settings</a></li>
			  <li><a href="#purchases">Purchase History</a></li>
			  <li><a href="#custom-order">Services History</a></li>
			   
			
			
			</ul>
			<div class="tab-container user-info-content">
				<div id="settings" class="tab-content"> 
					<div class="form-popup-content">
						<h5 class="popup-title">User Account Settings</h5>
							<form id="register-form2" method="post" action="{{ URL::to('user/updateprofile') }}" >
								{{ csrf_field() }}
								<input type="text" id="" name="user_fname"  value="{{ isset($user->user_fname)?$user->user_fname: null }}" placeholder="First name">
								<input type="text" id="" name="user_lname" value="{{ isset($user->user_lname)?$user->user_lname: null }}" placeholder="Last name">
								<input type="email" id="" name="user_email" value="{{ isset($user->user_email)?$user->user_email: null }}" placeholder="Enter your email address">
								<input type="text" id="" name="user_address" value="{{ isset($user->user_address)?$user->user_address: null }}" placeholder="Address">
								<input type="text" id="" name="user_state" value="{{ isset($user->user_state)?$user->user_state: null }}" placeholder="State">
								<input type="text" id="" name="user_country" value="{{ isset($user->user_country)?$user->user_country: null }}" placeholder="Country">
								<div class="buttons">
									<buttom class="button secondary" type="submit">
										<span class="primary">Update Settings</span>
									</button>
								</div>
							</form>
					</div>
					<div class="form-popup-content">
						<h5 class="popup-title">Update Password</h5>
							<form id="register-form2" method="post" action="{{ URL::to('user/updatepassword') }}" >
								{{ csrf_field() }}
								<input type="password" id="" name="old_password" placeholder="Old password">
								<input type="password" id="" name="new_password" placeholder="New password">
								<input type="password" id="" name="new_password1" placeholder="Repeat password">
								<div class="buttons">
									<button class="button secondary" type="submit">
										<span class="primary">Update password</span>
									</button>
								</div>
							</form>
					</div>
				</div>
				<div id="purchases" class="tab-content"> 
						<!-- CART -->
				<div class="cart">
					<!-- CART HEADER -->
					<div class="cart-header">
						<div class="cart-header-product">
							<p class="text-header small">Product Details</p>
						</div>
						<div class="cart-header-price">
							<p class="text-header small">Date Purchased</p>
						</div>	<div class="cart-header-price">
							<p class="text-header small">Price</p>
						</div>
						<div class="cart-header-actions">
							<p class="text-header small">Downloads</p>
						</div>
					</div>
					<!-- /CART HEADER -->

					@foreach(\App\Payments::where('payment_user_id',$user->id)->get() as $payment)
					@foreach(\App\Products::where('id', $payment->payment_prod_id)->where('is_service',false)->get() as $prod)
					<!-- CART ITEM -->
					<div class="cart-item">
						<!-- CART ITEM PRODUCT -->
						<div class="cart-item-product">
							<!-- ITEM PREVIEW -->
							<div class="item-preview">
								<a href="{{ URL::to('/')}}">
									<figure class="product-preview-image small liquid">
										<img src="{{ \App\Products::getFileUrl($prod->prod_image) }}" alt="{{ $prod->prod_image_alt1 }}">
									</figure>
								</a>
								<a href="{{ URL::to('/')}}"><p class="text-header small">{{ $prod->prod_name }}</p></a>
								<div class="cart-item-category">
									@foreach(\App\Products::getCategory($prod->id) as $cat)
									<a href="{{ URL::to('/') }}" class="category primary">{{ $cat }} ,</a>
									@endforeach
								</div>
							</div>
							
							<!-- /ITEM PREVIEW -->
						</div>
						<!-- /CART ITEM PRODUCT -->
							<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p>{{ $payment->created_at }}</p>
						</div>
						<!-- /CART ITEM PRICE -->
							<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p class="price"><span>$</span>{{  $payment->payment_amount}}</p>
						</div>
						<!-- /CART ITEM PRICE -->
					<!-- CART ITEM ACTIONS -->
						<div class="cart-item-actions">
					    <a href="{{ \App\Products::getFileUrl($prod->prod_file) }}" class="button primary">Download</a>
						</div>
						<!-- /CART ITEM ACTIONS -->
					</div>
					<!-- /CART ITEM -->
					@endforeach
					@endforeach

				</div>
				<!-- /CART -->
				</div>
				<div id="custom-order" class="tab-content"> 
						<div class="cart">
				<div class="cart-header">
						<div class="cart-header-product">
							<p class="text-header small">Services Details</p>
						</div>
						<div class="cart-header-price">
							<p class="text-header small">Services Ordered</p>
						</div>	<div class="cart-header-price">
							<p class="text-header small">Price</p>
						</div>
						<div class="cart-header-actions">
							<p class="text-header small">Downloads</p>
						</div>
					</div>

					@foreach(\App\Payments::where('payment_user_id',$user->id)->get() as $payment)
					@foreach(\App\Products::where('id', $payment->payment_prod_id)->where('is_service',false)->get() as $prod)
					<!-- CART ITEM -->

					<div class="cart-item">
						<!-- CART ITEM PRODUCT -->
						<div class="cart-item-product">
							<!-- ITEM PREVIEW -->
							<div class="item-preview">
								<a href="item-v1.html">
									<figure class="product-preview-image small liquid">
										<img src="{{ \App\Products::getFileUrl($prod->prod_image) }}" alt="{{ $prod->prod_image_alt1 }}">
									</figure>
								</a>
								<a href="{{ URL::to('/') }}"><p class="text-header small">{{ $prod->prod_name }}</p></a>
								<div class="cart-item-category">
									@foreach(\App\Products::getCategory($prod->id) as $cat)
									<a href="{{ URL::to('/') }}" class="category primary">{{ $cat }} ,</a>
									@endforeach
						</div>
							</div>
							
							<!-- /ITEM PREVIEW -->
						</div>
						<!-- /CART ITEM PRODUCT -->
							<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p>{{ $payment->created_at }}</p>
						</div>
						<!-- /CART ITEM PRICE -->
							<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p class="price"><span>$</span>{{  $payment->payment_amount}}</p>
						</div>
						<!-- /CART ITEM PRICE -->
					<!-- CART ITEM ACTIONS -->
						<div class="cart-item-actions">
					    <a href="{{ \App\Products::getFileUrl($prod->prod_file) }}" class="button primary">Download</a>
						</div>
						<!-- /CART ITEM ACTIONS -->
					</div>
					<!-- /CART ITEM -->
					@endforeach
					@endforeach

				</div>
				<!-- /CART -->
				</div>
					
				</div>
					

			</div>
		  </div>
	</div>
	
	</div>
	<!-- /SECTION -->

@endsection