<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="{{ asset('home_asset/css/vendor/simple-line-icons.css')}}">

	<link rel="stylesheet" href="{{ asset('home_asset/css/vendor/owl.carousel.css')}}">
	<link rel="stylesheet" href="{{ asset('home_asset/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('home_asset/css/custom.css')}}">
	<!-- favicon -->
	<link rel="icon" href="favicon.ico">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Design Minister | Design Resource Marketplace</title>
</head>
<body>

	@include('particles.header')
	
	

	@include('particles.sidemenu')


	@include('particles.mainmenu')

	

	@yield('content')
	
	@include('particles.footer')




<!-- jQuery -->
<script src="{{ asset('home_asset/js/vendor/jquery-3.1.0.min.js')}}"></script>
<!-- Tooltipster -->
<script src="{{ asset('home_asset/js/vendor/jquery.tooltipster.min.js')}}"></script>
<!-- Tweet -->
<script src="{{ asset('home_asset/js/vendor/twitter/jquery.tweet.min.js')}}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('home_asset/js/vendor/owl.carousel.min.js')}}"></script>
<!-- Side Menu -->
<script src="{{ asset('home_asset/js/side-menu.js')}}"></script>
<!-- Home -->
<script src="{{ asset('home_asset/js/home.js')}}"></script>
<!-- Tooltip -->
<script src="{{ asset('home_asset/js/tooltip.js')}}"></script>
<!-- User Quickview Dropdown -->
<script src="{{ asset('home_asset/js/user-board.js')}}"></script>
<!-- Footer -->
<script src="{{ asset('home_asset/js/footer.js')}}"></script>

</body>
</html>	