@extends('app')

@section('css')

@endsection


@section('content')
<section class="positive">
        <div class="container">
            <div class="row">
			
				<!-- product heading -->
                <div class="col-md-12">
					<p>&nbsp;</p>
                    <span class="next">Home &nbsp;<img src="{{ asset('home_asset/fonts/Shape1.png')}}"/>&nbsp; 
                    @if(isset($catname))
                    {{ $catname }}
					@endif
                    </span>
                    <div class="description">

                        <h1 class="prod pro-title">{{ $name }}</h1>
                    
                    </div>
					<div class="gap20"></div>
                </div>    
				
				<!-- Catrgory list -->
				<div class="col-md-12 col-xs-12 over-hide">
					<div class="row">
                   
                    <div class="col-sm-12">
                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                     
                                              <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div><h3 class="label-tag">50% OFF</h3>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div>

</a></div>
								<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>
                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <ul>
                                                <li>
													<span class="price new">$25</span>
                                                </li>
                                            </ul>
                                        </div>
									</div>
                                    </div>
                                </div>
                               <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                       <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-12">

                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div>
<h3 class="social-ads">Facebook Ads</h3>
                     <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                               <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-12">

                        <div class="masonry noo-blog home-masonry">
                            <div class="row masonry-container" style="position: relative;">
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                         <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div><h3 class="social-ads">Facebook Ads</h3>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                               <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div><h3 class="social-ads">Facebook Ads</h3>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                                <div class="masonry-item col-md-4 col-sm-6" style="position: relative; left: 0px; top: 0px;">
                                    <div class="blog-item">
                                          <div class="ih-item square effect13 left_to_right"><a href="#">
                      <div class="img"><img src="assets/rect/1.jpg" alt="img"></div><h3 class="social-ads">Facebook Ads</h3>
                      <div class="info">
					  <div class="col-md-6 col-xs-6"><span class="off1">View</span></div>
                        <div class="col-md-6 col-xs-6"><span class="off2">Add to Cart</span></div>
                      </div></a></div>
										<div class="blog-description row">
                                        <div class="col-md-8 col-xs-8">
                                            <ul class="details">
                                                <li>

                                                    <span>Delish Pro</span>
                                                    <span><a>By <strong>Egor </strong> in <strong> Facebook</strong></a></span>
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
                            </div>
                        </div>
                    </div>
					
					</div>
					<div class="gap40"></div>
					
					<nav class="text-center">
					  <ul class="pagination">
						<li><a href="#" aria-label="Previous"><span aria-hidden="true"><img src="fonts/Shape3.png"/></span></a></li>
						<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
						  <a href="#" aria-label="Next">
							<span aria-hidden="true"><img src="fonts/Shape1.png"/></span>
						  </a>
						</li>
					  </ul>
					</nav>
					
					<div class="gap60"></div>
                </div>
				
				<div class="clearfix"></div>
            </div>
        </div>
		<!-- Ads Bannner -->
		<div class="container">
			<div class="ads-banner"> </div>
		</div>
		<div class="gap60"></div>
    </section>

@endsection

@section('script')

@endsection