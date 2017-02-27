@extends('app')

@section('content')
<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>{{ $name }}</h2>
			<p>Home
			<span class="separator">/</span>
			@if(isset($catname))
			{{ $catname }}
			<span class="separator">/</span>
			@endif
			<span class="current-section">{{ $name }}</span></p>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->

	<!-- SECTION -->
	<div class="section-wrap p-b-lg-big">
		<div class="section">
			<div class="content">
			
				<!-- Refine Search -->
				<div class="headline primary section_head">
					<!-- /VIEW SELECTORS -->
					<form id="shop_filter_form" name="shop_filter_form">
							<label for="price_filter" class="select-block">
								<select name="price_filter" id="price_filter">
									<option value="0">Price (High to Low)</option>
									<option value="1">Price (Low to High)</option>
								</select>
								<!-- SVG ARROW -->
								<svg class="svg-arrow">
									<use xlink:href="#svg-arrow"></use>
								</svg>
								<!-- /SVG ARROW -->
							</label>
						</form>
					<div class="clearfix"></div>
				</div>
				<!-- Refine Search -->
				
				<!-- PRODUCT SHOWCASE -->
				<div class="product-showcase">
					<!-- PRODUCT LIST -->
					<div class="product-list grid column3-4-wrap">
						<!-- PRODUCT 1 -->
					
					
					@foreach($products as $product)	
					<div class="product-item column">
						
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
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
							<!-- <a href="shop-gridview-v1.html">
								<p class="category primary">PSD Templates</p>
							</a> -->
							<p class="price"><span>$</span>{{ $product->price }}</p>
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
					<!-- PRODUCT 1-->
					@endforeach
						
					
					
					</div>
					<!-- /PRODUCT LIST -->
				</div>
				<!-- /PRODUCT SHOWCASE -->

				<!-- PAGER -->
<!-- 				<div class="pager primary p-b-md">
					<div class="pager-item"><p>1</p></div>
					<div class="pager-item active"><p>2</p></div>
					<div class="pager-item"><p>3</p></div>
					<div class="pager-item"><p>...</p></div>
					<div class="pager-item"><p>17</p></div>
				</div> -->
				<!-- /PAGER -->
				<div class="clearfix"></div>
				
				<!-- Full Banner ads -->
				<div class="full-banner-ads">
					<!-- PRODUCT PREVIEW IMAGE -->
					<figure class="product-preview-image banner400 width100">
						<img src="https://dummyimage.com/840x400/00d6b4/fff.jpg" alt="bottom-banner">
					</figure>
					<!-- /PRODUCT PREVIEW IMAGE -->
				</div>
				<!-- /Full Banner ads -->
				
			</div>
			<!-- CONTENT -->

			<!-- SIDEBAR -->
			<div class="sidebar">
				<!-- DROPDOWN -->
				<ul class="dropdown interactive">
					<li class="dropdown-item">
						<a href="#">All Products</a>
					</li>
					<li class="dropdown-item active">
						<a href="#">Illustration</a>
					</li>
					<li class="dropdown-item">
						<a href="#">Web Design</a>
					</li>
					<li class="dropdown-item">
						<a href="#">Stock Photography</a>
					</li>
					<li class="dropdown-item">
						<a href="#">Code and Plugins</a>
					</li>
				</ul>
				<!-- /DROPDOWN -->

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<h5>Filter Products</h5>
					<hr class="line-separator">
					<form id="shop_search_form" name="shop_search_form">
						<!-- CHECKBOX -->
						<input type="checkbox" id="filter1" name="filter1" checked>
						<label for="filter1">
							<span class="checkbox primary primary"><span></span></span>
							Cartoon Characters
							<span class="quantity">350</span>
						</label>
						<!-- /CHECKBOX -->

						<!-- CHECKBOX -->
						<input type="checkbox" id="filter2" name="filter2" checked>
						<label for="filter2">
							<span class="checkbox primary"><span></span></span>
							Flat Vector
							<span class="quantity">68</span>
						</label>
						<!-- /CHECKBOX -->

						<!-- CHECKBOX -->
						<input type="checkbox" id="filter3" name="filter3" checked>
						<label for="filter3">
							<span class="checkbox primary"><span></span></span>
							People
							<span class="quantity">350</span>
						</label>
						<!-- /CHECKBOX -->

						<!-- CHECKBOX -->
						<input type="checkbox" id="filter4" name="filter4">
						<label for="filter4">
							<span class="checkbox primary"><span></span></span>
							Animals
							<span class="quantity">68</span>
						</label>
						<!-- /CHECKBOX -->

						<!-- CHECKBOX -->
						<input type="checkbox" id="filter5" name="filter5">
						<label for="filter5">
							<span class="checkbox primary"><span></span></span>
							Objects
							<span class="quantity">350</span>
						</label>
						<!-- /CHECKBOX -->

						<!-- CHECKBOX -->
						<input type="checkbox" id="filter6" name="filter6" checked>
						<label for="filter6">
							<span class="checkbox primary"><span></span></span>
							Backgrounds
							<span class="quantity">68</span>
						</label>
						<!-- /CHECKBOX -->
					</form>
				</div>
				<!-- /SIDEBAR ITEM -->
				
				<!-- SIDEBAR ITEM -->
				<figure class="product-preview-image width100 side-banner">
					<img src="https://dummyimage.com/270x270/00d6b4/fff.jpg" alt="side-banner">
				</figure>
				<!-- /SIDEBAR ITEM -->
				
				<!-- SIDEBAR ITEM -->
				<figure class="product-preview-image width100 side-banner">
					<img src="https://dummyimage.com/270x270/00d6b4/fff.jpg" alt="side-banner">
				</figure>
				<!-- /SIDEBAR ITEM -->
				
			</div>
			<!-- /SIDEBAR -->
			
		</div>
	</div>
	<!-- /SECTION -->

    @include('particles.subscriber')			
	
@endsection