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
                <h1 class="page-title">Review your order</h1>
				<p class="page-des">
					Wow,you've get some great items there!<br>If you're happy with your selections,proceed to Checkout.
				</p>
            </div>
			
            <div class="row">
                <div class="box clearfix">
                    <div class="cart-header clearfix">
                        <div class="col-md-8 col-xs-6">
                            <p>Item name</p>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <p>Item price</p>
                        </div>
                    </div>
					@foreach(Cart::content() as $row)
                    <div class="cart-item clearfix">
                        <div class="col-md-8 col-xs-6 cart-flex">
                            <div class="col-md-6 col-xs-12">
                                <a href="{{ URL::to('/product')}}/{{ $row->options->prod_slug }}/{{ $row->id }}" class="item-thumb">
									<img src="{{ $row->options->pic }}" class="img-responsive" alt="{{ $row->name }}" />
								</a>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <p class="item-title">{{ $row->name }}</p>
								<p class="item-des">By <strong>{{ $row->options->vendor_name }}</strong> In <strong>{{ \App\Category::get_cat(explode(",", $product->prod_categories)[0]) }}</strong></span>
                            </div>
							<div class="clearfix"></div>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <p class="item-price">
                            	<span class="old-price">$200</span>
                            	<span class="new-price">{{ $row->price }}</span> 
                            	<span class="item-close"><a href="{{ URL::to('removefromcart')}}/{{$row->rowId }}"><img src="{{ asset('home_asset/img/cross.png')}}"/></a></span>
                            </p>
                        </div>
                    </div>
                    @endforeach
					<hr>
                    <div class="cart-footer clearfix">
						<div class="col-md-8 col-xs-12">
							<span class="coupon-input"><input class=""/><img src="{{ asset('home_asset/img/cross.png')}}" class="coupon-cross"/></span>
							<button class="btn btn-md coupon-btn btn-red">50% OFF</button>
						</div>
						<div class="col-md-8 col-xs-12 hidden">
							<p class="total-price-text">Have a discount code? <a href="#">Click to enter it.</a></p>
						</div>
						<div class="col-md-4 col-xs-12">
							<p class="total-price-text">Total&nbsp;&nbsp;
								<span class="total-price">${{ Cart::total() }}</span>
							</p>
						</div>
                    </div>
                </div>
				
				<div class="payment_design">
					<div class="row">
									<div class="col-md-6 col-xs-12">
                                        <button type="button" class="back-button"  formaction="{{ URL::to('/')}}">Continue Shopping</button>
                                    </div>
									<div class="col-md-6 col-xs-12">
                                        <button type="button" class="btn btn-primary paypal-button"  formaction="{{ URL::to('/checkout') }}"> Checkout</button>
                                    </div>
                    </div>
				
				<!-- paymennt policy start -->
				<div class="account_policy">
					<div class="row">
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