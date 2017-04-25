@extends('app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick.less') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick-theme.less') }}"/>
<link id="style-main-color" rel="stylesheet" href="{{ asset('home_asset/css/colors/default.css') }}">
@endsection

@section('content')
<section class="positive">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<p>&nbsp;</p>
                    <span class="next">Home &nbsp;<img src="{{ asset('home_asset/fonts/Shape1.png')}}"/>&nbsp; {{ \App\Category::get_cat(explode(",", $product->prod_categories)[0]) }}</span>
                    <div class="description">
                        <h1 class="prod pro-title">{{ $product->prod_name }}</h1>
						<p class="des pro-des">By <strong><a href="{{ URL::to(vendor) }}/{{ \App\Users::get_slug($product->prod_vendor_id) }}/{{ $product->prod_vendor_id }}">{{ \App\Users::username($product->prod_vendor_id) }} </a></strong> in <strong> {{ \App\Category::get_cat(explode(",", $prod->prod_categories)[0]) }}</strong></p>
                    </div>
                </div>    
					<div class="col-md-8 col-xs-12 over-hide">

                        <div class="row">
                            <div class="col-md-12">
							
								<div class="product-slider" id="productSlider">
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}"></div>
								  @if($product->prod_image1!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image1) }}" alt="{{ $product->prod_image_alt1 }}"></div>
								  @endif
								  @if($product->prod_image2!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image2) }}" alt="{{ $product->prod_image_alt2 }}"></div>
								  @endif
								  @if($product->prod_image3!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image3) }}" alt="{{ $product->prod_image_alt3 }}"></div>
								  @endif
								  @if($product->prod_image4!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image4) }}" alt="{{ $product->prod_image_alt4 }}"></div>
								  @endif
								</div>
								
								<div class="product-slider-nav images-description" id="productSliderNav">

								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image) }}" class="image-description img-responsive"  alt="{{ $product->prod_image_alt }}" /></div>
								  @if($product->prod_image1!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image1) }}" class="image-description img-responsive"  alt="{{ $product->prod_image_alt1 }}" /></div>
								  @endif
								  @if($product->prod_image2!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image2) }}" class="image-description img-responsive"  alt="{{ $product->prod_image_alt2 }}" /></div>
								  @endif
								  @if($product->prod_image3!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image3) }}" class="image-description img-responsive"  alt="{{ $product->prod_image_alt3 }}" /></div>
								  @endif
								  @if($product->prod_image4!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image4) }}" class="image-description img-responsive"  alt="{{ $product->prod_image_alt4 }}" /></div>
								  @endif
								</div>
                            </div>
                        </div>
						<div class="gap20"></div>
                        <hr class="Descripti" />

                        <div class="desc">
                            <div class="col-md-12">
                               
								<div class="row">
                                    <a class="Descr">Description</a>
                                    <div class="describe ">
										
										
                               			{!! $product->prod_descrption !!}
										
										</div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
							
                            <div class="support1">
                                <div class="col-md-12">
						<div class="gap40"></div>
                                    <a class="support">Support</a>
                                    <div class="supp">

                                        <h6>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
			                      The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, 
			                          content here', making it look like readable English. 
			            </h6>
                                        <hr class="descriptio" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="partners">
                                    <ul class="seens p-none">
                                        <li class="seen1">
                                            <span>Share: </span>
                                        </li>

                                        <li class="facebook">
                                            <button type="button" class="socials">Facebook</button>
                                        </li>

                                        <li>
                                            <button type="button" class="socials1">Tweet</button>
                                        </li>
                                        <li>
                                            <button type="button" class="socials2">Pin It</button>
                                        </li>
                                        <li>
                                            <button type="button" class="socials3">G+Share</button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
						<div class="clearfix"></div>

                    </div>

                    <div class="col-md-4 col-xs-12 product-details">
                        <div class="boxes">
                            <ul class="product-price">
                                <li>
                                    <a class="pricing">${{ $product->prod_price }}</a>
                                </li>
                                <li>
                                    <a class="template-only"> Template only</a> </li>
                            </ul>
                            <div class="recomended-services">
                                <a class="recomended"> Recommended Services</a>
                                <form class="checkbox1">
                                     
                                     <div class="col-md-8 col-xs-8 text-left">
										<input type="checkbox" id="checkbox1" class="css-checkbox med"/>
										<label for="checkbox1" name="checkbox1_lbl" class="css-label med elegant">{{ \App\Customizations::cust_name($cat) }}</label>
									 </div> 

									 <div class="col-md-4 col-xs-4 text-right">4$ 
									 	<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Add to cart"></i>
									 </div>
									 
                                    
                                     <div class="col-md-8 col-xs-8 text-left">
										<input type="checkbox" id="checkbox2" class="css-checkbox med"/>
										<label for="checkbox2" name="checkbox2_lbl" class="css-label med elegant">Add copy writing</label>
										
									 </div> <div class="col-md-4 col-xs-4 text-right">10$ <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Add to cart"></i></div>
								</form>
                                
                            </div>
                            <p class="subtotal-price"> Subtotal Price: 59$</p>
                            <div class="see-more">
                                <a href="#" type="submit" class="btn btn-primary see1">Buy Now</a>
                            </div>
                            <div class="see-more">
                                <a href="#" type="submit" class="see2">Add To Cart</a>
                            </div>
 
							<div class="see-more">
							<p class="m-none">&nbsp;</p>
                                <a class="domain text-center">Single domain License ( you can use this on<br> personal commercial or client projects)</a> </div>
                            <ul class="col-md-12 payment text-center">
                               
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/paypal.png')}}" alt="paypal">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/003-visa.png')}}" alt="visa">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/mastercard.png')}}" alt="mastercard">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/american-express.png')}}" alt="american-express">
                                </li>
                            </ul>
							<div class="clearfix"></div>
                            <hr class="detailing1" />
                            <div class="col-md-12 clearfix">
                                <div class="row">
                                    <div class="user-data">
                                        <div class="col-md-4 text-right">
                                            <img class="image-description2 " src="images/3.png" alt="">
                                        </div>
                                    </div>
                                    @foreach(\App\Users::where('id',$product->vendor_id)->get() as $user)
                                    <div class="user-details">
                                        <div class="col-md-8 text-left p-none">
                                            <ul>
                                                <li class="name">
                                                    <a class="user-name">{{ \App\Users::username($user->id) }}</a>
                                                </li>
                                                <li class="loco">
                                                    <a class="user-location">{{ isset($user->user_country):$user->user_country: null }}</a>
                                                    <br/>
                                                    <a href="{{ URL::to(vendor) }}/{{ \App\Users::get_slug($product->prod_vendor_id) }}/{{ $product->prod_vendor_id }}" class="user-store">View Store</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="col-md-12">
                                    <a class="domain1">More From Julia Team</a>
                                </div>
                                <ul class="payment img p-none">
                                    @foreach(\App\Products::where('prod_vendor_id',$product->prod_vendor_id)->take(4)->get() as $product)
                                    <li>
                                        <img class="image-description1" src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
                                    </li>
                                    @endforeach
                         


                                <div class="row">

                                                                    </ul>
<hr class="detailing" />
                                    <div class="detals">
										<ul class="col-md-12 payment">
											<li class="detals"><strong>Created&nbsp;: </strong> {{ $product->created_at }}</li>
											<li class="detals"><strong>Updated&nbsp;: </strong> {{ $product->updated_at }}</li>
										
										
											<li class="detals"><strong>File Included&nbsp;: </strong> {{ $product->prod_files_included}}</li>
											<li class="detals"><strong>Categories&nbsp;: </strong> 
											@foreach(explode(',',$product->prod_categories) as $cat)
											{{ \App\Category::cat_name($cat) }},
											@endforeach
											</li>
											<li class="detals"><strong>Tags:&nbsp;: </strong> </li>
											
										</ul>
										
										
                                        <br/>
                                        <ul class="tags1">
                                        	@foreach(explode(',',$product->prod_tags) as $tags)
                                            <li class="bootastrap">
                                                <button type="button" class="tags">{{ $tags }}</button>
                                            </li>
											@endforeach
                                        </ul>

                                    </div>
                                </div>
								<div class="clearfix"></div>
							</div>
                            <div class="clearfix"></div>
							<p class="p-none">&nbsp;</p>
							<div class="ads-banner ads-banner-300-250"></div>
                        </div>
                        
                    </div>

					<div class="image-section">
						<div class="container">
							<div class="row">
							<div class="col-md-12">
                            
                                <div class="row">
									 <div class="categories">
										<ul class="p-none">
											<li class="section-head browse1">Related Products
											</li>
										</ul>
									</div>
                                </div>
                      
                                <div class="row">
								 <div class="pt-12 pb-8">
                                    
                                        <div class="col-sm-">
                                            <div class="masonry noo-blog1">
                                                <div class="masonry noo-blog home-masonry">
                                                    <div class="row masonry-container" style="position: relative;">
                                                        @foreach(\App\Products::where('prod_categories', 'LIKE', '%'.explode(",", $product->prod_categories)[0].'%')->take(3)->get() as $product)
                                                        <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                                            <div class="blog-item">
                                                                <a class="blog-thumbnail" href="{{ URL::to(product) }}/{{ $product->prod_slugc}}/{{ $product->id }}">
                                                                    <img width="400" height="440" src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt="{{ $product->prod_image_alt }}">
																	
                                                                </a>
                                                                <div class="blog-description row">
                                                                    <div class="col-md-8 col-xs-8">
                                                                        <ul class="details">
                                                                            <li>

                                                                                <span>{{ $product->prod_name }}</span>
                                                                                
                                                                                <span><a href="{{ URL::to(vendor) }}/{{ \App\Users::get_slug($product->prod_vendor_id) }}/{{ $product->prod_vendor_id }}">By <strong>{{ \App\Users::username($product->prod_vendor_id) }} </strong></a></span>
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
                                                        @endforeach
                                                        <div class="col-md-3 col-sm-6">
															<div class="blog-item custom-contact">
																<img src="{{ asset('home_asset/fonts/design-tool.png')}}"/>
																<p>Contact me now for a custom project based on your brief.</p>
																<div class="see-more">
																	@if(Session::get('login')==true)
																	<a href="{{ URL::to('custom-order') }}" class="btn btn-primary see1">Contact</a>
																	@else

																	<a href="#RegisterModal" class="btn btn-primary see1">Contact</a>
																	@endif
																</div>
															</div>
														</div>
                                                    </div>
													<div class="gap60"></div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
								</div>
                            </div>
							</div>
                        </div>
					</div>
            </div>
        </div>
    </section>
@endsection

@section('script')
		<script>
	$( document ).ready(function() {
		// Configure/customize these variables.
    if($(window).width() < 767)
	{	
		var showChar = 400;  // How many characters are shown by default
		var ellipsestext = "...";
		var moretext = "Show more description &nbsp;<i class='fa fa-angle-down'></i>";
		var lesstext = "Show less";
		

		$('.more').each(function() {
			var content = $(this).html();
	 
			if(content.length > showChar) {
	 
				var c = content.substr(0, showChar);
				var h = content.substr(showChar, content.length - showChar);
	 
				var html = c + '<span class="moreellipses">' + ellipsestext+ '</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
	 
				$(this).html(html);
			}
	 
		});
	 
		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});
		}
		else {
			   return false;
			}
	
	});

</script>
@endsection