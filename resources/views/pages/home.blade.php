@extends('app')

@section('content')
<!-- BANNER -->
	<div class="banner-wrap">
		<section class="banner">
			<!-- /BANNER CAPTION CONTENT -->
		</section>
	</div>		

	<!-- SECTION -->
	<div class="section-wrap p-b-md">
		<div class="section">
			<!-- PRODUCT SHOWCASE -->
			<div class="product-showcase">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h1>9,000+ Inspiring, Hand-Crafted Templates & Assets.</h1>
					<h3>Made with love by some of the worldâ€™s best independent designers.
					</br>Relevant, on-trend, and beautifully presented.</h3>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="section width100">
					<div class="product-list grid column4-wrap">
				
					@foreach(\App\Products::where('prod_delete',false)->where('prod_status',true)->where('prod_featured',true)->where('is_service',false)->get() as $product)
					<!-- PRODUCT 1 -->
					<div class="product-item column">
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt1}}">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->
							<div class="preview-actions">
								<div class="preview-action">
									<a href="{{ URL::to('/product')}}/{{ $product->prod_slug }}/{{ $product->id}}">
										<p>Go to Item</p>
									</a>
								</div>
								<div class="preview-action">
									<a href="{{ URL::to('addtocart')}}/{{ $product->id }}">
										<p>Add to Cart</p>
									</a>
								</div>
							</div>
						</div>
						<!-- /PRODUCT PREVIEW ACTIONS -->
						<div class="product-info">
							<a href="{{ URL::to('product')}}/{{ $product->prod_slug }}/{{ $product->id }}">
								<p class="text-header">{{ $product->prod_name }}</p>
							</a>
							<a href="shop-gridview-v1.html">
								<p class="category primary">PSD Templates</p>
							</a> 
							<p class="price"><span>$</span>{{ $product->prod_price }}</p>
						</div>
						<hr class="line-separator">
						@foreach(\App\Users::where('id',$product->prod_vendor_id)->get() as $vendor)
						<!-- SELLER INFO -->
						<div class="user-rating">
							<a href="{{ URL::to('/vendor')}}/{{ $vendor->user_slug}}/{{ $vendor->id }}">
								<figure class="user-avatar small">
									<img src="{{ \App\Users::profile_image($vendor->user_profile_image) }}" alt="{{ \App\Users::username($vendor->id) }}">
								</figure>
							</a>
							<a href="{{ URL::to('/vendor')}}/{{ $vendor->user_slug}}/{{ $vendor->id }}">
								<p class="text-header tiny">{{ \App\Users::username($vendor->id) }}</p>
							</a>
						</div>
						<!-- SELLER INFO -->
						@endforeach
					</div>
					<!-- /PRODUCT 1-->
					@endforeach
					
				</div>
					<!-- /PRODUCT LIST -->
				</div>
	        </div>
			<div class="p-t-xs mid_button">
				<a href="{{ URL::to('products')}}" class="button mid dark">See all Products </a>
			</div>
	    </div>
	</div>
	
		<div class="bg_white">
		<div class="section">
			<!-- PRODUCT SHOWCASE -->
				<!-- HEADLINE -->
				<div class="headline primary">
					<h1>300+ Customized Design Services Starts At $10</h1>
					<h3>Made with love by some of the worldâ€™s best independent designers.
					</br>Relevant, on-trend, and beautifully presented.</h3>
				</div>
				<!-- /HEADLINE -->
					<!-- SECTION -->
	<div class="p-b-md">
		<div class="section">
			<!-- BLOG POST PREVIEW -->

			<div class="blog-post-preview v1 column3-wrap">
				
				@foreach(\App\Banners::bdet('Homepage-Banner-1') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach
				@foreach(\App\Banners::bdet('Homepage-Banner-2') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach
				@foreach(\App\Banners::bdet('Homepage-Banner-3') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach
				@foreach(\App\Banners::bdet('Homepage-Banner-4') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach
				@foreach(\App\Banners::bdet('Homepage-Banner-5') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach
				@foreach(\App\Banners::bdet('Homepage-Banner-6') as $banner)
				<div class="blog-post-preview-item column">
					<a href="{{ $banner->banner_url }}">
						<figure class="product-preview-image big liquid">
							<img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" alt="{{ $banner->banner_alt }}">
						</figure>
					</a>
				</div>
				@endforeach				
			</div>
			<!-- /BLOG POST PREVIEW -->

		</div>
		<div class="mid_button">
			<a href="{{ URL::to('services')}}" class="button mid dark">See all Services </a>
		</div>
	</div>
	<!-- /SECTION -->
				
		   </div>		
	    </div>
      </div>

    @include('particles.subscriber')			
	
@endsection