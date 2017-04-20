@extends('app')

@section('content')
    <!-- SECTION [Home banner] -->
	<div class="main">
        <div class="interact-banner">
            <div class="noo-sh-title text-center text">
                <h2 class="banner-title">324 Design resorces to<br> boost your creative advertising</h2>
                <form class="form-search">
                    <div class="input-append">
                        <input type="text" placeholder="find a service: eg.'Google Ad'" class="input-small search-query">
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
                        <img src="{{ asset('home_asset/fonts/006-facebook.png')}}" alt="">
                        <span>Facebook Ads</span>
                        <span>(230 offers)</span>
					</a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/001-google-plus.png')}}" alt="">
                        <span>Google Ads</span>
                        <span>(230 offers)</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/005-twitter.png')}}" alt="">
                        <span>Twitter</span>
                        <span>(50 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/004-youtube.png')}}" alt="">
                        <span>Youtube</span>
                        <span>(14 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="selected">
                        <img src="{{ asset('home_asset/fonts/003-pinterest.png')}}" alt="">
                        <span>pintrest</span>
                        <span>(11 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#others" class="selected">
                        <img src="{{ asset('home_asset/fonts/002-wordpress.png')}}" alt="">
                        <span>Wordpress</span>
                        <span>(134 offers)</span>
                    </a>
                </li>
                <li>
                    <a href="#others" class="selected">
                        <img src="{{ asset('home_asset/fonts/coding.png')}}" alt="">
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
					<img src="{{ asset('home_asset/fonts/Shape2.png')}}"/></button>
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

                @foreach(\App\Products::where('prod_delete',false)->where('prod_status',true)->where('prod_featured',true)->where('is_service',false)->get() as $i => $product)
                @if($i%3==0)
                <div class="row">
                    <div class="col-sm-12">

                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                @endif
                         
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <div class="ih-item square effect13 left_to_right">
	                                        <a href="#">
	                                            <div class="img"><img src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt1}}"></div>
	                                            <div class="info">
	                                                <div class="col-md-6 col-xs-6"><a href="{{ URL::to('/product')}}/{{ $product->prod_slug }}/{{ $product->id}}"><span class="off1">View</span></a></div>
	                                                <div class="col-md-6 col-xs-6"><a href="{{ URL::to('addtocart')}}/{{ $product->id }}"><span class="off2">Add to Cart</span></a></div>
						                        </div>
							                </a>
						                </div>
										<div class="blog-description row">
                                       		<div class="col-md-8 col-xs-8">
                                            	<ul class="details">
                                                	<li>

                                                    	<span>{{ $product->prod_name }}</span>
                                                    	@foreach(\App\Users::where('id',$product->prod_vendor_id)->get() as $vendor)
                                                    	<span><a>By <strong>{{ \App\Users::username($vendor->id) }}</strong> 
														@endforeach
                                                    	in <strong> {{ \App\Category::cat_name(strtok($product->prod_categories, '/')) }}</strong></a></span>
                                                	</li>
                                            	</ul>
                                        	</div>
                                        	<div class="col-md-4 col-xs-4">
                                            	<ul>
                                                	<li>
	                                                    <span class="price">${{ $product->prod_price }}</span>
    	                                            </li>
        	                                    </ul>
            	                            </div>
										</div>
                                    </div>
                                </div>
                                @if($i%3==0)
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
		<div class="gap20"></div>
		<div class="see-more">
            <button type="submit" class="btn btn-primary  see">See More</button>
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
                <li class="service"><span><a href="#" style="padding:5px">See all Services &nbsp;<img src="{{ asset('home_asset/fonts/Shape3.png')}}"></a></span></li>
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
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                           <a class="btn btn-primary view-more" href="#">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                               <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="btn btn-primary view-more" href="#">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="btn btn-primary view-more" href="#">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="clearfix"></div>
					
					<div class="col-sm-12">
                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-6">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>Starting at $20</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary view-more" href="blog-detail.html">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                                <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-6">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>Starting at $20</a></span>
													</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6  text-right">
                                            <a class="btn btn-primary view-more" href="blog-detail.html">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
                               <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-6">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>Starting at $20</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6  text-right">
                                            <a class="btn btn-primary view-more" href="blog-detail.html">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
								<div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                        <a class="blog-thumbnail" href="blog-detail.html">
                                            <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </a>
										<div class="blog-description row">
                                        <div class="col-md-6">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>Starting at $20</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6  text-right">
                                            <a class="btn btn-primary view-more" href="blog-detail.html">View All</a>
                                        </div>
										</div>
                                    </div>
                                </div>
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
				                <img src="data:image/png;base64,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">
								<p class="name text-left m-none">Anna</p>
								<i>from Glasgow, Scotland</i>
							</div>
					</div>
					<div class="review-slide">
        				    <div class="block-text rel zmin">
						        
							    <p>Watching the news the other day, it occurred to me that people who have "Paroxi Nova" to live often begin to attack and even kill others. I thought back to my own angry youth, when I could easily use words.</p>
							   
					        </div>
							<div class="person-text rel">
				                <img src="data:image/png;base64,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">
								<p class="name text-left m-none">Anna</p>
								<i>from Glasgow, Scotland</i>
							</div>
					</div>
					<div class="review-slide">
        				    <div class="block-text rel zmin">
						        
							    <p>Watching the news the other day, it occurred to me that people who have "Paroxi Nova" to live often begin to attack and even kill others. I thought back to my own angry youth, when I could easily use words.</p>
							    
					        </div>
							<div class="person-text rel">
				                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABRCAYAAABSb7HBAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAN7RJREFUeNrMfGmwpOd11vOt/fXX+3L3ZfYZzUijxbJieXdsvKGsREFUqFAuIKQICRRQKQI/qOIHPyhIkUoKCAEKEwoTl01SSaxIthzbsSQ71q7ZNPvMnbv37X39+lt5zttjUIaZ0Yh0CFfVunf69u3+vvOe85znOee8r5YkCe70tfbybwFGAks3oRs2dC1BoDsw4gS6pQF2Bk7lBLqXz+HG6y/i1W8+h3K1iCgK0W52YdsGDj+wD6VcFmsXN+HmXfiDLh759KcR9EY4+9IFrL7nPai9/DJ0b4hKZRa2Yx0zNXwIiX3YSjmHNds6YPNzdOgP67ZlxIYOhEEUI3kj0WJek3ZNC4PLAR8IwxfCJLwwGHUxGg7h94cIEwP9wRCdxh5ys3kc/8CDsPNFbFy/hiyvKzbSuPjSG3j8E48iN1OBFxrYuXwd3d1dGEaIyEohk06jsnIIxSPvhVY5ilTKAe8evAhkXAf38mXe7ZeOY/FGAJ2GNnQDsGzYXBct4SekikgMLoBm0fBDeM0mcjaQL6Sxt1FDWtOQK7goFvPAyEdaj2HGPmYPH0ahmMWZ1y/BKeSQ1JuFpNX9kcr87BPZbO6j6ZQ5D36eaad4o7a6RCPFn02D/06p64r0xNC05NFwPEISR4/qtgnXzNEZDETj0Y7d1f4o76Sf9bO53+n1hx2Ta2PFRYy9MeBHcB0TC0sLkIWysxXEJw4im80ibdtcXwPFnAXb2of6pTdh5TX4gQG/uQWtvw2zvEID0A5cAE0zcK9f5ju9gPbiBWl8mMroWuTT8hbCKIHh5pEMmzC0EF63hup8hQbRkMm50LL8XuRqJxFCP0SCEFYqi/zMHI0RodcefMaZnf1c+9raj9iGmbYdF2aKN+CmaWcbGg2r0RsTfpZlO0hoLZ03pstFSBRysS2HC6DpXACd7x/D98f8vzafzlaeihP/KWM8+LeJZvyeaaQ+z9c8u7e+hf5uC+UDK0hlbAy6HqPOQml+lreUQkwXtdNZtSDZTAGd0hzGLRo4HaDP1+Uau8iUmrwfH2Zxgdd174bW72pkPmLCRWJy9ei9USi3wxumB8e8Uc2u0mhd3neA4mwBqWyKsBExtGwajV6WTau/j2mYKAxoHAOptPVTgReesozkmXjQfyrs99IuF0b+xjItRInOzzKUN2s0oM7PpXUZUaZadV0My++mRa9PpQltBpEkRjD2+WuNBuR7cbEsJwcnU0ync9mnbNt8hgY9ZZnGT3V26zRUgHQ+DyvD64t5R4aFgDcbJnxffm66kIXX3kZ1dRFmmlA46MPrtNFv78HvNOnhGu0Q49183dXQYRwh5k0YNGoSezQYL8jeDz9xlacmOnE7leFNBrCyZXF9ZGhsg/idzmVoVAc6/37U96DF2ifTpdJ5K535b6Ph4KRBD4l7Qxj+iK9LqTBmBuDiJnwIXpk0tKMMbVjGTQPrXDguPh06SuR1sVrYRE9gOml6o6s8Pk6IreFILa5l8fmUi0y+fLJQqfy3ODHOD3ujT8oipQkXGqPH4t/F9IPxaKw+PZMr8T0YJb0uCjO8L8JjxMUZ1Lfh775Op+B1EAyCIJiSR0eBYCCCaBL+WrAHY3gRoT1DaDiCZNxkePvEr3UaIlAh7RACYsKMxRsJx2NJGEv+yPtSYllfy+TdY/RV9bx4bdjpMvwseqYsDr1XFwiQKKK5eaPKk4m/cQjlrfI3mjwtESuG5j9s4qp8ltyI36fntXsIGfoSRWpx7ElEeL0BTHq6puvHeuvbX0vZzpcIWavyvgJBwdBHEvgq/2j8AJPG7zTovb0mMsw73mDABDvCuNcCOpdhMlJ1fUrQkURc4dCj+wS8cJ83TMPRuJCwiUY0UJELkMD36InCROhtARfGKeZoOFOS6JO+H54dD7wndcKC66bgj7lgtKZpWbQMsY4ZPeVmmPwyXBQaWpgNWQsBc4JdkkgM/iAP7WZSkYQs7IOGN+mRMT1r1B9AGInF5OsWKoysEllOiZ5cwOzKPArVsoKbkNfar7f4OQavyTjFKJHvGPO64iCEPxoxmEwVHbJI7b0OIho4lSUxSGy+LkLUuML32VG5YSqGjngDYtyASSaMBWcHiNIrTGsZeCPSJ39I9kGKROwdk7bp1oQluNmCTaf+NYbkl0IvLPQ6fbUIFm+A78KE5whrZPZPwclyUcgw6JoTLOfnaISgmN6iczFMw1BJ0GRSFE8THBV4ME3x9JA3Tu/lXaRI1Zx0hp9BA1mOggydv2ht7eDKqTNo1nYJFcRtx1HeK4nPsFKFKIm+xMj4tWA8tofDMYbtNq9D4+9sLpZLBpslVaXDDekgJiGJ8NK5sYa4eZH335sO64jE8ySU4CMyl2kk3rTAhl8j380B3hYvqqi8VBZFws10nHLfi37XTPQP6QzpUdDBkJx22V3h+2kq5GwaRcIuDCfMQUI8odHUynOFDDvNBxkIjcnUyM805BcKUmQhDFkwoZiENINJVBZGV9DC1xOr5Voau9vk6S/j/JunCbGmgp0C4Wl2tgij4CAeDsiaiNEYy139PA3/cGxoPzrs95q5lKWgKeUwqdNC6XwafXJyk5AUZgmVoYPtV15AcX8L1Uef/NMbWsI4lMtgwrKNNhJ3hthAKAn6xEdSNi1NDO+h1+9hNAqRTTlLdNhnRp3+yUIxoxKKYGZA7LMcSVI0DPFSI4yENH4cjJmoHHJSehnhSFE4SYI0PPMbGUE0AWSGKLGV2Zk4KslPiDF/Z/B9hI1IGhUDa4Qgr9nCK9/6Nl7/7nfBC8Kjf/HTOPDAQ8wLHq6fPoutN19Dhkly2Gohn8mr90iU+Ig+5PvJt7Q4/GxqNN4Up4kJnaWFWWydvwZhRsOORwfoSyRgVO/yZ5eGnoJHK9yVmxTqE5IhxLNIrAxvOsBYZybPraJ56Q3alqHtFpdMM/qONxqv9lodWPQUM73A0A4UQyC402gpWOJFNE631oZDT5VkpiCCt8t1IAO0VeJTXDkWO2sqSQo+a6SXpvJyfQItsggCK2neBpnF3vnLeO7pp7FZq+H4+96Lj37qk8iVSswFTNRxFrMf+TB2yKHfev459Jtt5JaXVTT5jABZXH/YO0mm8h3bND6QzuU3hVXlckVUDyxjb21dQVt9bYc5iZjNfDPotqckWMgvST0I+gy1VJVeuEMRwhsrHEBA7kyJhrVz5wSvC0bQf0Yr5Fa9lscM38M4RSvx4sOQmMzQVfgsxuPCSaIRrzZIGW1HxImp3ouowQRrKVVomyIgIvWAJEdl1AnTSCwRM7bCe0OSKqPi6vdew/Nf/xrcSh4//tM/iUOHj/I1TNS1uhBVjMmXAzKnIhd6ef8BiKr0x4wquoTwReHh42GP7GK86uZSzyRJ9GHCWifk3+UrRRVNa2evYDgKKLa6WDxYQbE6Nx1DS2ZXKOnMkNzP8XrmaNQas/cAhbkjdNIhHwO7ubXxTKWUO6kT1MmR4fU7CPIpxcFDcjObxguIx4N+F2VzhQtHkpcy6NFFctgsvZgZPZ4kOUNjIjPIh2lsjZI98j3iN9mJKDdlaE3huOCuuny+V/3iFaxdOIXjj96PlX3LyBD362+dR59swWOydJnUXBFTsRCdWEVQ6DHpeYRBy1KfEYz6KnLGgxFGndZJbzh6plQpfizwPV/YSjrvYu7gAq6fWWNq0NDe6SHjXp+SocXFaASTRo66FxiiMxQHlNUxszATS+/qRbRunP/lfr///gIxzOv24PMRctV9PpjJKQKIawzdgI+QGVvjYkRkMVKoEkGTyuZ508wEtqbYh82HRQw2JR8ZVG56qLxJKTGhKlwMBS30dJ2ePWYYt1s7WD5+kDdj4sKpS7h6+QreuL6OtUYfHXpuxrFwbHEWHzlxGAukeTqjSISS32/B4r+VN3f4M2HMoTT3ea1REL2fvPyXS5XMLwxHE2fJ5NLYd4IwstVSKrlRnxLrMPMr6iWa3yCVClSmV15uuSKjcPHFbz41aHd+vt8domU3kDYLTIpDjOghJilcQo8f9+gp9ByhVCOS/iF/70oC4wJuEPf29trY3d1jandRKBaYaBMMyK+l0rd/3woWV5fIhbOCyrQ3GYIr2DwpECRctEFXBEUW476PRjfA9xjez50+hy7fg1oWbRqkvbGH1xs9nNlu4uOHV/HYg4eQJayMmjVYpUX1PpIQuvU6yoslcvIhsuUMmUv35zUtfsF24i8Go0hFnERXuUIxltBRiqXpGDoeNmDNPAIvGEAvz1J6FsgyAhhOBsP63tK1U6//+/puXXnZmB4spUmPgqDdGTCxMAS7hBCpsAURBuTSdnHM58dI2R52uQCnvvc6Zpf30SA2AiqueGsPnh8o7/Wo8rJmgiPLC/jwJz6K6tISP4Y3G5LiKaGgcfE88t4enycNy1fR3ziPysGj+MEDR7D36h/CKu9j/g2QO/gofv+ZZ3F+cx0P0vBzy6SafgvD3Qbc2Q5Dh8qgnEN/Z4/XmpYyLDE8QXkmD2qAfz/sBC9kMsamYTBnMEqDcUzOnkLOHE/J0GQJSUgFmK4A7fOIR+uq5uEWPoity+d+ZRSMClppBiVmYCOhEfsk8zTo0PPVyneYiALyY4mGSBR6KLARcwF6qM6X8dgPfhQnfuAxRHx9k0xBaisJQ9olVZM/aOw0yG50XLy8jpBGXlhdVEyEfFGKd0xKjLTIQHp2Ae16h3+XwU/9nb+ON8+dwVeuvwZnjtc9ruNv/pW/jCNajD949vfx8ccewYETD2B3/SJ6vD6vsUVaWGVeEOjSMeyNKGwcYjvhgpBWqbiF7c3mr2yv9X9ycX+JBiaZJD3q94YYtJq4fxrK0ErlkAxo3N2XFD2TGoYuXNosPbFz8Y0nJR+ZhIUWvVoUVUSObdBYORpeqG6HoSjFGPnyxUv8iJhKVtIVakclOOxi7Y9fxPbpVylraygRl/eTclVnK9hlUtqi55SWD8DJF7kQexg2KYcpk2MKh8i7GR05OgMXOSQMwBvird/9AlxG0vLifTBau1gu7MOZr/4++rsX8Nee+AgevP8+jGgkRwRXyDxz4yrzIaOEjMTNMTHSQaSuYYUexVaI+nqdTpF9srov90S/Q5YSU9VK8qYjBGEyHY9OEmb8cYdBShrllqWxAae4z+i1Gr986fQpBIMxE42Nrf4ADhnCiLDiMbHksmmYkQ+DrENK9UNm6bEwEIoGj8alnqX3D3B9bRMjrvWuF1F7GoRn4ikhY0Qs7tGIH3n4JG+yhZkSZbonNe8+4SuDkAwEPjm11EJ8Xl8xi/TB/YSObVw5fwb9028gQzle3HeMCBPgxuU38eCxVRx64GFKeoqN7kAVrSyziOHWReQPtGlsZoHBEKmMsCwHEXOKw+cGfF1vL4DjWr/szuefTWXyUY+qU6p/IuemAx3jHmlUXkln2y4g4kXbucWnrr/45WP17XXMzs+gSyXm0si5FG+ecrhUphfmLbgmIYJuPc7kFM0S1jHga8fdFlnDWHn8ASa7r1/awh9eXsMik18lX8J+Jr/FYh4PHT2IOeGp9PzO7hY8KrnAMVUpVoRNRB4vYsojZYycDj86j2oxjfTxI3TURDmFzuiyyWYymSNcsHny9JRSoxYhIuxFqigWxzkMN67DnZtDnRx9sNtFYSWFwJa6mY8CaWpCnp+ZmT826IVPjbZaX5A6e22jrYTcdGoddpVSWFeSE1aOK2wxbP1fam0w3GhYncQ0a5NjFtLQMy5yxRwTTRnZTAodJpZUPkY6FSLNmwsZZmOG7KhH6WoQw0ca5her+NsnT+AfFJ8kf04QM3wLpVmMybmlUNSn5/VqO/DqW0gbFB3Eb6GGJumaP/YUHWQeQ//GZTiVBdKvGeTLZWVc4deKTQg3T4Q/MymPRiJP4FLgJKoEXCK1PIDWtQuoEO5KSzPYuzjG3pUamYxDyEqpRJnLGjR6n2py9EvDTu8LjltQybPdmJIyFLYQE6fNdEGxh9zs3BOD2tbJ2pVzyKV1EnaqvVRWohiF2TIcU1NtLyufgdEbI81Filp9bJM/GwUoSBDVmNJCLpKL/FIRFfJYK5PHiOxB1KLX65DlUOIPxyp5GsT9rAhURktElSmPgEYmBiCgGEoxARrk1CMmNcFNJz+nenymFKJiKGUaCi2VOguvTQpSJp0jb5e5AFSZpJTj7ix61xswKvRc3gfEIQhtOq9TlGen3ibbacEMk5P82M+M/fBZyVfZwpTonZGp0nB5JkEHdrZMGEl/rnnpDOo7m5hZXqKX8UY0wgQNJUWiccZAZW6exuGiFF1iYR91kvoCPT3LzLnbbKMqIoYGyTBCMjalPb1OsN6xXZWZxyPSNVLEtOWQi5sYklrm+FmDThsphr5Dw2rS3YiG5PMGvbiMKFNAmh4X8HPHzV1lnFCKU7o+qeqZmipWWVZq8m9tUj/JuOTDTR1px6UIIdXTA9WtSeds1VOUa0uYMC1pPhAKbUm6ife5oNN6VhZsGEwpGeo+L9okvx0wQ6NcCHvhE9sXXlMd43yJN2clpEOe8jCbz80vz8LixTG3MSn20O145KI5WMzewVjaYsRF0j2vNUJ5yUVKTyNlOCqxGLqlqnVy6SmGZkxvDPwBQ7iIUTSgEPIICyXV6RY5PhpSgRKSDMKFkZEuuU1HMCatLTEmJr1Kqe7p5sSTVaVOl4ZGKBfICIiQrhASvS6sHRNeMyQldMi9LVhZQsNeA73uiAlYU6UWnUo1ZSU/whspYOB1MqY5JYzu70pvmRKc4Z0qPxl2aul+ZxfFUl55bChNS3LgHrP1/e/dp4r0kSSblMvvMQ4cnseISazTHKgudT7vICTPzllF/n1JzYcYNIlxc5xBvM60bFXf1uk9RjqLmDhcu7ZFhiHFJkctxFjqEvzLiKE9JrSYpgvbpTOkuAiG6uxI4XTSU+SKmeakRCvXoAXSkpsIjygiBBF+Mvk0FqgYG4y4EQ3rlDWkmcSl07Iz3oJkbotKV34XBrrUCp+0C7n/JEl5Oq0s0V8mWYdRQWzlPj7u7kAjVzWZOCTfeO0BGntNChhpgJoIKa+dTIaJg3Axk+LF2jSWhKGDYd9DSHHh9zVK2BnV5mdgku4NSKWkcBRMMFQXDm4qmZ+mZ3dqu0oau3YWtng92YvUpGVxkkBk8w6TZl0E+qSpq0mDgO/NSCH4Q7elLm5Li1t5scyYxMOxqm94owGC/kg5RZrwlq+W0OyM0ZK6M5NvOu2gTGXaHUgLb6yKmZlyHqlC6eO2QwZj21PqghtMdHqB2JYBudknR526EiWi+XvtDtpUeDrZx+qRg6oZIMRfikqJFJ0YoyNpqpK39hsDdChA6l0KDEKMFJOkbhH5vjKcz8WLQ2lhWQp/TYZ4igYatTqord9QoW4Ke5C6temoDrmMO0htMaKx+sTl4YB0i96rSatRSqvSJLjZtVHPk9HoFECJF6i5DIEd+S6dbGEuCSNK2mqSKB1GW6BnlKOJsWeWqEil3cZFHLe7dKDUZ3KVEmYorKZTVHKIf4NrxDL7JOnFzKixqbCyyFUe1Jv00jHmGXJuMoA2DlTHpUNKJuVMkdzDunS5JzMQEooDyvlEDym1fYY8ObkU9gVT/VDht84nIimFgvARDLmQNbKIPAzfhk1Zni1X4RCzhZmE8QgaRUk2V2EkSW2FyTjtEbY0RUmlABbrfE+KpUR6m/RIYVEhHWWC44QWMZ6wEWniqA67rq5roVREq+GhvX4VK4dXUC5nmXzJiHiPna06o6xTNlLpk7qVnJ6KR1sO6Ut2hT+4D+tUia2tLcQylkVv3Lq6Te9Mo2Axue1sKNrVoyCR3lqrOcTl18+hSKrkliuqtrxyaJnRYZO2eUxaFAy8Qc/31JyepidqMSScxegJn+836uTJBrFcjDuDARNuIt0eMgyDXiZzFeMhvXNIQxFWJOoEm2M1qBMonqzxOhOPC6JaYPwc4rEqt+oTfi0TURY5teQFnaxIaubi/flSFvXdBjbeWsO3/uB7uHL2KllRSinFXMUl3ybTScKHu31/SjyamIj0Mj3DPxaOazTiCFlK7sb6rqqgZWQSqd9GQJqU0kRE9OAPQtQ3ajj6yH1YOn4f1s9eQIoekqvmya8JGbZgsK5oVEiK5ocG6SAFOI0RCQWLCDnS/aChxIsFJlJkE/3aALXNG5ilncZ87bDVQO3iFczvP0L6t0CMzSruLLXtOIwnWM3F1MTwMgwpCykjEzJcI/MO0pXn/0LClAzlaIZGBUsJzlSXdm30W03Y9PJrtRZalPYpXs/qe04QToj/opj18JjrTgmjo9GeusBYd0+EcVp1nHOFFNrMztKmMkJ6p2RnN69UnTcKMCQlWlidw8FHH1G16A4xe25lhtI8r7jtWpeeRqmWkhkLRDSaR8ETKTonDCGIA+arATHRpJoLlfeZLj17oYIBPXKTKnHEhclUZnH/Zz6NufuPwnHJOuiVsUAAvU7mUbREmEukBmIkadIDVYlXWmOJTOTwd4o0SJTI6AJZjAgTgbrAowokNIozVFwL+1dm0WG+uHHqLSX/s4v7+DnFk0JZp2JoBNswxpvQBtcOR5qNbOUQLFFkxCqTN1NeXYVdmFXKbDxgwmv16FUW5vbtY8gOyUH5oDK06EH5nIvdRh/fZhiKw0kSVXSNBgho7JheKkMygt8+DaEMPuwqumgyUaWzGcrzkhoflukpm5RMvFC4t+QEUYDSSpNmbqLHCiKS7zcIFJSESqhE9ExZUDGsZsvIraXaYjLYWN/ehZulN3c9jHpS8mUE07mq8xRXxQwX3sfOhfMIx1K/njmQyhanY2g10BL1eZH+jBZ0iVGeKu4PZdqykKNIyahOsM7QlE6yLEI6nwWZD2lXm1I6UQKj0+ipeQ4npePVzTouM6HYNIjFm4AlVTsaFp4qFAkOhwzlsTeg0fkcObBGPLXJOAr5KiqlCjKkkJaqZTCx8qHGEogGoZANCQ1Mpk2li68awvpkhGx8czFVM9iyFdeWfmVM7GjVW2iQUVikqds3tnlfAzWHV6kS+/mctLnMdIoSvYJuu4Gdze0Z1eqbikcLhaIaYgbPmkY8yc7E1xSNJu0lm6rMo8eOhZ4xEAMvUCO8MZNZ7cY6fUZESokZvMPfDbHMRNKlO3+DXh2EYxXmMkVq6FKIjRSvltHbSKajZPxMBIbYJrC5SCUloWMmRaFqwn1lUZKbPVqSbMUyonhC6b5vfN0S4SKLKVcoE1CmYhwyOQVjMnUmlcXaTkMV9NOOhc21XbKYAcrFNGbmi5MpYTXHZiA7X1HXtfXWlez2pevTMrR2k4d6WS0mBCg809RYQIqiI5Z5ZWlzqXdiIhr6lOXAzvoWDb0Jg8mnurLIBDlkIh3g4GwWC46D597axNXNPQUpAh8yaC5Gk4CW6pwMMmoynNijqFhjEr60g/bZbfTO78IcWnCkK59dgpadJwPJqWZrbCSq+SLsJ1Q4HCkvlpkSWYBEebI+mReR2URjIm5keTvtHrbXNlEo2mQ3IdYubaGcT+HgCX4GwzPFHGBRpBVnyhRkBdU6C8ZedkBlPBVDm2qIhR5iZNXcm+EYEmxwZVSKoWxQPJi0rHiNtIAgyZE46QvVI81rrK/BScuguIlGo4tV8tH3HajgCkP0Ky+/paY3Y9miYU7kt8wqq4ldCVNRdp0EXQoXPHYE2kPz6NMQ7cGkjNm9ROZT48u9Ej2cr/VjNcchBg/IsSPpCBmTpqvAi/wU3qyDqIEc4c1cUemib1xdJyWtM2nP4urFbVVOPXDfEjLVChP6JPLcXFYN42ixNDEmE6/pcnFKtQ65KBrPSJf7RLJsmhipPqCQpQDJqimfiKk+CCblSydjYUCD+/TaCkOsvtNGdV8XBV7QiAxExMcPPXIA311r4Esvn8cnHz2GRx45SXSeTCLJ/UdJrMRD3snia5du4DWKpB/P6Tj+0cdRfM9DXEh6pq/B291Df48sYSuExYRJrYQ45UPLk80IxhEGTJGJwjq+P0edaJMpVG3yYWPK8e21dVy/cAEzi0XV4Khd28YDJ5Yxd2AF3S4VpBSmolhJ79r1HVT3L6JPVewPx309SaaVDDU1Tcr/97VUjuKjqPZvSNG7NL+gEp3XkzpAiHwxT5UqU/r05s4QhdmSWpDLp8+jMFdVNzkMQhxcLuCnP3QcO/ybzz/3CnwugCFMQQ02aWpWw9Sk0B7i5asXce6VV3HpN38Xb/zr38Jrv/pfsfW9U+TYQ0TSIzs0i/acgwuXLmDv0gYGN7oUT11GRqKcJAwnQkj+HYpU1Sdz+pJnAib0vY0tXH3rAtXiEPsOL6C5VcP+/fNYOLCIgMKs1+yphclVq2jtDbC7tjPh42RYfK++1NCnUyYl05WR2cTv74XO0rxU8dzyDNpb6/BHPaQrBcVXPU8j9cuo2oVMxxfLaQw7HRw8voLXXziLLjmo7Qj8UA2OE/zw40ex1vTw4qVNPH/qEj794fehLdsdxHtSFD7kIGGgoaynsH+ujIceehShk0P76g5GW9/EjW+8RIycVO4M4m7sJ1gnPFQLeawcXSYVrKgujGTDKIpvQpKuxIrQP4+Q1aIQuXr5IjavXsWx9x6GnbGRJgW1GI0mWc3Vi1twyaak+ZuiQw2Hnoo2mSuUimOplN8bkplMxaPVNgX1Xb8WeyTw2QUUDz2qPL1z4zKiYUMVyIfky3YmBbuYU03YXC6juiMit4+ePIRrb11R4SrzECMmKT/y8TNPvAfLs0X8sy9+FXWKA0OXAfQAmVxBRnbkRvD44x+Azps3+bdu2sYsE+vcyhIWZuewtLKKmQK9b26VeHqcoX4ETSrXq2dlLCJSs9pC3+QGEilIyQMCdRHaNNbWjRvYoLLMU7EeePAw1yFFaiojamlsbvexdfWG6spEhE6PDuQUC3Q4mZjS1OB7uuBe0/SplUmlXiwFdO20gKgd7aG8SLmbKzJJNEjtGigsrVKBxaoTka+U1YD3yPNRnietI5eeWchjdt88tq9vkS2k+aAg6PdJESP83Sd+AFe7I3z+2W/RewLmM8pu3qjFJJtYMR46dhTluRXsdFrIUrqXZqqYobFL5QoqhQKW9q1gdn4exVwO83Nz2H/0GD30OhrXr9MzbXV30sDVTV1ROnFsGexp1pqorW1QfCZ476c+QFjjNTG3DMmMIgqic29eRCkre1xSyJYZtZarKoW5tKH20WiJDBHZ54qzM1Oid5hsZ9Bj74JGxad7TGwLRVTve5RKsIdRfQfu7BJKK8torW+gtLyIbCkHj3ROeGdO6rtUg499RDZR5tSWOSeXZ7bOYY/4t6/o4Bd/6EP44vOncI03rgVkLuTrMlE6Im5W6bmzXJxXgqaa2ci4FEN82Axv2RKXzbg0ehm5YpGKLoNssUSBMadaU7FSgpPp1US4Mz1atmx0Wl109xoYtOrYd/9+uKUCdpkA23VCIb324vlr0MZDZPl+dlqoZ1rtkZFZwOoyVTBFi1QQDSN1LlfJT8fQUohPZHBc09+wwj5VWoohZuHA4x/lBeSRjFtIM8Tn3vtBMo+xkrez9DKR5O1twoq0hDI0MBXiYx9/FLVaQ3gRUmYahZk8NsmlP8Bsf3i+it9+4U3ETDJjKk+BirHHRMMbff/xR7HvkYfRMBi2zZYq1AsIyNYHwVLLZZRkmYjzFZn8pdTPMuoWJ4pRJi9ku5VUB/meIzqAR6/12rxu0tLZQ/uwefYiBVVd3a+o3kuX1hlFVRXPRoaRJXROiv5878ryAulqjgnSkgniNzRMiXVIx0LNI5s4reuppsjegIkvv7iKuQc/yCQ4wmjtDSbCEpYe+yiG5KLV1RXlaVIjrm/XyD+J12YGBSbOB3/wfWjsNtTEUp6en53Nkyq18eEjC3jxreu4sbFNytVVHF22XfjGGIvVJThkJv2leXhMPpbscQknwia5uRNW+Lwt84A3GFWVOejp9KSARJYTJTfn9ORa+T7SFBj2W5g9vIhhq4nmTo2eDsVMtrbb6FN0yW5fg8nUSUsZ1cCY2Cwz3ZabUdvxRu160zS102oP5FQwWs0ji3CRgmL8nBEOkAo21DaLhQfug06vHtT2MK6vY+bwMTjlRUWhKkdOqK0IsRibFErmkQeDGPsPruDIBx9TtYTubgvL9CiX/LScjNXs23cvrSlImkQRE+5gF5XVZRRJoyonDqJXNeHvbqvppxTZkCG7CRgFGj21efkSxrvrWHjPI4r+QUaBpWtzsyc37HRV3UP6hCaFjLCk+vouRY2N3T0ZXRtSrTYx4kK4hEmLESOdIFXtG9PQblY9F5OxEPOfM0WN2taUPFqb7P2TPc8Mk29oav+JzBgMiFfkyQvH1Ay1t7upasFGaZFh2EZloUxvnYXLhOUPO/A6e6qQIw2BQ8cP4KHP/AXs8qb21ndw5AMP4fCRFRwijfr2a+ewu72pJvRls5DnDWDmM7h/5n5Uuk2s/MgncH2wjkt//E2Ee9vE0j78Wg3XX/ouzj7737Hy/sdhFRlB2pjXbSlPFqUdq2n+seqEj5mIyytz6Df76DEBrjOKZG672xviGpO3FLtku12shA6pgDfZN6PTqEI9JUISzf6G2CU1LUPriTWZrlfT/9qXdd0YicwdR9KSr2Lh+Ene2DwCGkEasqnKCvq+idrmBlzCh5PJIzszg0G3gVFzW+Fmq97BsUdO4L1PfBrnXnoTu2Qjhx9/BO9/6ACubrfwx6+fRjLoqIQm9Yl6/Soq9x2D8foWkktnMfPDn8EZrYNvvPIMvvPCV/Dc17+Mb7/w28guLaJ67BHi77rC7URqscmkmSK7wmT7npRTpViVKWfR5XXsNLqo82EyCjtkP11Gh5QXlFiTLSDMAUJbrWxGvZ9Qw0HfG41avS9L+cCypjRuMCkvTryaFm/y0p+mPz+pU1JI1byynEN35yiM1hUMN64gqT6gKnrbl09RQlOZUeLaZpaMoKyqbaHMYtCAO1fWsP+R4/jQUz+BP/g3/xnhx38Ajz3+AE68fBFfZVL82Pveh8XDD5B5BOi3CBWuDmdmBcHzG1g4GeMn/tbPoMNFG2ztofHmeczZJax8/IfQXzsDIy+AS4UahUodGjIf4nmqTu7RGWS6bdzto1Frq3ZVqMUqZ/g2GTLFViWTVnMdaTOlEq6Tz2Lc8dVeQPmPtniairMphhfVPB3o4KpGEkZi51iKMPi80CQr9hD4Mb15DgVK8dTKe+A1dxBsv4Xm+jWKmBxGvoYuKVx9bRvXzl5GbaerZuUMqjMphe6cv4j7f/AxPP7jn8FXf+sZRsEu/uonHkEwCvDtF19WWT6dzkAjO9jbuIw4YyB39ATQI4t5/grc713HDEnMg/e9D6uffAKj7Wv0Vkpk8WbB7jhQTYVIClfRWO1yjQkbMggjgzEDwXaypGLGVhuWIulncXGkVSdYLERARoN1GlyeD0NfdLLsyPq89Eo9Jk052mI69M4khVI1y8lqMrU8zQs4F0/2LxOrSsjPL5FaVZGUjmCwI2qRDKHVpnIihlNgePTqbN7FlVPnsXblhmqE2jJjNxxg99wFfPhHP4IHPvwo/sdvfR2uZeCjJ1Zw9o1zuM7kliPGi8gxVvLk3VdRr12Dl2KkVEjl+Jl6oYqQHLd14XVK4/PQq1kkMuMQqs3jKqHKVjU5AkOM1dndhc9F6DV6amop7VCQMMJ6A08d4nKIlFO25MkYQiJNA8FmmUClQBkP2jIScW7Y7T5ty6kIco7IzfNDpiDBJ5vc1cZOMXYiJRX9n4vEYlqAFewhTTUoGFY88TGuuMlkMkZKutxjT504kNCwsqfvofefwDql+HU+pF4intXY3kBrexc//jd+jIpvDn/04mkszRcxR0X2+re/rdpbTspVOwDS+6sYFwLUmuew07qARucaauunqPBewSDYJGxlocaViaOSvPXEmHglMVq6M929FgbtrjpAYEzDOjSyNJdt8Uqp6dN7lopZVQuR1pa0zMSQFqMwYjKVee4kjv657NoipiFN/BYImo6hZVZNToHRrMnZHZNNll/kpVyQfoWacUstysw0bD2AU1pgOI7pKdKKiei1IxpwCZvrLXRbfRw9eQAXXnsT1948gyK5uAia62cvUIQM8NTnPkMx0cPVWh/5PENzt4aNC+eUkrR4DTZvusCElz+0BHchC3PWhr5IbruvjNRsFURTwpupuLMWqyMSJq0q8Uayl8baOuysq0bBjJROrp9VI2zCLlKODOwYfEgnnIvARK7qfgE9nVxaopds5YI/Gn3Rl90G6rgFGSvuTUuwJBNtr01GYEXWkldGSaz/Q6oCmrpED0mpRmvn6hvYubam2vHhaKQ2p8vcnVz0wQdP4Mz3zqm5uOMP34fTf/QdbJw+TQW3AjkoY+38FSwfXsF7PvI+bO50MJ5MzWHrrfOKHspmeZnJMKkwi2mZEFrFzNwyqjMLqGQrTLwFer2j5LskMMFjzdJUt3vUa6O1uQ2TBsvkM2r0TMGKrt2MWhrddZC2JwMyI9WOixEQAtWpNl4wgZEw+ofB2I9kT470GUUw6ZiSYInVTmG1KVtV8cbE5LE1B18vPR1pxd9L7Ko6r8MijskcRKu+i8EwUn05MarsN1G7TI8dRrZcxusvnYWMUh06eQinX3wV62cuqSLRkCJlb20LH/7UQ6gQJxN6p8HQHlPwbL11jhJeqJRDrxoo78eYvhoSI8ku1M2GhjpJSk4zkB23uFnX7u5toVurU0maKBKuDNV5Z1LN5ya1b2XsGC6fdwkbtjE56UZ22MrOLDmZRkqrYRj9XhjFT4eRr4Z8BOflxCPbmZKhNTmLix8ox0WMjSyi9CJXM0fPcUid8j/nR1onktJjv4mYr7HJEkZjOfPCw4DeXJ4r8uLpF8EQBx84ig558tXTlzG/b5mqcBnnXn0TrZ06itUidm5sIptL46GHV3Dt6obi74mc1dTskqGcU9P7RspRx/TI/F8UjOANupTlHX5en3geIWXaKqwVX9/d4aMBM1VAplhArlRUjWCbLMYhj5ayqQxmygLJVgtpyBepUkXxyYRsmjAT0nvpMB1G9c9pN5vpcvCWHCIgWzdiP56OoYOb3ehQNtbINriwxZ9TDMtZKqXsppUMf9bRPVx77XmGuGyZcClOehQEhBQqsQHpXWN7j0moTu+JyI334bXnX1F4XSV276MivPIqjSg7t3gjezd2ceyho+TdjhrdlS3EJgWDjHF2+R4hjRtTXIgBksnsi+pcy3FLwomGhJlOp4EmJbUU6LP5IjLEYmEJwoflyIqUOrGG0UKvzdFobi6t+rU2DZ91UwpKZFu1KVW/WIaChj9Lr99Un0FIKVTzqm6TGLFa9CkdjBKpbcbSTRmN/cn4q5RNyfqTeAQjaH6xce6132hdfE3VD9RDYIYJxi1kVJ1k0Kfiao9UCBdmcuoAk5eefV5V9BIrjVkavLFVU/N3189cRrmUwQwl/Gg8GTuQuk1hboFUr6Iqcd1OE51GTe0x7HbafLTQqVG4NPbQEu+WJi3ziqMOp8oo2ezQ0HIYi8CFMjYXr0YmlKWhsyVClQiU/KQB7ajKoadUX+jHvxEG4y8KDKaZlJOEKpnCqzpfncwMGtp0DO0N24qkk8zAkzIoIcNxpRMs05lD7HUS7F698Au2a7408GK1EVI8x6FokPFXjR4gXNXiDTS2m+TkJhb3rxJKNJynZ0vJtb7XUZNI0m2XgXYBv9nlGXSJxXIEkHSfnax8pyfNzPF9bXR2bhAWrmM0aioPj+2EdIs0sFBG2s2prR6yBUNGGSxhFzLRIzvuZR86E7tbJsTJsURUd7lihqwjPRlWl3Lqzb0uJPwveYP+L+hq3wsZidSnGVnNBvl0pKlh+357SvROsrBHASDzZpaZnyg1Ur4RsTGsX0W4fZ7sou23651PRWFwWgry4k0pOdCPiWIgVUxGRYoYKDutRvQiUwZamJBuEIfPvfkWcoSZLimdKE+pM0jjszpbVBuBpJCfKZXhpsUYXMR0GvlyRU1IicFdGjVDYZQpEiIKE+Yhx8DJCWQ2jSylTSm5quKQHITFhGpowp/J+2craHYGZCKuFBwVDIiHCiRVy+5peuxn47Hvy3TppFsTq6jLVGdx4fWzajzNH09JgqfLR1A+8BFkZ49RAR5TFx92majIlX3Z5OOBgmOLomGzE4yGn9WT5IaVcVRCksQURwxhx1Tn2QnmBSJjyUMdtefEwo0rm6pdZJF69Zm4hGIJVJWIm9Uck5GMmYlsZ3TIaySZufTyTJG82U5P9rOo/Sm6mhiV0rM6lUYd7SMu66uypklPTLlZ1cpq7tTVsM/+w8ukcqEa3Q1MKWuHaj7aTDk3CvNznzV1vRnK1mphH9Kh8SebNQrVEpnVSHXQC7Pz0zH03MFH1VkXsytHuPKzqmAuN+RRWTWaEZq7m7xAEnyusmbam6Ne5wP5Qva0lCN9X/ERlPIZVaSRc45yzP5SGnXLOSYeC/cdmMeo0URRyqpMMI4M0pjWZP8430NaYuN+V+UF4bJqBo+Gl/0vpsyV8Gd1rocMlJu6Oh9PvFmAXU2nYnKQitBPyXgek+XOxg4aG00cPH5I9o2oHRezC3Nqx0HKiE+XSpkPlBbnNqVJqwphcnChTD3xYZGxVMsFzK4uYmerhnezo/OuhhYPkt6ZcXO6xzV5sRvn0dvcQtjboAStoT+I1JybFNZ7vf6mpiUf0+PkhcFATjXwKEpmeLER0jIfQS4dDYfQifcL+xdQzjPUZbCRdCq7UALUPkUL/b6HlJxpROMMGrvkzn019yFDsiJGBC9lgEdYh6g7tdHoJiTpasIKalZEDrOS3V4y19fv1BgtXDh65iVSTDl31SGfbteaqhNOf/6ubekfKxUym0Im2vW2OnxQtIDaZCRDmdJcZjqpyKGDXHR/NJwS64iiySQgXWrUXkf9wqto1GoMrxF2Lp3Bd776dcLGGrxWHZ29loIK2zSaTCKfun5+498VmWjkTLlOrYG5w6s3j1qjpxP7KyszZBP5ydlxVHEMWTXtRAdSfLsgkSDFJ69PerijivcCAWB0yEYdhb/05FhNjkLN2k0mR6X1NhEimnqOGjOQHbstCqChes3G2jY2L1zGgSNL6jnXtX/DTtmfsKxUs0RO328PsX5tS50sNvYitZ9RMZd8SQ04Sr9R9rx408Jok0byO3tYv3Aab3zreQRGHvOr+3H2he/gG09/E26eySk98UBZELkAIwqwcWNvxIv/OSadn2w3e/0xadfsgUV0d+ukb2QRuQm2lmbmldfJbijZNJStVsmDPXXqouu66mZkr5XMSY/9rjKoms5PGZOz87g43z/9UabQVYNCTfozkfsjNWATG5ryZN8fTJqzxGwZqLz08hmiTdQvzM39pNdp/2yxlB3J4LskUymhqo1QcmCAnHTg2urYIZmoTcjB5ehmYSu1zZ3pGLp17Rx2T30DQfMKlu47SSbg4uu/+Zv4wq//BkWAheV5ChMzTUpFg2dttTVOcFUn3u1bKWFjt/Nl8uX7M7Ol3xFlJYefzO+rkoZlKYMLSlbnFhcUi4iI+7nlVdSu1iZHDMvZpuKxkaEK9zL2mxDndRUVhkqGMnIg/UiR0sLe1CB/kkzqGVJcwsTTR5T4QxpOzgqR7SLSfI2j+He23rpyv+FYX67tNEkdC+poOLWplH/vMmf4BPphd0SB5txMiCN1CJc0h2fmK9DexUGwpnYXQK/vbDAzR+hcpjfrr2JUOIDzDKmjDz+C/XM51LbbaPeG+MUvv3i3rLDOx0/88b/8mSdy+fS/iqLgWHV5hcKFIdraw9z+FXQ2N1Davx+bl1vob20TVmbVULvsYbFoUKktSHfcH48ITTlV7BKMFFEhcCQdbJlxlkaQ4HoiY2D8t2yZi8MhPXqgFiueuNZlx3X+/ue+9OLT/3t45d19nf2P/0DhlZN2oN1jQrxrVaQ3JI8OGUp6Dp12B8PNl9TJMPtyFBrXt7BWa6vNmvfy9fgv/ge5sae/+o9/7KeqM9V/tL22eTJTyaFHw7rlKlViEZdf+SN1npxqkMpkVDo12YcdBOrM0FDOakqnFfuQ4Ri11zuxVGFeDC8GVjgdquMMQBqj9hGOx6qWfNqP4n/x97722n+/i4HvaVBDdhU4QiGte98spP1f/P5entPe4f20b/yTv/TZ1fuO/DXLcX+osLLffuELX0HtwiXM7ZtTfFqnGq2urKqFDWVKidRw/tB9cKvzkwMGpUutBhcTtTleCklSzBL8iL0Rho0t2drmj/z+V7a31//rB//Zf3nmLsZM7sHQyTssSHK3v9PehQG1u3y/0+ve8W/+6c/8WH5pOPhhfdj9dDmb+WCl6laDXoTy0iqymRJxmeKIQsei984fPU7htKAmXCM5WSBlqHNJA+G7UawOq40jv97vNL+zffXi177wvTNf+dU/+Fb3DsZ8+/fkLgZPbnkN7vHftzX0Oxn07UbTb/P825/T3/a6W/9Ou83jT7zXL33ywSMPLi79wMq+1f1u2l2xjdSKT4qnDUYPLBw8hMr+I0pljjz/HBVePAqx3h2PN1rt3vUXT5165e/+2q9fuouRkjsYNr7ld9N4/ImF097BsLca8+0/6/f4853+7k7v9XZGpN/FAe4ltONbbvzt/77VuPHbHskt3+/l59t9/18P8x2MfKuxjLc9b9zy+1v/fevzt/6tdpvX3u6zcQfvxz2E8tuNgTsY6tZHdPP30V1+/07Pabca3LwLtt7OyLca0LiNMW/33O2+67cY3bjF2MZdIAbvkNCSu3hYdBcjh3cwYPS2n/Vbnr/TtcVv+3fyLmbW3xVbmcZX8qf4TO0dFuXP+vPvyqOTt7k83uYJ38fL+BaPMd72PX7b9+8XSMI7wIlxByi6HZ5r78BicA+JL76Lh0e3+fndwsTtnvs/EuO7SYbvlPhuDfd3SoZ3MurtmAzuAaPvRt1uZ3DcIen9mSTDd6J3t/tZvw2W3+73d6J3+j28p/YOXP5ew/1OXDm+ze+nRfFwm+j/8xcs9wgL2hQwdtqC5U7vcVfB8v9cgv8p3mNaBv9zk+B/mi9tyq+dNqtJ/pxeN/Ub+n9B9/5/+nrXhv6fAgwAxGegQfIdpe4AAAAASUVORK5CYII=">
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