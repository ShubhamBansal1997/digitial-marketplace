<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Design Minister</title>
<link rel="stylesheet" href="{{ asset('home_asset/css/main.css')}}"/>
<link rel="stylesheet" href="{{ asset('home_asset/css/bootstrap.css')}}"/>
<!--<link rel="stylesheet" href="css/carousel.css">-->
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick.css')}}"/>
<!--// Add the new slick-theme.css if you want the default styling-->
<link rel="stylesheet" type="text/css" href="{{ asset('home_asset/slick/slick-theme.css')}}"/>
<link rel="stylesheet" href="{{ asset('home_asset/css/styles.css')}}"/>
<link rel='stylesheet' href="{{ asset('home_asset/css/s.css')}}" type='text/css' media='all' />

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<body>

	@include('particles.header')

	

	@yield('content')
	
	@include('particles.footer')



<script type='text/javascript' src="{{ asset('home_asset/js/jquery.min.js')}}"></script>

<script type='text/javascript' src="{{ asset('home_asset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/js/side-menu.js')}}"></script>
<script type="text/javascript" src="{{ asset('home_asset/slick/slick.min.js')}}"></script>
<!--<script type='text/javascript' src='js/script.js'></script>-->
<script type='text/javascript' src="{{ asset('home_asset/js/custom.js')}}"></script>

</body>
</html>