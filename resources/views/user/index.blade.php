<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Beranda | E-Shopper</title>
    <link href="/store_user/css/bootstrap.min.css" rel="stylesheet">
    <link href="/store_user/css/font-awesome.min.css" rel="stylesheet">
    <link href="/store_user/css/prettyPhoto.css" rel="stylesheet">
    <link href="/store_user/css/price-range.css" rel="stylesheet">
    <link href="/store_user/css/animate.css" rel="stylesheet">
	<link href="/store_user/css/main.css" rel="stylesheet">
	<link href="/store_user/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="/store_user/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/store_user/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/store_user/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/store_user/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/store_user/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ route('home-view')}}"><img src="/store_user/images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Daftar</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
								<li><a href="{{ route('loginuser') }}"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">

					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	{{-- <section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					@include('user.advertisement.header')					
				</div>
			</div>
		</div>
	</section><!--/slider--> --}}
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						@include('user.menu.category')
					
						{{-- @include('menu.brand') --}}
						
						
						@include('user.advertisement.sidebar')
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
                    @yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->				
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2020 E-SHOPPER Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="/store_user/js/jquery.js"></script>
	<script src="/store_user/js/bootstrap.min.js"></script>
	<script src="/store_user/js/jquery.scrollUp.min.js"></script>
	<script src="/store_user/js/price-range.js"></script>
    <script src="/store_user/js/jquery.prettyPhoto.js"></script>
    <script src="/store_user/js/main.js"></script>
</body>
</html>