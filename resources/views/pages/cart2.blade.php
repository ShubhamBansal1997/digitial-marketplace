@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('home_asset/css/carousel.css')}}">
<link id="style-main-color" rel="stylesheet" href="{{ asset('home_asset/css/colors/default.css')}}">
@endsection

@section('content')

	<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>Review Your Order</h2>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap m-b-lg-big">
		<div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar left">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<h5>Have a coupon code?</h5>
					<hr class="line-separator">
					<form id="coupon-code-form">
						<input type="text" name="coupon_code" placeholder="Enter your coupon code...">
						<button class="button mid dark-light">Apply</button>
					</form>
				</div>
				<!-- /SIDEBAR ITEM -->
			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			<div class="content right">
				<!-- CART -->
				<div class="cart">
					<!-- CART HEADER -->
					<div class="cart-header">
						<div class="cart-header-product">
							<p class="text-header small">Product Details</p>
						</div>
						<div class="cart-header-actions">
							<p class="text-header small">Remove</p>
						</div>
						<div class="cart-header-price">
							<p class="text-header small">Price</p>
						</div>
					</div>
					<!-- /CART HEADER -->

					@foreach(Cart::content() as $row)
					<!-- CART ITEM -->
					<div class="cart-item">
						<!-- CART ITEM PRODUCT -->
						<div class="cart-item-product">
							<!-- ITEM PREVIEW -->
							<div class="item-preview">
								<a href="{{ URL::to('/product')}}/{{ $row->options->prod_slug }}/{{ $row->id }}">
									<figure class="product-preview-image small liquid">
										<img src="{{ $row->options->pic }}" alt="{{ $row->name }}">
									</figure>
								</a>
								<a href="{{ URL::to('/product')}}/{{ $row->options->prod_slug }}/{{ $row->id }}"><p class="text-header small">{{ $row->name }}</p></a>
								<div class="cart-item-category">
							<a href="#" class="category primary">{{ $row->options->vendor_name }}</a>
						</div>
							</div>
							
							<!-- /ITEM PREVIEW -->
						</div>
						<!-- /CART ITEM PRODUCT -->
							<!-- CART ITEM ACTIONS -->
						<div class="cart-item-actions">
							<a href="{{ URL::to('removefromcart')}}/{{$row->rowId }}" class="button dark-light rmv">
								<!-- SVG PLUS -->
								<svg class="svg-plus">
									<use xlink:href="#svg-plus"></use>	
								</svg>
								<!-- /SVG PLUS -->
							</a>
						</div>
						<!-- /CART ITEM ACTIONS -->

						<!-- CART ITEM PRICE -->
						<div class="cart-item-price">
							<p class="price"><span>$</span>{{ $row->price }}</p>
						</div>
						<!-- /CART ITEM PRICE -->

					</div>
					<!-- /CART ITEM -->
					@endforeach
					
					<!-- CART TOTAL -->
					<div class="cart-total">
						<p class="price"><span>$</span>{{ Cart::total() }}</p>
						<p class="text-header subtotal">Cart Subtotal</p>
					</div>
					<!-- /CART TOTAL -->

					<!-- CART TOTAL -->
					<div class="cart-total">
						<p class="price medium"><span>$</span>{{ Cart::total() }}</p>
						<p class="text-header total">Cart Total</p>
					</div>
					<!-- /CART TOTAL -->

					<!-- CART ACTIONS -->
					<div class="cart-actions">
						<a href="{{ URL::to('/checkout') }}" class="button mid theme">Proceed to Checkout</a>
						<a href="{{ URL::to('/')}}" class="button mid dark-light spaced">Continue Browsing</a>
					</div>
					<!-- /CART ACTIONS -->
				</div>
				<!-- /CART -->
			</div>
			<!-- CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->

	
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('home_asset/js/script.js') }}"></script>
@endsection