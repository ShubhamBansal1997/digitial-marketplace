<!-- Footer Section -->
	<footer class="main-footer">
        <div class="container">
            <div class="row row-col-gap" data-gutter="60">
                <div class="col-md-8 col-sm-12 hidden-xs">
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Learn More</h4>
                        <ul class="design">
                            <li><a href="#">About Us</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Refund Policy</a>
                            </li>
                            <li><a href="#">Term & Conditions</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Contact Us</h4>
                        <ul class="design">
                            <li><a href="#">Start Selling</a>
                            </li>
                            <li><a href="#">Advertise With Us</a>
                            </li>
                            <li><a href="#">Partner With Us</a>
                            </li>
                            <li><a href="#">Sitemap</a>
                            </li>
                            <li><a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Our Community</h4>
                        <ul class="design">
                            <li><a href="#">850.296 Products</a>
                            </li>
                            <li><a href="#">1.207.300 Members</a>
                            </li>
                            <li><a href="#">74.059 Sellers</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 ">
                    <h4 class="widget-title-sm">Newsletter</h4>
                    <form action="{{ URL::to('subscribe')}}" method="post">
                    	{!! csrf_field() !!}
                        <div class="form-group">
                            <label style="margin-bottom: 15px;">Sign up for our newsletter for stay up-to-date with our latest news in your inbox.</label>
                            <input class="newsletter-input form-control" placeholder="yourmail@gmail.com" type="text" name="email"/>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Subscribe" />
                    </form>
                </div>
            </div>
            <br/>
			<hr>
            <div class="row">
				
                <div class="col-md-8 col-xs-12">
                    <div class="col-md-5 col-xs-12 p-none">
                        <p class="copyright-text text-left"> &copy; 2017 <a href="#">Design Minister</a>. All rights reseved.</p>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <ul class="main-footer-social-list pull-right">
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/006-facebook-logo.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/005-twitter-logo-silhouette.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/003-google-plus-symbol.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/004-dribbble-logo.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/002-pinterest.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/001-behance-logo.png')}}"/></a></li>
                            
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <ul class="payment-icons-list">
                        <li>
                            <img src="{{ asset('home_asset/img/001-credit-card.png')}}" alt="Image Alternative text" title="Pay with Maestro" />
                        </li>

                        <li>
                            <img src="{{ asset('home_asset/img/003-visa.png')}}" alt="Image Alternative text" title="Pay with Visa" />
                        </li>
                        <li>
                            <img src="{{ asset('home_asset/img/002-paypal.png')}}" alt="Image Alternative text" title="Pay with Paypal" />
                        </li>

                    </ul>
                </div>
            </div>


        </div>
    </footer>

	<!-- LOGIN - modal-->
	<div id="LoginModal" class="overlay" style="display: none;">
		<div class="form-popup custom clearfix">
			<div class="modal fade in" role="dialog" style="display: block;">
			<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content modal-login">
	
			<!-- user_sign_in_start -->
			<div id="user_sign_in">
				
				<div class="modal-panel-right">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" id="close-login"><img src="{{ asset('home_asset/img/cross.png')}}"/></button>
					<h4 class="modal-title">Sign Into Your Account</h4>
				  </div>
				<div class="modal-body">
				<!-- Wrapper for backbone views -->
				
				<div class="pane-sign-up">
					<a class="btn bt-primary btn-block btn-facebook facebook-login">Sign In using <strong>Facebook</strong></a>
					<span class="divider">OR</span>
					<form action="#">
						<input type="text" class="form-control" placeholder="Username">
						<input type="password" class="form-control ts_topmargin10" placeholder="Password">
						<button class="btn btn-primary ts_search_btn ts_topmargin10">Sign In</button>
					</form>
			
				</div>
				
				</div>
				<div class="modal-footer">
				<h4 class="modal-title"> Don't have an account?</h4>
				<a href="#" class="btn btn-block btn-transparent Registeropen">Create an account</a>
			</div>
			</div>
			</div>
			<!-- user_sign_in_end -->
		</div>

			</div>
		</div>
		</div>
	</div>
	<!-- LOGIN -  modal-->
	
	<!-- LOGIN - modal-->
	<div id="RegisterModal" class="overlay" style="display: none;">
		<div class="form-popup custom clearfix">
			<div class="modal fade in" role="dialog" style="display: block;">
		  <div class="modal-dialog modal-md">

			<!-- Modal content-->
			<div class="modal-content modal-login">
				<!-- user_sign_up_start -->
				<div id="user_sign_up">
					
					<div class="modal-panel-right">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" id="close-register"><img src="{{ asset('home_asset/img/cross.png')}}"/></button>
							<h4 class="modal-title">Create Your Free Account</h4>
						  </div>
						<div class="modal-body">
						<!-- Wrapper for backbone views -->
						<div class="pane-sign-up">
							<a class="btn bt-primary btn-block btn-facebook facebook-login" href="{{ URL::to('redirect')}}">Sign up using <strong>Facebook</strong></a>
							<span class="divider">OR</span>
							<button class="gmail ts_search_btn">Continue with Email</button>
							<p>By creating an account, you agree to our <a href="#">Terms & Conditions</a></p>
						</div>
						</div>
						<div class="modal-footer">
						<h4 class="modal-title">Already have an account? </h4>
						<a href="#" class="btn btn-block btn-transparent LoginOpen">Sign In!</a>
					</div>
					</div>
				</div>
				<!-- user_sign_up_end -->
			</div>

		  </div>
		</div>
		</div>
	</div>
	<!-- LOGIN -  modal-->
