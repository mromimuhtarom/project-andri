@extends('user.template.template-w-background')

@section('content')
    <link rel="stylesheet" href="/store_user/css/login.css">
    <div class="login-form"><!--login form-->
        <h2>Selamat datang</h2>
        <h4>silahkan daftar terlebih dahulu untuk bisa melakukan belanja</h4>
        <form action="{{ route('loginuser-process')}}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Nama Pengguna" />
            <table width="100%">
                <tr>
                    <td>
                         <input type="text" name="front_name" placeholder="Nama Depan">
                    </td>
                    <td>
                         <input type="text" name="front_name" placeholder="Nama Tengah">
                    </td>
                    <td>
                         <input type="text" name="front_name" placeholder="Nama Belakang">
                    </td>
                </tr>
            </table> 
            <input type="text" name="no_hp" placeholder="No Telp">
            <textarea name="address" placeholder="Alamat" cols="30" rows="10" style="margin-bottom:15px;"></textarea>
            <table width="100%">
                <tr>
                    <td>
                        <input type="password" name="password" placeholder="Kata Sandi" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password" placeholder="Konfirmasi Kata Sandi" />
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-default">Daftar</button>
        </form>
    </div><!--/login form--> 
@endsection