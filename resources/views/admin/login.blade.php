<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="/image/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="/image/login/bg.svg">
		</div>
		<div class="login-content">
            <form action="{{ route('processlogin')}}" method="POST">
                @csrf
				<img src="/image/login/avatar.svg">
				<h2 class="title">Selamat Datang</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Nama Pengguna</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Kata Sandi</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
	<script type="text/javascript" src="/js/login.js"></script>
	@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>
</html>
