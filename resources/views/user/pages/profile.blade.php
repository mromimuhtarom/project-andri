@extends('user.template.template-w-background')

@section('content')
<link rel="stylesheet" href="/store_user/css/login.css">
    <div class="login-form"><!--login form-->
        <h2>Selamat datang</h2>
        <h4>Profile Anda</h4>
        <div class="changebtn">
        </div>

        <form action="{{ route('loginuser-process')}}" method="POST">
            @csrf
            <input type="text" name="username" id="username" class="disabled-form" placeholder="Nama Pengguna" />
            <input type="text" name="fullname" id="fullname" class="disabled-form" placeholder="Nama Lengkap">
            <input type="text" name="no_hp" id="nohp" placeholder="No Telp">
            <textarea name="address" placeholder="Alamat" id="address" class="disabled-form" cols="30" rows="10" style="margin-bottom:15px;"></textarea>
            <table width="100%" border="1" class="textboxmany">
                <tr>
                    <td>
                        <select name="" class="form-control"  id="">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </td>
                    <td>
                        <select name="" class="form-control" id="">
                            <option value="">Pilih Kota</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Kode Pos">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                {{-- <tr>
                    <td colspan="2">
                        <input type="password" name="password" id="username" class="disabled-form" placeholder="Kata Sandi" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="password" name="password" id="username" class="disabled-form" placeholder="Konfirmasi Kata Sandi" />
                    </td>
                </tr> --}}
            </table>
           
        </form>
    </div><!--/login form-->
<script>
    $(document).ready(function() {
        $('.disabled-form').attr('disabled', 'disabled');
        $('.changebtn').append('<button type="submit" class="btn btn-primary edit-form">Ubah Profile</button>')

        $('.changebtn').on('click', '.edit-form', function(){
            $(this).remove();
            $('.changebtn').append('<button type="submit" class="btn btn-danger cancel-form">Batal</button>');
            $('.disabled-form').removeAttr('disabled');
        });
        $('.changebtn').on('click', '.cancel-form', function(){
            $(this).remove();
            $('.disabled-form').attr('disabled', 'disabled');
            $('.changebtn').append('<button type="submit" class="btn btn-primary edit-form">Ubah Profile</button>');
            $.ajax({
                url: '{{ route("profile-view") }}',
                type: 'get',
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    //add response in modal body
                    var obj = JSON.parse(response);
                    console.log(obj.data.user_id);
                    $('#username').val(obj.data.username);
                    $('#fullname').val(obj.data.fullname);
                    $('#nohp').val(obj.data.telp);
                    $('#nohp').val(obj.data.telp);
                    $('#address').val(obj.)
                    // if(obj.status == "OK"){
                    //    alert(obj.message); 
                    // } else {
                    //     alert(obj.message);
                    // }
                
                    
                }
            });
        });
    });
</script>

@endsection