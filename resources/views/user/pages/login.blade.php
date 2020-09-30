@extends('user.template.template-w-background')

@section('content')
<link rel="stylesheet" href="/store_user/css/login.css">
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