@extends('app')

@section('content')
<section class="positive">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<p>&nbsp;</p>
                    <span class="next">Logo Design & Branding<i class="fa fa-angle-double-right fa-small"></i> Logo Design</span>

                    <div class="description">
                        <h1 class="prod pro-title">{{ $product->prod_name }}</h1>
						<p class="des pro-des">By <strong><a>{{ \App\Users::username($product->prod_vendor_id) }} </a></strong> in <strong> Facebook</strong></p>
						
                    </div>
                </div>    
					<div class="col-md-8 col-xs-12 over-hide">

                        <div class="row">
                            <div class="col-md-12">
							
								<div class="product-slider" id="productSlider">
								@if($product->prod_image!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image) }}" alt=""></div>
								@endif
								@if($product->prod_image1!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image1) }}" alt=""></div>
								@endif
								@if($product->prod_image2!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image2) }}" alt=""></div>
								@endif
								@if($product->prod_image3!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image3) }}" alt=""></div>
								@endif
								@if($product->prod_image4!=NULL)
								  <div><img class="image-pic" src="{{ \App\Products::getFileUrl($product->prod_image4) }}" alt=""></div>
								</div>
								@endif

								
								<div class="product-slider-nav images-description" id="productSliderNav">
								@if($product->prod_image!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image) }}" class="image-description img-responsive"  alt="" /></div>
								@endif
								@if($product->prod_image1!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image1) }}" class="image-description img-responsive"  alt="" /></div>
								@endif
								@if($product->prod_image2!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image2) }}" class="image-description img-responsive"  alt="" /></div>
								@endif
								@if($product->prod_image3!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image3) }}" class="image-description img-responsive"  alt="" /></div>
								@endif
								@if($product->prod_image4!=NULL)
								  <div><img src="{{ \App\Products::getFileUrl($product->prod_image4) }}" class="image-description img-responsive"  alt="" /></div>
								</div>
								@endif
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
                                    <a class="pricing">$49</a>
                                </li>
                                <li>
                                    <a class="template-only"> Template only</a> </li>
                            </ul>
                            <div class="recomended-services">
                                <a class="recomended"> Recommended Services</a>
                                <form class="checkbox1">
                                     <div class="col-md-8 col-xs-8 text-left">
										<input type="checkbox" id="checkbox1" class="css-checkbox med"/>
										<label for="checkbox1" name="checkbox1_lbl" class="css-label med elegant">Customization</label>
									 </div> <div class="col-md-4 col-xs-4 text-right">4$ <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Add to cart"></i></div>
                                    
                                     <div class="col-md-8 col-xs-8 text-left">
										<input type="checkbox" id="checkbox2" class="css-checkbox med"/>
										<label for="checkbox2" name="checkbox2_lbl" class="css-label med elegant">Add copy writing</label>
										
									 </div> <div class="col-md-4 col-xs-4 text-right">10$ <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Add to cart"></i></div>
                                </form>
                            </div>
                            <p class="subtotal-price"> Subtotal Price: 59$</p>
                            <div class="see-more">
                                <button type="submit" class="btn btn-primary see1">Buy Now</button>
                            </div>
                            <div class="see-more">
                                <button type="submit" class="see2">Add To Cart</button>
                            </div>
							<div class="see-more">
							<p class="m-none">&nbsp;</p>
                                <a class="domain text-center">Single domain License ( you can use this on<br> personal commercial or client projects)</a> </div>
                            <ul class="col-md-12 payment text-center">
                               
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/paypal.png')}}" alt="">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/003-visa.png')}}" alt="">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/mastercard.png')}}" alt="">
                                </li>
                                <li>
                                    <img class="image-description1 " src="{{ asset('home_asset/img/american-express.png')}}" alt="">
                                </li>
                            </ul>
							<div class="clearfix"></div>
                            <hr class="detailing1" />
                            <div class="col-md-12 clearfix">
                                <div class="row">
                                    <div class="user-data">
                                        <div class="col-md-4 text-right">
                                            <img class="image-description2 " src="{{ asset('home_asset/images/3.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="user-details">
                                        <div class="col-md-8 text-left p-none">
                                            <ul>
                                                <li class="name">
                                                    <a class="user-name">Julia Dreams</a>
                                                </li>
                                                <li class="loco">
                                                    <a class="user-location">USA</a>
                                                    <br/>
                                                    <a href="#" class="user-store">view Store</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <a class="domain1">More From Julia Team</a>
                                </div>
                                <ul class="payment img p-none">
                                    <li>
                                        <img class="image-description1" src="{{ asset('home_asset/images/3.png')}}" alt="">
                                    </li>
                                    <li>
                                        <img class="image-description1 " src="{{ asset('home_asset/images/3.png')}}" alt="">
                                    </li>
                                    <li>
                                        <img class="image-description1 " src="{{ asset('home_asset/images/3.png')}}" alt="">
                                    </li>
                                    <li>
                                        <img class="image-description1 " src="{{ asset('home_asset/images/3.png')}}" alt="">
                                    </li>
                                   


                                <div class="row">

                                                                    </ul>
<hr class="detailing" />
                                    <div class="detals">
										<ul class="col-md-12 payment">
											<li class="detals"><strong>Created&nbsp;: </strong> September 15,2015</li>
											<li class="detals"><strong>Updated&nbsp;: </strong> March 13,2017</li>
											<li class="detals"><strong>Version&nbsp;: </strong> 4.5</li>
											<li class="detals"><strong>Updated&nbsp;: </strong> March 13,2017</li>
											<li class="detals"><strong>Dependencies&nbsp;: </strong> WordPress4.+</li>
											<li class="detals"><strong>File Included&nbsp;: </strong> HTMl,Images,PHP</li>
											<li class="detals"><strong>Categories&nbsp;: </strong> Blog,Buisness,Portfolio,Fashion </li>
											<li class="detals"><strong>Tags:&nbsp;: </strong> September 15,2015</li>
											
										</ul>
										
										
                                        <br/>
                                        <ul class="tags1">
                                            <li class="bootastrap">
                                                <button type="button" class="tags">responsive</button>
                                            </li>

                                            <li>
                                                <button type="button" class="tags">Blog</button>
                                            </li>
                                            <li>
                                                <button type="button" class="tags">Minimal</button>
                                            </li>
                                            <li>
                                                <button type="button" class="tags">Personal</button>
                                            </li>
                                            <li>
                                                <button type="button" class="tags">Blogging</button>
                                            </li>
                                            <li>
                                                <button type="button" class="tags">Bootstrap</button>
                                            </li>
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
                                                        <div class="masonry-item col-md-3 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                                            <div class="blog-item">
                                                                <a class="blog-thumbnail" href="blog-detail.html">
                                                                    <img width="400" height="440" src="{{ asset('home_asset/images/3.png')}}" alt="">
																	
                                                                </a>
                                                                <div class="blog-description row">
                                                                    <div class="col-md-8 col-xs-8">
                                                                        <ul class="details">
                                                                            <li>

                                                                                <span>Delish Pro</span>
                                                                                
                                                                                <span><a>By <strong>Egor Federov</strong></a></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-4 col-xs-4">
                                                                        <ul>
                                                                            <li>
																				<span class="price">$25</span>
                                                                            </li>
                                                                        </ul>
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
                                                                    <div class="col-md-8 col-xs-8">
                                                                        <ul class="details">
                                                                            <li>

                                                                                <span>Delish Pro</span>
                                                                                
                                                                                <span><a>By <strong>Egor Federov</strong></a></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-4 col-xs-4">
                                                                        <ul>
                                                                            <li>


                                                                                <span class="price">45$</span>
                                                                            </li>
                                                                        </ul>
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
                                                                    <div class="col-md-8 col-xs-8">
                                                                        <ul class="details">
                                                                            <li>

                                                                                <span>Delish Pro</span>
                                                                                
                                                                                <span><a>By <strong>Egor Federov</strong></a></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-4 col-xs-4">
                                                                        <ul>
                                                                            <li>


                                                                                <span class="price">45$</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														
														<div class="col-md-3 col-sm-6">
															<div class="blog-item custom-contact">
																<img src="{{ asset('home_asset/fonts/design-tool.png')}}"/>
																<p>Contact me now for a custom project based on your brief.</p>
																<div class="see-more">
																	<button type="submit" class="btn btn-primary see1">Contact</button>
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