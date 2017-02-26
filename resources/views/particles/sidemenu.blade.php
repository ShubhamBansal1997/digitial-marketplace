<!-- SIDE MENU -->
	<div id="mobile-menu" class="side-menu right closed">
		<!-- SVG PLUS -->
		<svg class="svg-plus">
			<use xlink:href="#svg-plus"></use>
		</svg>
		<!-- /SVG PLUS -->

		@if(Session::get('login')=='true')
		<!-- SIDE MENU HEADER -->
		<div class="side-menu-header">
			<figure class="logo small">
				<div class="account-actions no-space">
					<a href="#" class="Registeropen button primary">Register</a>
					<a href="#" class="LoginOpen button secondary">Login</a>
				</div>
			</figure>
			
		</div>
		@else
		<!-- /SIDE MENU HEADER -->

		<!-- SIDE MENU TITLE -->
		<p class="side-menu-title">Account</p>
		<!-- /SIDE MENU TITLE -->
     <!-- /SIDE MENU -->  
		<ul class="dropdown interactive">
			<li class="dropdown-item"><a href="">My Account</a></li>
			<li class="dropdown-item"><a href="">Cart</a></li>
		</ul>
		@endif
		<p class="side-menu-title">Main Menu</p>
		<!-- /SIDE MENU TITLE -->
     <!-- /SIDE MENU -->  
		<ul class="dropdown interactive">
			<li class="dropdown-item"><a href="">Home</a></li>
			<li class="dropdown-item"><a href="">Products</a></li>
			<li class="dropdown-item"><a href="">Services</a></li>
			<li class="dropdown-item"><a href="">Bundles</a></li>
			<li class="dropdown-item"><a href="">$3 Deals</a></li>
			<li class="dropdown-item"><a href="">Freebies</a></li>
			<li class="dropdown-item"><a href="">Knowledge Library</a></li>
			<li class="dropdown-item"><a href="">Logout</a></li>
		</ul>
	</div>
<!-- /SIDE MENU -->