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
				<div class="row text-center">
					<p class="gap60"></p>	
					<h1 class="page-title">Get Started with your custom project </h1>
					<p class="page-des">
						Please provide some relevant information related to your projects
					</p>
				</div>
				
				<div class="row">
					<form method="POST" action="{{ URL::to('custom-order') }}" enctype= multipart/form-data>
					{{ csrf_field() }}
					<div class="box ordertask clearfix">
						<!-- order task 1 -->
						<div class="ordertask1">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">1.</span> What would you like done?</h3>
								<div class="dropdown">
									<select class="cs-select cs-skin-elastic" name="order_work">
										<option value="" disabled selected>Select your Choice</option>
										<option value="Logo Designing">Logo Designing</option>
										<option value="Web Designing">Web Designing</option>
										<option value="Brochure Designing">Brochure Designing</option>
										<option value="Shopping Cart">Shopping Cart</option>
									</select>
								</div>
							</div>
						</div>
						<!-- order task 1 -->
						<div class="ordertask2">
							<div class="dropdown-sort">
								<h3 class="qu-title">
									<span class="">2.</span> Tell us about any additional project details that your designer should know
								</h3>
								<div class="orderinput">
									<textarea rows="4" name="order_descrption"></textarea>
								</div>
								<p class="ordertext-small">Please go into as such as detaiils possible<br>
								write as such as you like. We encourage you to go bit long here with describing your project.</p>
							</div>
						</div>
						<!-- order task 1 -->
						<div class="ordertask3">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">3.</span> What is your estimated budget?</h3>
								<div class="dropdown">
									<select class="cs-select cs-skin-elastic" name="order_price">
										<option value="" disabled selected>Select a Budget</option>
										<option value="INR 1500-2500">INR 1500-2500</option>
										<option value="INR 3500-8000">INR 3500-8000</option>
										<option value="INR 10000-15000">INR 10000-15000</option>
										<option value="Custom Budget">Custom Budget</option>
									</select>
								</div>
							</div>
						</div>
						<!-- order task 1 -->
						<div class="ordertask4">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">4.</span> Attach some samples of designs you like?</h3>
								<div class="orderinput">
									<div class="inputfilebox">
										<input type="file" name="order_sample_file" id="file-7" class="inputfile inputfile-6 hidden" data-multiple-caption="{count} files selected" multiple />
										<label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="see-more">
							<button type="submit" class="btn btn-primary see">Submit</button>
						</div>
					</div>
					</form>
				</div>
					
					<div class="payment_design">
						
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
	</section>

@endsection

@section('script')
<script type='text/javascript'>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();
</script>
@endsection