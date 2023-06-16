<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('FE/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{  asset('FE/css/font-awesome.min.css') }} " rel="stylesheet">
    <link href="{{ asset('FE/css/prettyPhoto.css') }} " rel="stylesheet">
    <link href="{{ asset('FE/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('FE/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('FE/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

	

	@include('include.header')
	@include('include.slider')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('include.menuleft')
				</div>
				
			@yield('content')
			</div>
		</div>
	</section>
	
	
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>