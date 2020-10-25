<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="/store_user/images/home/favicon.png" type="image/x-icon">
    <title>{{ $titleweb }}</title>
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
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="/store_user/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/store_user/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/store_user/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/store_user/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/store_user/images/ico/apple-touch-icon-57-precomposed.png">
	<script src="/store_user/js/jquery.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="/js/general.js"></script>
	<style>
		html{
			width: 100%;
			height: 100%;
		}
		body {
            background: url(/image/login/login.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover; 

            width: 100%;
            height: 100%;
            margin: 0;
		}
		#header{
			background: rgba(255, 255, 255, 0.788) no-repeat center center fixed;
            margin: 0px;
            width: 100%;
            height: auto;
            top: 0px;
            left: 0px;
		}
	</style>
</head><!--/head-->

<body>
		<header id="header"><!--header-->		
			<div class="header-middle"><!--header-middle-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo pull-left">
								<a href="{{ route('home-view') }}"><img src="/store_user/images/home/logo.png" max-width="139px" max-height="39px" alt="" /></a>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="shop-menu pull-right">
								<ul class="nav navbar-nav">
									@if (Session::get('login'))
									<li><a href="{{ route('profile-view') }}" style="background:none !important" class="{{ Request::is('Profile/*') ? 'active' : null}}"><i class="fa fa-user"></i>Profile</a></li>
									<li><a href="{{ route('cart-view') }}" style="background:none !important" class="{{ Request::is('Cart/*') ? 'active' : null}}"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
									<li><a href="{{ route('logoutuser-process') }}" class="active" style="background:none !important"><i class="fa fa-lock"></i> Keluar</a></li>
									@else 
									<li><a href="{{ route('registeruser') }}" style="background:none !important" class="{{ Request::is('User/register-view') ? 'active' : null}}"><i class="fa fa-user"></i> Daftar</a></li>
									<li><a href="{{ route('loginuser')}}" style="background:none !important" class="{{ Request::is('User/login') ? 'active' : null}}"><i class="fa fa-lock"></i> Login</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-middle-->
		</header><!--/header-->
		
		<section id="form"><!--form-->
			<div class="container">
				<div class="row">
					<div class="col col-sm-offset-1">
                        @yield('content')
					</div>
				</div>
			</div>
		</section><!--/form-->
	

  
	<script src="/store_user/js/price-range.js"></script>
    <script src="/store_user/js/jquery.scrollUp.min.js"></script>
	<script src="/store_user/js/bootstrap.min.js"></script>
    <script src="/store_user/js/jquery.prettyPhoto.js"></script>
	<script src="/store_user/js/main.js"></script>
	@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>
</html>