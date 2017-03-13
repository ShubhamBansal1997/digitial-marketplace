<div class="header-wrap">
		<header>
			<!-- LOGO -->
			<a href="index.html">
				<figure class="logo">
					<img src="{{ asset('home_asset/images/logo.png')}}" alt="logo">
				</figure>
			</a>
			
			<div class="mobile-menu-handler left">
				<a href="{{ URL::to('/')}}">
					<figure class="logo-mobile ">
						<img src="{{ asset('home_asset/images/logo_mobile.png')}}" alt="logo-mobile">
					</figure>
				</a>
			</div>
			
			<div class="mobile-menu-handler right primary">
				<img src="{{ asset('home_asset/images/pull-icon.png')}}" alt="pull-icon">
			</div>
			
			<!-- USER BOARD -->
			<div class="user-board">

				@if(Session::get('login')=='true')
				@foreach(\App\Users::where('user_email',Session::get('email'))->get() as $user)
				<div class="user-quickview">
					<!-- USER AVATAR -->
					<a href="author-profile.html">
					<div class="outer-ring">
						<div class="inner-ring"></div>
						<figure class="user-avatar">
							<img src="{{ \App\Users::profile_image($user->user_profile_image) }}" alt="{{ \App\Users::username($user->id) }}">
						</figure>
					</div>
					</a>
					<!-- /USER AVATAR -->
					<p class="user-name">{{ \App\Users::username($user->id) }}</p>

					<svg class="svg-arrow">
						<use xlink:href="#svg-arrow"></use>
					</svg>
					<!-- DROPDOWN -->
					<ul class="dropdown small closed">
						<li class="dropdown-item">
							<a href="{{ URL::to('user/account')}}">Profile Settings</a>
						</li>
						<li class="dropdown-item">
							<a href="{{ URL::to('user/account')}}">Purchase History</a>
						</li>
						<li class="dropdown-item">
							<a href="{{ URL::to('user/account') }}">Services History</a>
						</li>
						<!-- <li class="dropdown-item">
							<a href="{{ URL::to('earnings')}}">Earnings</a>
						</li>
						<li class="dropdown-item">
							<a href="{{ URL::to('payment') }}">Payments</a>
						</li> -->
						<li class="dropdown-item">
							<a href="{{ URL::to('logout') }}">Logout</a>
						</li>
					</ul>
				</div>
				@endforeach
				@else
				<div class="account-actions no-space">
					<a href="#" class="Registeropen button primary">Register</a>
					<a href="#" class="LoginOpen button secondary">Login</a>
				</div>
				@endif

				<!-- CART ON HOMEPAGE -->
				<div class="account-information">
					<div class="account-cart-quickview">
						<span class="icon-present">
							<!-- SVG ARROW -->
							<svg class="svg-arrow">
								<use xlink:href="#svg-arrow"></use>
							</svg>
							<!-- /SVG ARROW -->
						</span>

						<!-- PIN -->
						<span class="pin soft-edged theme">{{ Cart::count() }}</span>
						<!-- /PIN -->
							<!-- DROPDOWN CART -->
						<ul class="dropdown cart closed">
							<!-- DROPDOWN ITEM -->
							@foreach(Cart::content() as $row)
							<li class="dropdown-item">
								<a href="{{ URL::to('/product')}}/{{ $row->options->prod_slug }}/{{ $row->id }}" class="link-to"></a>
								<!-- SVG PLUS -->
								<svg class="svg-plus">
									<use xlink:href="{{ URL::to('removefromcart')}}/{{$row->rowId }}"></use>
								</svg>
								<!-- /SVG PLUS -->
								<figure class="product-preview-image tiny">
									<img src="{{ $row->options->pic }}" alt="{{ $row->name }}">
								</figure>
								<p class="text-header tiny">{{ $row->name }}</p>
								<p class="category tiny primary">{{ $row->options->vendor_name }}</p>
								<p class="price tiny"><span>$</span>{{ $row->price }}</p>
							</li>
							<!-- /DROPDOWN ITEM -->
							@endforeach
							<!-- DROPDOWN ITEM -->
							

							<!-- DROPDOWN ITEM -->
							<li class="dropdown-item">
								<p class="text-header tiny">Total</p>
								<p class="price"><span>$</span>{{ Cart::total() }} </p>
								<a href="{{ URL::to('/cart')}}" class="button primary half">Go to Cart</a>
								<a href="{{ URL::to('/checkout')}}" class="button secondary half">Go to Checkout</a>
							</li>
							<!-- /DROPDOWN ITEM -->
						</ul>
						<!-- /DROPDOWN CART -->
					</div>
			    </div>
			</div>
			
		</header>
	</div>
	<!-- /HEADER -->