<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Design Minister</title>
<!-- CSS styles -->
<link rel="stylesheet" href="{{ asset('home_asset/css/bootstrap.css')}}"/>
<!-- For Slick slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick.css')}}"/>
<!-- // Add the new slick-theme.css if you want the default styling -->
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick-theme.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/css/main.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/css/styles.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/css/s.css') }}"/>
@yield('css')
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<body>
<div class="site">
	@include('particles.header')

	

	@yield('content')
	
	@include('particles.footer')
</div>


	
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
					<a class="btn bt-primary btn-block btn-facebook facebook-login" href="{{ URL::to('/redirect') }}">Sign In using <strong>Facebook</strong></a>
					<span class="divider">OR</span>
					<form action="{{ URL::to('login')}}" method="POST">
						{{ csrf_field() }}
						<input type="text" class="form-control" placeholder="Email" name="email">
						<input type="password" class="form-control ts_topmargin10" placeholder="Password" name="password">
						<button class="btn btn-primary ts_search_btn ts_topmargin10" type="submit">Sign In</button>
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
							<a class="btn bt-primary btn-block btn-facebook facebook-login" href="{{ URL::to('redirect') }}">Sign up using <strong>Facebook</strong></a>
							<span class="divider">OR</span>
							<form action="{{ URL::to('register') }}" method="POST">
								{{ csrf_field() }}
								<input type="text" class="form-control" placeholder="Email Address" name="user_email">
								<input type="text" class="form-control ts_topmargin10" placeholder="First Name" name="user_fname">
								<input type="text" class="form-control ts_topmargin10" placeholder="Last Name" name="user_lname">
								<input type="password" class="form-control ts_topmargin10" placeholder="Password" name="user_email">
								<button class="btn btn-primary ts_search_btn ts_topmargin10" type="submit">Get Register</button>
							</form>
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
	<!-- Revision Modal -->
	<div id="RevisionModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
				
				
		<!-- Modal content-->
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Revision Form</h4>
				</div>
			<div class="modal-body">
					<div class="tab-box text-center">
						<div class="cart-flex">
                            <div class="col-md-6 col-xs-12">
                                <a href="#" class="item-thumb">
									<img src="{{ asset('home_asset/img/4.png')}}" class="img-responsive">
								</a>
                            </div>
                            <div class="col-md-6 col-xs-12 text-left">
                                <p class="item-title">Delish Pro</p>
								<p class="item-des">By <strong>Egor</strong> In <strong>Facebook</strong></p>
							</div>
							<div class="clearfix"></div>
                        </div>
						<hr>
						<div class="orderinput">
							<textarea rows="4"></textarea>
						</div>
						<div class="gap20"></div>
						<button type="button" class="btn btn-primary see1"> Submit</button>
					</div>
			</div>
						
		</div>
		<!-- Modal content-->
		
		
	  </div>
	</div>
	<!-- Revision Modal -->

<script type='text/javascript' src="{{ asset('home_asset/js/jquery.min.js')}}"></script>

<script type='text/javascript' src="{{ asset('home_asset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/js/side-menu.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/js/custom.js')}}"></script>



<!--<script type='text/javascript' src='js/script.js'></script>-->
@yield('script')


</body>
</html>