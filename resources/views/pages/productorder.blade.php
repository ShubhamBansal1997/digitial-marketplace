@extends('app')

@section('css')

@endsection

@section('content')
<!-- Section Start -->
	<section>
		<div class="container">
			<div class="container">
				<div class="row text-center">
					<p class="gap60"></p>	
					<h1 class="page-title">Create Your Brief. </h1>
					<p class="page-des">
						Be comprehensive. Include information such as your objective, the target audience, the desired tone of voice, etc Don’t forget to attach files, images, relevant examples or references to help the designer understand your requirements better.
					</p>
				</div>
				
				<div class="row">
					<div class="box ordertask clearfix">
						
						
						<div class="ordertask1 edit-product-detail cart-flex clearfix">
							<div class="col-md-6 col-xs-6 edit-product-info">
								<a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}" class="ep-thumb">
									<img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}" class="img-responsive">
								</a>
								@foreach(\App\Users::where('id',$product->prod_vendor_id)->get() as $user)
								<p class="ep-seller"><span>Seller  </span>:&nbsp; <a href="{{ URL::to('vendor')}}/{{ $user->user_slug }}/{{ $user->id }}" class="item-des">By <strong>{{ $user->user_fname }} {{ $user->user_lname }}</strong></a></p>
								@endforeach
							</div>
							<div class="col-md-6 col-xs-6 edit-product-task">
								<a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}" class="ep-task">{{ $product->prod_name }}</a>
							</div>
						</div>
						
						<form action="{{ URL::to('productordercheckout') }}" method="POST" enctype= multipart/form-data>
						{{ csrf_field() }}
						<input type="hidden" name="product_id" value="{{ $product->id }}">
						<input type="hidden" name="price" value="{{ $price }}">
						<input type="hidden" name="custom" value="{{ $customs }}">
						<!-- order task 1 -->
						<div class="ordertask1">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">1.</span> Enter your name</h3>
								<div class="orderinput">
									<input type="text" class="form-control" name="name" />
								</div>
							</div>
						</div>
						
						<!-- order task 1 -->
						<div class="ordertask2">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">2.</span> Type your message here</h3>
								<div class="orderinput">
									<textarea rows="4" name="message1"></textarea>
								</div>
								
							</div>
						</div>
						
						<!-- order task 1 -->
						<div class="ordertask4">
							<div class="dropdown-sort">
								<h3 class="qu-title"><span class="">4.</span> Attach Files</h3>
								<div class="orderinput">
									<div class="inputfilebox">
										<input type="file" name="reference_file" id="file-7" class="inputfile inputfile-6 hidden" data-multiple-caption="{count} files selected" multiple />
										<label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
									</div>
									<p class="ordertext-small">
										You may upload up to 5 reference files ( 30MB max each ). <br>
										Files allowed: .txt, .doc, .docx, .pdf .jpg, .jpeg, .png, .ai, .eps, .psd, .otf, .ttf
									</p>
								</div>
							</div>
						</div>
					
					</div>
				</div>
					
					<div class="payment_design">
						<div class="row">
						<div class="gap40"></div>
									<div class="col-md-6 col-xs-12">
                                        <a type="button" class="btn back-button" href="{{ URL::to('/') }}">Cancel</a>
                                    </div>
									<div class="col-md-6 col-xs-12">
                                        <button type="submit" class="btn btn-primary paypal-button"> Checkout</button>
                                    </div>
						</div>
				</form>
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

@endsection