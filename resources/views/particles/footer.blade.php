<!-- FOOTER -->
	<footer>
		<!-- FOOTER TOP -->
		<div id="footer-top-wrap">
			<div id="footer-top">
				<!-- COMPANY INFO -->
				<div class="company-info">
					<p class="footer-title">Our Community</p>
					<ul class="company-info-list">
						<li class="company-info-item">
							<span class="icon-present"></span>
							<p><span>850.296</span> Products</p>
						</li>
						<li class="company-info-item">
							<span class="icon-energy"></span>
							<p><span>1.207.300</span> Members</p>
						</li>
						<li class="company-info-item">
							<span class="icon-user"></span>
							<p><span>74.059</span> Sellers</p>
						</li>
					</ul>
					
				</div>
				<!-- /COMPANY INFO -->

				<!-- LINK INFO -->
				<div class="link-info">
					
					<p class="footer-title">Learn More</p>
					<!-- LINK LIST -->
					
						<ul class="link-list">
						<li class="link-item">
							
							<a href="#">About Us</a>
						</li>
						<li class="link-item">
							
							<a href="#">Privacy Policy</a>
						</li>
						<li class="link-item">
							
							<a href="forum.html">Refund Policy</a>
						</li>
						<li class="link-item">
							
							<a href="forum.html">Terms & Conditions</a>
						</li>
					</ul>
					
				</div>
				<!-- /LINK INFO -->

				<div class="link-info">
					<p class="footer-title">Contact Us</p>
					<!-- LINK LIST -->
					<ul class="link-list">
						<li class="link-item">
							
							<a href="#">Start Selling</a>
						</li>
						<li class="link-item">
							
							<a href="#">Advertise With Us</a>
						</li>
							<li class="link-item">
							
							<a href="#">Partner With Us</a>
						</li>
						<li class="link-item">
							
							<a href="#">Sitemap</a>
						</li>
						<li class="link-item">
							
							<a href="#">Contact Us</a>
						</li>
					</ul>
					<!-- /LINK LIST -->
				</div>

				<!-- LINK INFO -->
				<div class="link-info">
					<p class="footer-title">Resources</p>
					<!-- LINK LIST -->
					<ul class="link-list">
						<li class="link-item">
							
							<a href="#">Freebies</a>
						</li>
						<li class="link-item">
							
							<a href="#">Blog</a>
						</li>
						<li class="link-item">
							<a href="#">E-books</a>
						</li>
					</ul>
					<!-- /LINK LIST -->
				</div>
				<!-- /LINK INFO -->

				<!-- TWITTER FEED -->
				<div class="twitter-feed">
					<p class="footer-title">Stay In Touch</p>
					<!-- SOCIAL LINKS -->
					<ul class="social-links">
						<li class="social-link fb">
							<a href="#"></a>
						</li>
						<li class="social-link twt">
							<a href="#"></a>
						</li>
						<li class="social-link db">
							<a href="#"></a>
						</li>
						<li class="social-link rss">
							<a href="#"></a>
						</li>
					</ul>
					<!-- /SOCIAL LINKS -->
				</div>
				<!-- /TWITTER FEED -->
			</div>
		</div>
		<!-- /FOOTER TOP -->

		<div id="footer-bottom-wrap">
			<div id="footer-bottom">
				<div class="half-big-row">
					<p><span>&copy;</span><a href="#"> Design Minister</a>  - All Rights Reserved 2017</p>
				
				</div>
				<div class="half-small-row">
					<div class="ts_footer_link">
						<ul>
					    	<li><p>Secure Payments:</p></li>
					        <li><a target="_blank" href="#" class="wallet wallet_1">&nbsp;</a></li>
					    	<li><a target="_blank" href="#" class="wallet wallet_2">&nbsp;</a></li>
					    	<li><a target="_blank" href="#" class="wallet wallet_3">&nbsp;</a></li>
					    	<li><a target="_blank" href="#" class="wallet wallet_4">&nbsp;</a></li>
					    						
						</ul>
					</div>
				</div>
		
			</div>
		</div>
	</footer>
	<!-- /FOOTER -->
	<!-- LOGIN ACOOUNT -->
<div class="overlay" id="LoginPopup" style="display:none">
	<div class="form-popup custom">
				<!-- CLOSE BTN -->
				<div class="close-btn " id="close-login">
					<!-- SVG PLUS -->
					<svg class="svg-plus">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
					</svg>
					<!-- /SVG PLUS -->
				</div>
				<!-- /CLOSE BTN -->

				<!-- FORM POPUP HEADLINE -->
				<div class="form-popup-headline secondary">
					<h2>Login to your Account</h2>
					<p>Enter now to your account and start buying and selling!</p>
				</div>
				<!-- /FORM POPUP HEADLINE -->

				<!-- FORM POPUP CONTENT -->
				<div class="form-popup-content">
					<form id="login-form2" method="post" action="{{ URL::to('login') }}">
						{!! csrf_field() !!}
						<label for="Email" class="rl-label">Email</label>
						<input type="email" id="username5" name="email" placeholder="Enter your username here..." required>
						<label for="password5" class="rl-label">Password</label>
						<input type="password" id="password5" name="password" placeholder="Enter your password here..." required>
						<p>Forgot your password? <a href="#" class="ForgotOpen primary">Click here!</a></p>
						<button class="button mid dark" type="submit">Login <span class="primary">Now!</span></button>
					</form>
					<!-- LINE SEPARATOR -->
					<hr class="line-separator double">
					<!-- /LINE SEPARATOR -->
					<a href="{{ URL::to('redirect') }}" class="button mid fb">Login with Facebook</a>
					<p class="clearfix"></p>
					<p class="popup-text">New to Design Minister!! <a href="#" class="Registeropen primary"> Register Here</a></p>
				</div>
				<!-- /FORM POPUP CONTENT -->
				
			</div>
</div>	
<!-- LOGIN ACOOUNT -->

<!-- REGISTER POP UP -->
<div class="overlay" id="RegisterPopup" style="display:none">
	<div class="form-popup custom">
				<!-- CLOSE BTN -->
				<div class="close-btn" id="close-register">
					<!-- SVG PLUS -->
					<svg class="svg-plus">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
					</svg>
					<!-- /SVG PLUS -->
				</div>
				<!-- /CLOSE BTN -->

				<!-- FORM POPUP HEADLINE -->
				<div class="form-popup-headline primary">
					<h2>Register Account</h2>
					<p>Register now and start making money from home!</p>
				</div>
				<!-- /FORM POPUP HEADLINE -->

				<!-- FORM POPUP CONTENT -->
				<div class="form-popup-content">
					<form id="register-form4" method="post" action="{{ URL::to('register')}}">
						{{ csrf_field() }}
						<label for="first name" class="rl-label required">First Name</label>
						<input type="text" id="fname" name="user_fname" placeholder="Enter your First Name here...">
						<label for="last name" class="rl-label required">Last Name</label>
						<input type="text" id="lname" name="user_lname" placeholder="Enter your Last Name here...">
						<label for="email_address6" class="rl-label required">Email Address</label>
						<input type="text" id="email_address6" name="user_email" placeholder="Enter your email address here...">
						<label for="password6" class="rl-label required">Password</label>
						<input type="password" id="password6" name="password" placeholder="Enter your password here...">
						<button class="button mid dark" type="submit">Register Now!</button>
						<hr class="line-separator double">
						<a href="{{ URL::to('redirect')}}" class="button mid fb">Register with Facebook</a>
					    <p class="popup-text">Already have an account!! <a href="#" class="LoginOpen primary"> Login Here</a></p>
					</form>
				
				</div>
				<!-- /FORM POPUP CONTENT -->
			</div>
</div>	
<!-- REGISTER POP UP -->
<!-- FORGOT PASSWORD -->
<div class="overlay" id="ForgotPopup" style="display:none">
	<div class="form-popup custom">
				<!-- CLOSE BTN -->
				<div class="close-btn" id="close-forgot">
					<!-- SVG PLUS -->
					<svg class="svg-plus">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use>
					</svg>
					<!-- /SVG PLUS -->
				</div>
				<!-- /CLOSE BTN -->

				<!-- FORM POPUP CONTENT -->
				<div class="form-popup-content">
					<h4 class="popup-title">Restore your Password</h4>
					<!-- LINE SEPARATOR -->
					<hr class="line-separator short">
					<!-- /LINE SEPARATOR -->
					<p class="spaced">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
					<form id="restore-pwd-form">
						<label for="email_address" class="rl-label">Email Address</label>
						<input type="text" id="email_address" name="email_address" placeholder="Enter your email address...">
						<button class="button mid dark no-space">Restore your <span class="primary">Password</span></button>
					</form>
				</div>
				<!-- /FORM POPUP CONTENT -->
			</div>
</div>
<!-- FORGOT PASSWORD -->
	
	    <div class="shadow-film closed"></div>
        <!-- SVG ARROW -->
        <svg style="display: none;">	
	    <symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"/>
	    </symbol>
        </svg>
        <!-- /SVG ARROW -->
        <!-- SVG CHECK -->
        <svg style="display: none;">
	    <symbol id="svg-check" viewBox="0 0 15 12" preserveAspectRatio="xMinYMin meet">
		<polygon points="12.45,0.344 5.39,7.404 2.562,4.575 0.429,6.708 3.257,9.536 3.257,9.536 
			5.379,11.657 14.571,2.465 "/>
	    </symbol>
        </svg>
        <!-- /SVG CHECK -->

        <!-- SVG STAR -->
        <svg style="display: none;">
	    <symbol id="svg-star" viewBox="0 0 10 10" preserveAspectRatio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	    2.495,6.313 -0.002,3.878 3.45,3.376 "/>
	    </symbol>
        </svg>
        <!-- /SVG STAR -->

        <!-- SVG PLUS -->
        <svg style="display: none;">
	    <symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
		<rect x="5" width="3" height="13"/>
		<rect y="5" width="13" height="3"/>
	    </symbol>
        </svg>
        <!-- /SVG PLUS -->