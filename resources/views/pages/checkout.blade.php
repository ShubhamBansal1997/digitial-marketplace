<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="{{ asset('home_asset/css/vendor/simple-line-icons.css')}}">
	<link rel="stylesheet" href="{{ asset('home_asset/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/css/custom.css')}}">
	<!-- favicon -->
	<link rel="icon" href="favicon.ico">
	<title>Emerald Dragon | Checkout</title>
</head>
<body>

	<!-- HEADER -->
	<div class="header-wrap">
		<header>
			<!-- LOGO -->
			<a href="index.html">
				<figure class="logo">
					<img src="{{ asset('home_asset/images/logo.png')}}" alt="logo">
				</figure>
			</a>
			<!-- /LOGO -->

			<!-- LOGO MOBILE -->
			<a href="{{URL::to('/')}}">
				<figure class="logo-mobile">
					<img src="{{ asset('home_asset/images/logo_mobile.png')}}" alt="logo-mobile">
				</figure>
			</a>
			<!-- /LOGO MOBILE -->
	</div>
	<!-- /HEADER -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- CHECKOUT ITEMS -->
			<div class="checkout-items">
				<!-- CHECKOUT ITEM -->
				<div class="checkout-item">
					<h5>Choose your Payment Method</h5>
					<hr class="line-separator">
      		<div class="payment-methods active">
          		<div class="heading">
            		<h5>PayPal</h5>
            		<span>Recomended</span>
          		</div>
         		 <ul class="payment-card">
            		<li><img src="{{ asset('home_asset/images/PayPal.png')}}"></li>
            		<li><img src="{{ asset('home_asset/images/Visa.png')}}"></li>
                	<li><img src="{{ asset('home_asset/images/MasterCard.png')}}"></li>
                	<li><img src="{{ asset('home_asset/images/AmericanExpress.png')}}"></li>
          		</ul>
          <div class="pay-btn">
          <p>The most secure fast and convenient mean of online payment.The payment can be proceeded with balance or payment card.</p>
          </div>
		    <div class="mid_button">
				<a href="#" class="button mid paypal">Pay via Paypal</a>
			</div>
      </div>
      <div class="payment-methods">
          <div class="heading">
            <h5>Card</h5>
          </div>
          <ul class="payment-card">
            <li><img src="{{ asset('home_asset/images/AmericanExpress.png')}}"></li>
              <li><img src="{{ asset('home_asset/images/Visa.png')}}"></li>
                <li><img src="{{ asset('home_asset/images/MasterCard.png')}}"></li>
          </ul>
          <div class="pay-btn">
          <p>In case PayPal isn't up to your liking, this servise is your number one choice by being classical means for payment with card.</p>
          </div>
		 <div class="mid_button">
				<a href="#" class="button mid primary">Pay via Card</a>
			</div>
      </div>
					
				</div>
				<!-- /CHECKOUT ITEM -->
				<!-- CHECKOUT ITEM -->
				<div class="checkout-item not-padded">
					<h5>Cart Overview</h5>
					<hr class="line-separator">
					<!-- CART OVERVIEW ITEM -->
					@foreach(Cart::content() as $row)
					<div class="cart-overview-item">
						<p class="text-header small">{{ $row->name }}</span></p>
						<p class="price"><span>$</span>{{ $row->price }}</p>
						<p class="category primary">{{ $row->options->vendor_name }}</p>
					</div>
					<!-- /CART OVERVIEW ITEM -->
					@endforeach
					
						<!-- CART TOTAL -->
					<div class="cart-total small">
						<p class="price"><span>$</span>{{ Cart::subtotal() }}</p>
						<p class="text-header subtotal">Cart Subtotal</p>
					</div>
					<!-- /CART TOTAL -->
					
					<!-- CART TOTAL -->
					<div class="cart-total small">
						<p class="price">-<span>$</span>0</p>
						<p class="text-header subtotal">Discount</p>
					</div>
					<!-- /CART TOTAL -->

					<!-- CART TOTAL -->
					<div class="cart-total small">
						<p class="price"><span>$</span>{{ Cart::subtotal() }}</p>
						<p class="text-header subtotal">Cart Total</p>
					</div>
					<!-- /CART TOTAL -->
				</div>
				<!-- /CHECKOUT ITEM -->
			</div>
			<!-- /CHECKOUT ITEMS -->
		</div>
	</div>
	<!-- /SECTION -->
	<!-- FOOTER -->
	<footer>
		<!-- FOOTER BOTTOM -->
		<div id="footer-bottom-wrap">
			<div id="footer-bottom">
				<div class="half-big-row">
					<p><span>&copy;</span><a href="#"> Design Minister</a>  - All Rights Reserved 2017</p>
				
				</div>
				<div class="half-small-row">
					<div class="ts_footer_link">
						<ul>
					    						<li><p>Secure Payments:</p></li>
					    						<li><a target="_blank" href="#" class="wallet wallet_1">&nbsp;</a></li>
					    						<li><a target="_blank" href="#" class="wallet wallet_2">&nbsp;</a></li>
					    						<li><a target="_blank" href="#" class="wallet wallet_3">&nbsp;</a></li>
					    						<li><a target="_blank" href="#" class="wallet wallet_4">&nbsp;</a></li>
					    						
						</ul>
					</div>
				</div>
		
			</div>
		</div>
		<!-- /FOOTER BOTTOM -->
	</footer>
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"/>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG STAR -->
<svg style="display: none;">
	<symbol id="svg-star" viewBox="0 0 10 10" preserveAspectRatio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	2.495,6.313 -0.002,3.878 3.45,3.376 "/>
	</symbol>
</svg>
<!-- /SVG STAR -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
		<rect x="5" width="3" height="13"/>
		<rect y="5" width="13" height="3"/>
	</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- jQuery -->
<script src="{{ asset('home_asset/js/vendor/jquery-3.1.0.min.js')}}"></script>
<!-- Tweet -->
<script src="{{ asset('home_asset/js/vendor/twitter/jquery.tweet.min.js')}}"></script>
<!-- Side Menu -->
<script src="{{ asset('home_asset/js/side-menu.js')}}"></script>
<!-- Radio Link -->
<script src="{{ asset('home_asset/js/radio-link.js')}}"></script>
<!-- User Quickview Dropdown -->
<script src="{{ asset('home_asset/js/user-board.js')}}"></script>
<!-- Footer -->
<script src="{{ asset('home_asset/js/footer.js')}}"></script>
</body>
</html>