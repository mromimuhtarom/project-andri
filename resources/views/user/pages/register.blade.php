@extends('user.template.template-w-background')

@section('content')
    <link rel="stylesheet" href="/store_user/css/login.css">
    <style>
        .form-control{
            background-color:#ffff !important;
        }
    </style>
    <div class="login-form"><!--login form-->
        <h2>Selamat datang</h2>
        <h4>silahkan daftar terlebih dahulu untuk bisa melakukan belanja</h4>
        <form action="{{ route('loginuser-process')}}" method="POST">
            @csrf
            <input type="text" name="username" class="form-control" placeholder="Nama Pengguna" />
            <table width="100%">
                <tr>
                    <td>
                         <input type="text" class="form-control" name="front_name" placeholder="Nama Depan">
                    </td>
                    <td>
                         <input type="text" class="form-control" name="front_name" placeholder="Nama Belakang">
                    </td>
                </tr>
            </table> 
            <span><b>Informasi Alamat Pengguna</b></span>
            <input type="text" name="accept_name" class="form-control" placeholder="Nama Penerima">
            <input type="text" name="no_hp" class="form-control" placeholder="No Telp Penerima">
            <input type="text" name="postal_code" class="form-control" placeholder="Kode Pos">
            <table width="100%">
                <tr>
                    <td>
                        <select name="province" class="form-control province">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($province->rajaongkir->results as $pv)
                                <option value="{{ $pv->province_id }}">{{ $pv->province }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="city" class="form-control city">
                            <option value="">Pilih Kota atau Kabupaten</option>
                        </select>
                    </td>
                </tr>
            </table>

            <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan">
            <textarea name="address" class="form-control" placeholder="Alamat" rows="5" style="margin-bottom:15px;"></textarea>
            <span><b>Kata Sandi</b></span>
            <table width="100%">
                <tr>
                    <td>
                        <input type="password" class="form-control" name="password" placeholder="Kata Sandi" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" class="form-control" name="password" placeholder="Konfirmasi Kata Sandi" />
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-default">Daftar</button>
        </form>
    </div><!--/login form--> 
<script>
    $('.city').attr('disabled', 'disabled');
    $('.province').on('change', function(){
        var pv = $(this).val();
        $('.city').attr('disabled', 'disabled');
        $.ajax({
            url: '{{ route("profile-view") }}',
            type: 'get',
            data:{
                province_id: pv
            }, 
            success: function(response){
                var obj = JSON.parse(response);
                $('.city_detail').remove();
                $.each(obj.city.rajaongkir.results, function(index, city){
                    $('.city').append('<option class="city_detail" value="'+city.city_id+'">'+city.city_name+'</option>');
                });
                $('.city').removeAttr('disabled');
            }
        });
    });
</script>
@endsection