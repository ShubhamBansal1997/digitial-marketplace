	<!-- SECTION [Header] -->
    <header class="noo-header header-2">
        <div class="navbar-wrapper">
                <div class="navbar navbar-default">

                    <div class="container">
                        <div class="menu-position">
                            <div class="navbar-header pull-left">
                                <div class="mobile-menu-handler pull-right primary noo_menu_canvas">
                                    <div data-target=".nav-collapse" class="btn-navbar">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                                <a href="{{ URL::to('/') }}" class="navbar-brand">
                                    <img class="noo-logo-img noo-logo-normal" src="{{ asset('home_asset/images/logo.png')}}" alt="DesignMinister">
                                </a>
                            </div>
							
							<!-- SIDE Menu For mobile devices-->
							<div id="mobile-menu" class="side-menu right closed">
								<span class="svg-plus"><img src="{{ asset('home_asset/img/cross.png')}}"/></span>
								<!-- SIDE MENU HEADER -->
								<div class="side-menu-header">
									<figure class="logo small">
										<div class="account-actions no-space">
											<a href="#RegisterModal" class="btn btn-primary button black ">Register</a>
											<a href="#LoginModal" class="button white">Login</a>
										</div>
									</figure>
									
								</div>
								<!-- /SIDE MENU HEADER -->

								<!-- SIDE MENU TITLE -->
								<p class="side-menu-title">Main Links</p>
								<!-- /SIDE MENU TITLE -->
							 
								<ul class="dropdown interactive">
									
									<li class="dropdown-item"><a href="">Products</a></li>
									<li class="dropdown-item"><a href="">Services</a></li>
									<li class="dropdown-item"><a href="">Online Goods</a></li>
									<li class="dropdown-item"><a href="">Products</a></li>
									<li class="dropdown-item"><a href="">Services</a></li>
								</ul>
							</div>
							<!-- /SIDE MENU --> 
							
							
							<!-- Desktop Menu -->
                            <div class="main-menu-wrap">
								<div class="menu-bar">
			<nav class="pull-right noo-main-menu">
				<ul class="main-menu">
				    
					<li class="menu-item sub">
						<a href="#">
							Products &nbsp;
							<span><img src="{{ asset('home_asset/fonts/Shape2.png')}}"></span>
						</a>
						<div class="content-dropdown">
							<!-- FEATURE LIST BLOCK -->
							<div class="feature-list-block">
								<h6 class="feature-list-title">Social Ad Templates</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list spaced">
									<!-- FEATURE LIST ITEM -->
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Facebook">Facebook</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Google">Google</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Instagram">Instagram</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Youtube">Youtube</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Pinterest">Pinterest</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Twitter">Twitter</a></li>
									<!-- /FEATURE LIST ITEM -->
								</ul>
								<!-- /FEATURE LIST -->
								<div class="clearfix"></div>

								<h6 class="feature-list-title">Digital Marketing</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list">
								    <!-- /FEATURE LIST ITEM -->
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/SEO-Services-Ads">SEO Services Ads</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/PPC-Services-Ads">PPC Services Ads</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Agency-Banners">Agency Banners</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Web-Design-Ads">Web Design Ads</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Google-Store-Banners">Google Store Banners</a></li>
									<!-- /FEATURE LIST ITEM -->
								</ul>
								<!-- /FEATURE LIST -->
							</div>
							<!-- /FEATURE LIST BLOCK -->

							<!-- FEATURE LIST BLOCK -->
							<div class="feature-list-block">
								<h6 class="feature-list-title">Ecommerce</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list ">
									<!-- FEATURE LIST ITEM -->
							        <li class="feature-list-item"><a href="{{ URL::to('product') }}/Fashion-Templates">Fashion Templates</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Electronics">Electronics</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Jewellery">Jewellery</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Real-Estate-Banners">Real Estate Banners</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Sale-Banners">Sale Banners</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Web-Banners">Web Banners</a></li>
								</ul>
								<!-- /FEATURE LIST -->
								
								<div class="clearfix"></div>

								<h6 class="feature-list-title">Blogging</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list">
												<!-- FEATURE LIST -->
								<ul class="feature-list">
									<!-- FEATURE LIST ITEM -->
							        <li class="feature-list-item"><a href="{{ URL::to('product') }}/Bloggers-Kit">Blogger's Kit</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Article-Posts">Article Posts</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Ebook-Covers">Ebook Covers</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Quotes-Banners">Quotes Banners</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Influencer-Banners">Influencer Banners</a></li>
								</ul>
								<!-- /FEATURE LIST -->
								</ul>
								<!-- /FEATURE LIST -->
							</div>
							<!-- /FEATURE LIST BLOCK -->

							<!-- FEATURE LIST BLOCK -->
							<div class="feature-list-block">
								<h6 class="feature-list-title">Others</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list">
									<!-- FEATURE LIST -->
								<ul class="feature-list ">
									<!-- FEATURE LIST ITEM -->
							        <li class="feature-list-item"><a href="{{ URL::to('product') }}/Multi-Purpose-Banners">Multi-Purpose Banners</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Google Play Store">Google Play Store</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Event-Kits">Event Kits</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Email-Newsletters">Email Newsletters</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Presentations">Presentations</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Mockups">Mockups</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Flyers">Flyers</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Resumes">Resumes</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Business-Cards">Business Cards</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('product') }}/Stationery">Stationery</a></li>
                                    <li class="feature-list-item"><a href="{{ URL::to('product') }}/Sales-Sheet">Sales Sheet</a></li>
								
								</ul>
							</ul></div>
						</div>
					</li>
					<li class="menu-item sub">
						<a href="#">
							Services &nbsp;
							<span><img src="{{ asset('home_asset/fonts/Shape2.png')}}"></span>
						</a>
						<div class="content-dropdown">
							<!-- FEATURE LIST BLOCK -->
							<div class="feature-list-block">
								<h6 class="feature-list-title">Logo Design &amp; Branding</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list spaced">
									<!-- FEATURE LIST ITEM -->
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Logo-Design">Logo Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Logo-Customization">Logo Customization</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Brand-Identity-Design">Brand Identity Design</a></li>
									<!-- /FEATURE LIST ITEM -->
								</ul>
								<!-- /FEATURE LIST -->
								<div class="clearfix"></div>

								<h6 class="feature-list-title">Website Design &amp; Dev.</h6>
								<hr class="line-separator">

								<!-- FEATURE LIST -->
								<ul class="feature-list">
								    <!-- /FEATURE LIST ITEM -->
						        <li class="feature-list-item"><a href="{{ URL::to('service') }}/Website-Design">Website Design</a></li>
								<li class="feature-list-item"><a href="{{ URL::to('service') }}/Landing-Page-Design">Landing Page Design</a></li>
							    <li class="feature-list-item"><a href="{{ URL::to('service') }}/PSD-to-HTML">PSD to HTML</a></li>
								<li class="feature-list-item"><a href="{{ URL::to('service') }}/PSD-to-Wordpress">PSD to Wordpress</a></li>
							    <li class="feature-list-item"><a href="{{ URL::to('service') }}/Custom-Website-Dev">Custom Website Dev.</a></li>
								<li class="feature-list-item"><a href="{{ URL::to('service') }}/Email-Newsletter-Design">Email Newsletter Design</a></li>
									<!-- /FEATURE LIST ITEM -->
								</ul>
								<!-- /FEATURE LIST -->
							</div>
							<!-- /FEATURE LIST BLOCK -->

							<!-- FEATURE LIST BLOCK -->
							<div class="feature-list-block">
								<h6 class="feature-list-title">Mobile App Design</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list spaced">
									<!-- FEATURE LIST ITEM -->
							        <li class="feature-list-item"><a href="{{ URL::to('service') }}/Mobile-App-Design">Mobile App Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Icon-Design">Icon Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/App-Mockups">App Mockups</a></li>
								</ul>
								<!-- /FEATURE LIST -->
								
								<div class="clearfix"></div>

								<h6 class="feature-list-title">VIDEOS &amp; ANIMATIONS</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list">
												<!-- FEATURE LIST -->
								<ul class="feature-list spaced">
									<!-- FEATURE LIST ITEM -->
								<li class="feature-list-item"><a href="#">Video Editing</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Explainer-Videos">Explainer Videos</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Logo-Animation">Logo Animation</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Animation">Animation</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/After-Effects-Editing">After Effects Editing</a></li>
								</ul>
								<!-- /FEATURE LIST -->
								</ul>
								<!-- /FEATURE LIST -->
							</div>
							<div class="feature-list-block">
								<h6 class="feature-list-title">Custom Graphic Design</h6>
								<hr class="line-separator">
								<!-- FEATURE LIST -->
								<ul class="feature-list">
									<!-- FEATURE LIST -->
								<ul class="feature-list spaced">
									<!-- FEATURE LIST ITEM -->
							        <li class="feature-list-item"><a href="{{ URL::to('service') }}/Social-Media-Posts">Social Media Posts</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Custom-Banner-Design">Custom Banner Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Ebooks-Design">Ebooks Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Carricature-Design">Carricature Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Poster-Flyer-Design">Poster &amp; Flyer Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Brochure-Design">Brochure Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Presentation-Design">Presentation Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Resume-Design">Resume Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/T-shirt-Apparel-Design">T-shirt &amp; Apparel Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Custom-Icon-Set-Design">Custom Icon Set Design</a></li>
									<li class="feature-list-item"><a href="{{ URL::to('service') }}/Custom-Bulk-Orders">Custom/Bulk Orders</a></li>
								
								</ul>
							</ul></div>
						</div>
					</li>
					<li class="menu-item"><a href="">Freebies</a></li>
					<li class="menu-item"><a href="">Learn</a></li>
					<li class="menu-search">
						<img src="{{ asset('home_asset/fonts/Shape.png')}}">
						<input class="search-query1 " type="text" name="search" placeholder="  Search">
					</li>
					@if(Session::get('login')!=true)
					<li class="dropdown">
                        <a href="#" class="LoginOpen">Log In</a>
                        <a href="#" class="btn btn-primary button black head-btn Registeropen">Sign Up</a>
                    </li>
                    @else
                    <li class="box user-info dropdown">
                      
						@foreach(\App\Users::where('user_email', Session::get('email'))->get() as $user)
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<figure class="avatar"><img src="{{ asset('home_asset/fonts/avatar.jpg')}}"/></figure>
						

						{{ $user->user_fname }} 
						
						<img src="{{ asset('home_asset/fonts/Shape2.png')}}"></b></a>
					
						  <ul class="dropdown-menu left">
							<li><a href="{{ URL::to('user/account') }}">Account Settings</a></li>
							<li><a href="{{ URL::to('user/account') }}">Download History</a></li>
							<li><a href="{{ URL::to('user/account') }}">Purchase History</a></li>
							<li class="divider"></li>
							<li><a href="{{ URL::to('logout') }}">Logout</a></li>
						  </ul>
						@endforeach
			                             
					</li>
                    @endif
					<li class="box cart">
					    <a href="#" class="button white head-btn">
						<img src="{{ asset('home_asset/fonts/shopping-cart.png')}}"> {{ Cart::total() }} $ &nbsp;<img src="{{ asset('home_asset/fonts/Shape2.png')}}"></a>
						<ul class="sub-menu indicator lavel_one1">
					        @foreach(Cart::content() as $row)
					        <li>
					        	<a href="#">
					        		<div class="col-md-9 text-left">{{ $row->name }}</div>
					        		<div class="col-md-3 text-right">{{ $row->price }}$
					        			<span class="cross">
					        			<a href="{{ URL::to('removefromcart') }}/{{ $row->rowId }}"> 
					        			<img src="{{asset('home_asset/img/cross.png')}}"/></span>
					        			</a>
					        		</div>  
					        	</a>
								</li>
							@endforeach
							<hr class="cart-view">
					        	<li class="subtotal">
					        		<a href="{{ URL::to('/cart')}}">
					        			<div class="col-md-9 text-left">Subtotal </div>
					        			<div class="col-md-3 text-right">{{ Cart::total() }} $</div>
					        		</a>
					        	</li>
							  <li class="view cart text-center">
							  <a href="{{ URL::to('/cart') }}" type="submit" class="see3">View Cart</a>
							  <a href="{{ URL::to('/checkout') }}" type="submit" class="see4 btn-red">Checkout Now</a>
							  </li>
							
					    </ul>                                   
					</li>
			
				</ul>
			</nav>
		
		</div>
							</div>
							<!-- Desktop Menu -->
							
							 
                        </div>

                    </div>
                </div>
            </div>
	</header>