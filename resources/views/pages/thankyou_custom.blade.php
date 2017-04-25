@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('home_asset/css/carousel.css') }}">
<link id="style-main-color" rel="stylesheet" href="{{ asset('home_asset/css/colors/default.css') }}">
@endsection

@section('content')
<!-- Section Start -->
	<section>
    <div class="container">
        <div class="container">
            <div class="row text-center">
				<p class="gap60"></p>	
				<p><img src="{{ asset('home_asset/fonts/check.png')}}" width="90"/></p>
                <h1 class="page-title">Thank you for your custom order </h1>
				<p class="page-des">
					We Will Revert Back to You as Soon as Possible
				</p>
            </div>
			
            
				
				<!-- paymennt policy start -->
				<div class="account_policy">
					<div class="row">
						<div class="col-md-6">
							<div class="img-pad-margin">
								<img src="{{ asset('home_asset/img/padlock-2.png')}}">
								<h4 class="title">Your Information is Safe</h4>
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