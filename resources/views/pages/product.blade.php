@extends('app')

@section('content')
<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>{{ $product->prod_name }}</h2>
			<p>Home<span class="separator">/</span><span class="current-section">Product</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar right">
				<div class="sidebar-item void buttons">
					<a href="{{ URL::to('directcheckout')}}/{{ $product->id }}" class="button big primary purchase">
						<span class="currency">{{ $product->prod_price }}</span>
						<span class="primary">Buy Now</span>
					</a>
					<a href="{{ URL::to('addtocart')}}/{{ $product->id }}" class="button big dark wcart">
						<span class="icon-present"></span>
						Add to Cart
					</a>
				</div>

				<!-- SIDEBAR ITEM -->
				@foreach(\App\Users::where('id',$product->user_vendor_id)->get() as $user)
				<div class="sidebar-item author-bio">
					<h5>Product Author</h5>
					<hr class="line-separator">
					<!-- USER AVATAR -->
					<a href="{{ URL::to('/') }}" class="user-avatar-wrap medium">
						<figure class="user-avatar medium">
							@if($user->user_profile_image)
							<img src="{{ \App\Users::profile_image($user->user_profile_image) }}" alt="{{ \App\Users::username($user->id) }} ">
							@else
							<img src="{{ asset('home_asset/images/avatars/avatar_01.jpg') }}" alt="{{ \App\Users::username($user->id) }}">
							@endif
						</figure>
					</a>
					<!-- /USER AVATAR -->
					<p class="text-header">{{ \App\Users::username($user->id) }}</p>
					<!-- SHARE LINKS -->
					<!-- <ul class="share-links">
						<li><a href="#" class="fb"></a></li>
						<li><a href="#" class="twt"></a></li>
						<li><a href="#" class="db"></a></li>
					</ul> -->
					<!-- /SHARE LINKS -->
					<a href="{{ URL::to('vendor/') }}/{{ $user->user_slug}}/{{ $user->id }}" class="button mid dark-light">View Profile</a>
				</div>
				<!-- /SIDEBAR ITEM -->
				@endforeach
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item product-info">
					<h5>Product Information</h5>
					<hr class="line-separator">
					<!-- INFORMATION LAYOUT -->
					<div class="information-layout">
						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Sales:</p>
							<p>{{ $product->prod_download }}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Upload Date:</p>
							<p>{{ $product->created_date }}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
						    <p class="text-header">Tags:</p>
							<p class="tags primary">{{ $product->prod_tags }}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->
					</div>
					<!-- INFORMATION LAYOUT -->
				</div>
				<!-- /SIDEBAR ITEM -->
				
				<!-- SIDEBAR ITEM -->
				<figure class="product-preview-image width100 side-banner">
					<img src="https://dummyimage.com/270x270/00d6b4/fff.jpg" alt="side-banner">
				</figure>
				<!-- /SIDEBAR ITEM -->
				
			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			
			<div class="content left">
				<!-- POST -->
				<article class="post">
					<!-- POST IMAGE -->
					<div class="post-image">
						<figure class="product-preview-image large liquid">
							<img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
						</figure>
					</div>
					<!-- /POST IMAGE -->

					<!-- POST IMAGE SLIDES -->
					<div class="post-image-slides">
						<!-- SLIDE CONTROLS -->
						<div class="slide-control-wrap">
							<div class="slide-control left">
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</div>

							<div class="slide-control right">
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</div>
						</div>
						<!-- /SLIDE CONTROLS -->

						<!-- IMAGE SLIDES WRAP -->
						<div class="image-slides-wrap">
							<!-- IMAGE SLIDES -->
							<div class="image-slides" data-slide-visible-full="6" 
													  data-slide-visible-small="2"
													  data-slide-count="9">
								@if($product->prod_image!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image1!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image1) }}" alt="{{ $product->prod_image_alt1 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image2!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image2) }}" alt="{{ $product->prod_image_alt2 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image3!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image3) }}" alt="{{ $product->prod_image_alt3 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image4!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image4) }}" alt="{{ $product->prod_image_alt4 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image5!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image5) }}" alt="{{ $product->prod_image_alt5 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								@if($product->prod_image6!=NULL)
								<!-- IMAGE SLIDE -->
								<div class="image-slide selected">
									<div class="overlay"></div>
									<figure class="product-preview-image thumbnail liquid">
										<img src="{{ \App\Products::getFileUrl($product->prod_image6) }}" alt="{{ $product->prod_image_alt6 }}">
									</figure>
								</div>
								<!-- /IMAGE SLIDE -->
								@endif
								
							</div>
							<!-- IMAGE SLIDES -->
						</div>
						<!-- IMAGE SLIDES WRAP -->
					</div>
					<!-- /POST IMAGE SLIDES -->

					<hr class="line-separator">

					<!-- POST CONTENT -->
					<div class="post-content">
						<!-- POST PARAGRAPH -->
						{!! $product->prod_descrption !!}

						<div class="clearfix"></div>
					</div>
					<!-- /POST CONTENT -->

					<hr class="line-separator">

					<!-- SHARE -->
					<div class="share-links-wrap">
						<p class="text-header small">Share this:</p>
						<!-- SHARE LINKS -->
						<ul class="share-links hoverable">
							<li><a href="#" class="fb"></a></li>
							<li><a href="#" class="twt"></a></li>
							<li><a href="#" class="db"></a></li>
							<li><a href="#" class="rss"></a></li>
							<li><a href="#" class="gplus"></a></li>
						</ul>
						<!-- /SHARE LINKS -->
					</div>
					<!-- /SHARE -->
				</article>
				<!-- /POST -->
				

				
			</div>
			<!-- CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->
	@include('particles.subscriber')
@endsection