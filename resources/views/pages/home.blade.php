@extends('app')

@section('content')
<!-- SECTION [Home banner] -->
	<div class="main">
        <div class="interact-banner">
            <div class="noo-sh-title text-center text">
                <h2 class="banner-title">324 Design resorces to<br> boost your creative advertising</h2>
                <form class="form-search" method="POST" action="{{ URL::to('searchterm') }}">
                    <div class="input-append">
                    {{ csrf_field() }}
                        <input type="text" placeholder="find a service: eg.'Google Ad'" class="input-small search-query" name="search">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
	
	<!-- SECTION [social media] -->
	<section class="social-section" >
    <div class="container">
	
        <div class="social text-center hidden-xs">
            <ul class="p-none m-none clearfix">
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/006-facebook.png') }}" alt="facebook">
                        <span>Facebook Ads</span>
                        <span>(230 offers)</span>
					</a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/001-google-plus.png') }}" alt="google+">
                        <span>Google Ads</span>
                        <span>(230 offers)</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/005-twitter.png') }}" alt="twitter">
                        <span>Twitter</span>
                        <span>(50 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/004-youtube.png') }}" alt="youtube">
                        <span>Youtube</span>
                        <span>(14 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/003-pinterest.png') }}" alt="pintrest">
                        <span>pintrest</span>
                        <span>(11 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#others" class="selected">
                        <img src="{{ asset('home_asset/fonts/002-wordpress.png') }}" alt="wordpress">
                        <span>Wordpress</span>
                        <span>(134 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#others" class="selected">
                        <img src="{{ asset('home_asset/fonts/coding.png') }}" alt="web-banner">
                        <span>Web Banners</span>
                        <span>(230 offers)</span>
                    </a>
                </li>
            </ul>
        </div>
    
	</div>
	</section>
   
	<!-- SECTION [Categoires head] -->
	<section>
        <div class="container">
            <div class="categories">
			<h3 class="section-head browse">Browse By Categories </h3>
			<div class="dropdown-sort">
				<span>Sort By</span>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Popular
					<img src="{{ asset('home_asset/fonts/Shape2.png') }}"/></button>
					<ul class="dropdown-menu Popular">
					  <li><a href="#">element</a></li>
					  <li><a href="#">element</a></li>
					  <li><a href="#">element</a></li>
					</ul>
				  </div>
			</div>		
			
				</div>
        </div>
    </section>
    
	<!-- SECTION [Categoires] -->
	<section>
        <div class="container">
            <div class="pt-12 pb-8">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                
                                @foreach(\App\Products::where('prod_delete',false)->where('prod_status',true)->where('prod_featured',true)->where('is_service',false)->get() as $product)
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <div class="ih-item square effect13 left_to_right">
                                            <a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}">
                                            <div class="img"><img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}"></div>
                                                <div class="info">
                                                  <div class="col-md-6 col-xs-6"><span class="off1"><a href="{{ URL::to('product') }}/{{ $product->prod_slug }}/{{ $product->id }}">View</a></span></a></div>
                                                    <div class="col-md-6 col-xs-6"><span class="off2"><a href="{{ URL::to('addtocart') }}/{{ $product->id }}">Add to Cart</a></span></div>
                                                </div>

                                                </a>
                                        </div>
                                        <div class="blog-description row">
                                            <div class="col-md-8 col-xs-8">
                                                <ul class="details">
                                                    <li>
                                                        <span>{{ $product->prod_name }}</span>
                                                        @foreach(\App\Users::where('id',$product->prod_vendor_id)->get() as $user)
                                                        <span><a href="{{ URL::to('vendor')}}/{{ $user->user_slug }}/{{ $user->id }}">By <strong>{{ \App\Users::username($product->prod_vendor_id) }}</strong> in <strong> {{ \App\Category::cat_name(explode(",", $product->prod_categories)[0]) }}</strong></a></span>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                                <ul>
                                                    <li>
                                                        <span class="price new">$ {{ $product->prod_price}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
				</div>
		</div>
		<div class="gap20"></div>
		<div class="see-more">
            <button class="btn btn-primary  see" onclick="location.href='{{ URL::to('products') }}';">See More</button>
        </div>
		<div class="gap20"></div>
    </section>

    <!-- SECTION [Banner Ads] -->
	<div class="container">
        <div class="ads-banner"> </div>
    </div>

    <!-- SECTION [Services head] -->
	<section>
        <div class="container">
            <div class="categories">
                <li class="section-head browse2">Browse Our Services </li>
                <li class="service"><span><a href="{{ URL::to('services') }}" style="padding:5px">See all Services &nbsp;<img src="{{ asset('home_asset/fonts/Shape3.png')}}"></a></span></li>
            </div>
        </div>
    </section>
    
	<!-- SECTION [Services] -->
	<section>
        <div class="container">
            <div class="pt-12 pb-8">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="">
                                
                                @foreach(\App\Products::where('prod_status',true)->where('prod_delete',false)->where('prod_featured',true)->where('is_service',true)->take(3)->get() as $service)
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="{{ URL::to('service') }}/{{ $service->prod_slug }}/{{ $service->id }}">
                                            <img width="400" height="440" src="{{ \App\Products::getFileUrl($service->prod_image) }}" alt="{{ $service->prod_image_alt }}">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-8">
                                            <ul class="details">
                                                <li>

                                                    <span>{{ $service->prod_name }}</span>
                                                    @foreach(\App\Users::where('id',$service->prod_vendor_id)->get() as $user)
                                                    <span><a href="{{ URL::to('vendor')}}/{{ $user->user_slug }}/{{ $user->id }}">By <strong>{{ \App\Users::username($service->prod_vendor_id) }}</strong> in <strong> {{ \App\Category::cat_name(explode(",", $service->prod_categories)[0]) }}</strong></a></span>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                           <a class="btn btn-primary view-more" href="{{ URL::to('services') }}">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
					<div class="clearfix"></div>
					
					<div class="col-sm-12">
                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                
                                @foreach(\App\Products::where('prod_status',true)->where('prod_delete',false)->where('prod_featured',true)->where('is_service',true)->take(4)->get() as $i => $service)
                                @if($i>2)
                                <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="{{ URL::to('service') }}/{{ $service->prod_slug }}/{{ $service->id }}">
                                            <img width="400" height="440" src="{{ \App\Products::getFileUrl($service->prod_image) }}" alt="{{ $service->prod_image_alt }}">
                                        </a>
                                        <div class="blog-description row">
                                        <div class="col-md-8">
                                            <ul class="details">
                                                <li>

                                                    <span>{{ $service->prod_name }}</span>
                                                    @foreach(\App\Users::where('id',$service->prod_vendor_id)->get() as $user)
                                                    <span><a href="{{ URL::to('vendor')}}/{{ $user->user_slug }}/{{ $user->id }}">By <strong>{{ \App\Users::username($service->prod_vendor_id) }}</strong> in <strong> {{ \App\Category::cat_name(explode(",", $service->prod_categories)[0]) }}</strong></a></span>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                           <a class="btn btn-primary view-more" href="{{ URL::to('services') }}">View All</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
						<div class="gap60"></div>
                    </div>
                </div>

			</div>
		</div>
	</section>
	
	<!-- SECTION [Reviews]  -->
	<section class="broun-block reviews hidden-xs">
		<div class="carousel-reviews">
			<div class="container">
				<div class="row">
					<h2 class="Reviews">Our customers love Designminister</h2>
					<h3 class="Reviews">Across industries and neighborhoods, see how they get to work with us.</h3>
				</div>
			</div>
		</div>
		
			<div class="row">
				<div class="regular slider" id="review">
				
					<div class="review-slide">
        				    <div class="block-text rel zmin">
							    <p>Watching the news the other day, it occurred to me that people who have "Paroxi Nova" to live often begin to attack and even kill others. I thought back to my own angry youth, when I could easily use words.</p>
							    
					        </div>
							<div class="person-text rel">
				                <img src="{{ asset('home_asset/fonts/avatar.jpg')}}">
								<p class="name text-left m-none">Anna</p>
								<i>from Glasgow, Scotland</i>
							</div>
					</div>
					<div class="review-slide">
        				    <div class="block-text rel zmin">
						        
							    <p>Watching the news the other day, it occurred to me that people who have "Paroxi Nova" to live often begin to attack and even kill others. I thought back to my own angry youth, when I could easily use words.</p>
							   
					        </div>
							<div class="person-text rel">
				                <img src="{{ asset('home_asset/fonts/avatar.jpg')}}">
								<p class="name text-left m-none">Anna</p>
								<i>from Glasgow, Scotland</i>
							</div>
					</div>
					<div class="review-slide">
        				    <div class="block-text rel zmin">
						        
							    <p>Watching the news the other day, it occurred to me that people who have "Paroxi Nova" to live often begin to attack and even kill others. I thought back to my own angry youth, when I could easily use words.</p>
							    
					        </div>
							<div class="person-text rel">
				                <img src="{{ asset('home_asset/fonts/avatar.jpg')}}">
								<p class="name text-left m-none">Anna</p>
								<i>from Glasgow, Scotland</i>
							</div>
					</div>
					
			</div>
			</div>	
		
	</section>
	
	<!-- SECTION [partner]  -->
	           <section class="partner hidden-xs">
				   <div class="container">
					   <div class="row">
							<div class="col-md-12">
							<div class="partners text-center">
        					   <ul class="p-none">
        						<li class="seen">  
        								<span>As Seen On: </span>
        						</li>
        						<li>
        							<a href="#" class="selected"></a>
        							   <img src="{{ asset('home_asset/fonts/co-wsj.png')}}" alt="">
        					   </li>
        						<li>
        							<a href="#" class="selected">
        								<img src="{{ asset('home_asset/fonts/co-fastcompany.png')}}" alt=""></a>
        						</li>
        						<li>
        							<a href="#" class="selected">
        								<img src="{{ asset('home_asset/fonts/co-pando.png')}}" alt=""></a>
        						</li>
        						<li>
        							<a href="#" class="selected">
        								<img src="{{ asset('home_asset/fonts/co-forbes.png')}}" alt=""> </a>
        						</li>
        						<li>
        							<a href="#others" class="selected">
        								<img src="{{ asset('home_asset/fonts/co-inc@2x.png')}}" alt=""></a>
        						</li>
        						<li>
        							<a href="#others" class="selected">
        								<img src="{{ asset('home_asset/fonts/co-entrepreneur.png')}}" alt=""></a>
        						</li>
        					   </ul>
					       </div>
					       </div>
					   </div>
				   </div>
			   </section>

@endsection