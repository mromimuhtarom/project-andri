@extends('user.template.template-w-background')

@section('content')
<style>
    	.login-form{
            background: rgba(255, 255, 255, 0.788) no-repeat center center fixed;
            border-radius: 25px;
            margin: 0px;
            padding: 25px;
            width: 100%;
            height: auto;
            top: 0px;
            left: 0px;
		}
</style>
    <div class="login-form"><!--login form-->
        <h2>Selamat datang</h2>
        <h4>silahkan login terlebih dahulu</h4>
        <form action="{{ route('loginuser-process')}}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit" class="btn btn-default">Masuk</button>
        </form>
    </div><!--/login form-->
@endsection