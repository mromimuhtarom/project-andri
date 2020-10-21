@extends('user.template.template-w-background')

@section('content')
<link rel="stylesheet" href="/store_user/css/login.css">
    <div class="login-form"><!--login form-->
        <h2>Selamat datang</h2>
        <div class="changebtn">
        </div>
        <h4>Profile Anda</h4>
        <form action="{{ route('profile-updateuser')}}" method="POST">
            @csrf
            <div id="username">
                <span id="username-txt" data-value="{{ $profile->username }}">Nama Pengguna : {{ $profile->username }}</span>
            </div>
            <div id="fullname">
                <span id="fullname-txt" data-value="{{ $profile->fullname }}">Nama lengkap :{{ $profile->fullname }}</span>
            </div>


            <div class="btn-edit-profilediv">

            </div>
           
        </form>
        <div class="pwd-form">

        </div>
        <h4>Alamat</h4>
        <div class="btn-add-addressdiv">

        </div>
        <div class="address_group">
            <form action="">
                @foreach ($profile->address as $ads)
                    <hr style="border:1px solid black">
                    <table width="100%" border="0" class="textboxmany">
                        <tr>
                            <td width="20%">Nama Penerima</td>
                            <td width="2%">:</td>
                            <td width="68%" id="accept_namecol">
                                {{ $ads->accept_name }}                             
                            </td>
                            <td width="10%">
                                @if($ads->status == 2)
                                <a href="#" class="btn-success" style="color:white">Utama</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td>:</td>
                            <td>
                                {{-- <a href=""></a> --}}
                                    @foreach ($province->rajaongkir->results as $pv)
                                        @if($pv->province_id == $ads->province_id)
                                            {{$pv->province}}
                                            @php 
                                                $prnc = $pv->province;
                                                $prnc_id = $pv->province_id;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if($ads->city_id)
                                        @foreach ($city->rajaongkir->results as $ct)
                                            @if($ct->city_id == $ads->city_id)
                                                @php 
                                                    $cty = $ct->city_name;
                                                    $cty_id = $ct->city_id;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                            </td>
                            <td width="10%" class="btn-action-address{{$ads->address_id}}">
                          
                            </td>
                        </tr>
                        <tr>
                            <td>Kota / Kabupaten</td>
                            <td>:</td>
                            <td colspan="2">
                                {{$cty}}
                            </td>
                        </tr>
                        <tr>
                            <td>Kode Pos</td>
                            <td>:</td>
                            <td colspan="2">
                                {{ $ads->postal_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>Detail Alamat</td>
                            <td>:</td>
                            <td colspan="2">
                                {{ $ads->detail_address }}
                            </td>
                        </tr>   
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td colspan="2">
                                {{ $ads->telp }}
                            </td>
                        </tr>       
                    </table>
                    <hr style="border:1px solid black">
                    <script>
                        $('.changebtn').on('click', '.edit-form', function(){
                            $('.btn-action-address{{$ads->address_id}}').append('<a href="#" class="edit-address" data-toggle="modal" data-target="#editaddress">Ubah</a> <a href="#" class="hapus-address" data-id="{{ $ads->address_id}}">Hapus</a>');
                        });
                        $('.btn-action-address{{$ads->address_id}}').on('click', '.edit-address', function(){
                            var id_address = '{{$ads->address_id}}';
                            var province_id ='{{ $prnc_id }}';
                            var detailaddrs = '{{ $ads->detail_address }}';
                            var postal_code = '{{ $ads->postal_code }}';
                            var cityname = '{{ $cty }}';
                            var city_id = '{{ $cty_id }}';
                            var accept_nm = '{{ $ads->accept_name }}';
                            var telp = '{{ $ads->telp }}';
                            var statusadd = '{{ $ads->status }}'
                            $('.city-edit').attr('disabled', 'disabled');
                            $('#accept_name-edit').val(accept_nm);
                            if(statusadd == 2){
                                $('.utama').html('<span style="color:green">Alamat Utama</span>')
                            } else {
                                $('.utama').html('Dijadikan alamat Utama <br><input type="radio" id="ya" name="utama" value="2"><label for="ya">Ya</label> <input type="radio" id="tidak" name="utama" value="1" checked><label for="tidak">Tidak</label>');
                            }
                            $('#postal_code-edit').val(postal_code);
                            $('#province-edit').val(province_id);
                            $('#address_id-edit').val(id_address);
                            $('#telp-edit').val(telp);
                            $('#address-edit').val(detailaddrs);
                            if(city_id) {
                                $.ajax({
                                    url: '{{ route("profile-view") }}',
                                    type: 'get',
                                    data:{
                                        _token: "{{ csrf_token() }}",
                                        province_id: province_id,
                                    },
                                    success: function(response){
                                        //add response in modal body
                                        var obj = JSON.parse(response);
                                        $('.city_detail-edit').remove();
                                        $.each( obj.city.rajaongkir.results, function(index, city ) {
                                            if(city_id == city.city_id){
                                                $('.city-edit').append('<option class="city_detail-edit" selected value="'+city.city_id+'">'+city.city_name+'</option>')
                                            } else {
                                                $('.city-edit').append('<option class="city_detail-edit" value="'+city.city_id+'">'+city.city_name+'</option>');
                                            }
                                        });
                                        $('.city-edit').removeAttr('disabled');
                                    
                                        
                                    }
                                });
                            }
                        });

                        $('.changebtn').on('click', '.cancel-form', function(){
                            $('.edit-address').remove();
                            $('.hapus-address').remove();
                        });
                    </script>
                @endforeach
                <div class="btn-form-address">

                </div>
            </form>
        </div>

    </div>

        {{-- Modal Create --}}
        <div class="modal fade" id="tambahaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('profile-createaddress') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="accept_name" class="form-control" placeholder="Nama Penerima" required>
                            <input type="text" name="postal_code" class="form-control" placeholder="Kode Pos" required>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <select name="province" id="province-add" class="province-add form-control" required>
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($province->rajaongkir->results as $pv)
                                                <option value="{{ $pv->province_id }}">{{ $pv->province}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="city" id="city-add" class="city-add form-control" required>
                                            <option value="">Pilih Kota /Kabupaten</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="number" name="telp" class="form-control" placeholder="No Hp" required>
                            <textarea name="detail_address" class="form-control" placeholder="Detail Alamat(Jangan lupa di masukkan kecamatan) contoh format: alamat detail, kecamatan" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Modal Update --}}
        <div class="modal fade" id="editaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Alamat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('profile-updaddress') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="address_id" class="address_id-edit" id="address_id-edit">
                            <input type="text" name="accept_name" id="accept_name-edit" class="form-control" placeholder="Nama Penerima">
                            <input type="text" name="postal_code" id="postal_code-edit" class="form-control" placeholder="Kode Pos">
                            <div class="utama">
                            </div>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <select name="province" id="province-edit" class="province-edit form-control">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($province->rajaongkir->results as $pv)
                                                <option value="{{ $pv->province_id }}">{{ $pv->province}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="city" id="city-edit" class="city-edit form-control">
                                            <option value="">Pilih Kota /Kabupaten</option>
                                            {{-- @foreach ($province->rajaongkir->results as $pv)
                                                <option value="{{ $ct->city_id }}">{{ $ct->city_name}}</option>
                                            @endforeach --}}
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="number" name="telp" id="telp-edit" class="form-control" placeholder="No Hp">
                            <textarea name="detail_address" id="address-edit" class="form-control" placeholder="Detail Alamat" cols="30" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.txt-xeditable').editable({
            mode :'inline',
            validate: function(value) {
                if($.trim(value) == '') {
                return 'This field is required';
                }
            }
        });

        $('.changebtn').append('<button type="submit" class="btn btn-primary edit-form">Ubah</button>');
        $('.city').attr('disabled', 'disabled');



        $('.changebtn').on('click', '.edit-form', function(){
            $(this).remove();

            // --- Untuk profile username dan fullname --- //
            var username = $('#username-txt').attr('data-value');
            var fullname = $('#fullname-txt').attr('data-value');
            $('#username-txt').remove();
            $('#fullname-txt').remove();
            $('#username').append('<input type="text" name="username" id="username-txt" data-value="'+username+'" placeholder="Nama Pengguna" value="'+username+'" />');
            $('#fullname').append('<input type="text" name="fullname" id="fullname-txt" data-value="'+fullname+'" placeholder="Nama Lengkap" value="'+fullname+'">');


            // --- Untuk aksi --- //


            var city = $('.city').val();
            $('.btn-add-addressdiv').append('<button type="submit" class="btn btn-primary btn-add-address" data-toggle="modal" data-target="#tambahaddress">Tambah Alamat</button>');
            $('.changebtn').append('<button type="submit" class="btn btn-danger cancel-form">Batal</button>');
            if(city){
                console.log('dfdg');
                $('.city').removeAttr('disabled');
            } else {
                console.log(city);
                $('.city').attr('disabled', 'disabled');
            }
            $('.pwd-form').append('<form action="{{ route("profile-updatepwd")}}" method="post" class="pwd">@csrf<table width="100%"><tr><td><h4>Ubah Kata Sandi</h4></td></tr><tr><td><input type="password" name="newpassword" id="password" placeholder="Kata Sandi Baru" /></td></tr><tr><td><input type="password" name="confirmpassword" id="confirm_pwd" placeholder="Konfirmasi Kata Sandi Baru" /></td></tr><tr><td><button type="submit" class="btn btn-primary edit-form">Ubah Kata Sandi</button></td></tr></table></form>');
            $('.btn-edit-profilediv').append('<button type="submit" class="btn btn-primary btn-edit-profile">Ubah Profile</button>');
        });


        $('.changebtn').on('click', '.cancel-form', function(){
            $(this).remove();
            $('.btn-edit-profile').remove();
            $('.btn-add-address').remove();
            $('.pwd').remove();
            $('.changebtn').append('<button type="submit" class="btn btn-primary edit-form">Ubah</button>');
            var username = $('#username-txt').attr('data-value');
            var fullname = $('#fullname-txt').attr('data-value');
            $('#username-txt').remove();
            $('#fullname-txt').remove();
            $('#username').append('<span id="username-txt" data-value="'+username+'">Nama Pengguna : '+username+'</span>');
            $('#fullname').append('<span id="fullname-txt" data-value="'+fullname+'">Nama lengkap : '+fullname+'</span>');
            $.ajax({
                url: '{{ route("profile-view") }}',
                type: 'get',
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    var obj = JSON.parse(response);
                    $('#username').val(obj.data.username);
                    $('#fullname').val(obj.data.fullname);
                    $('#nohp').val(obj.data.telp);
                    $('#province').val(obj.data.province_id);
                    $('#city').val(obj.data.city_id);
                    $('#detail_address').val(obj.data.detail_address);              
                    
                }
            });
        });

        $('.province-add').on('click', function(){
            var pv = $(this).val();
            $('.city-add').attr('disabled', 'disabled');

            if(pv){
                $.ajax({
                    url: '{{ route("profile-view") }}',
                    type: 'get',
                    data:{
                        _token: "{{ csrf_token() }}",
                        province_id: pv
                    },
                    success: function(response){
                        //add response in modal body
                        var obj = JSON.parse(response);
                        $('.city_detail').remove();
                        $.each( obj.city.rajaongkir.results, function(index, city ) {
                            $('.city-add').append('<option class="city_detail" value="'+city.city_id+'">'+city.city_name+'</option>')
                        });
                        $('.city-add').removeAttr('disabled');
                    
                        
                    }
                });
            } else {
                $('.city_detail').remove();
                $('.city-add').attr('disabled', 'disabled');
            }
        });
        
        $('.province-edit').on('click', function(){
            var pv = $(this).val();
            $('.city-edit').attr('disabled', 'disabled');

            if(pv){
                $.ajax({
                    url: '{{ route("profile-view") }}',
                    type: 'get',
                    data:{
                        _token: "{{ csrf_token() }}",
                        province_id: pv
                    },
                    success: function(response){
                        //add response in modal body
                        var obj = JSON.parse(response);
                        $('.city_detail-edit').remove();
                        $.each( obj.city.rajaongkir.results, function(index, city ) {
                            $('.city-edit').append('<option class="city_detail-edit" value="'+city.city_id+'">'+city.city_name+'</option>')
                        });
                        $('.city-edit').removeAttr('disabled');
                    
                        
                    }
                });
            } else {
                $('.city_detail').remove();
                $('.city').attr('disabled', 'disabled');
            }
        });

        $('.province').on('click', function(){
            var pv = $(this).val();
            $('.city').attr('disabled', 'disabled');

            if(pv){
                $.ajax({
                    url: '{{ route("profile-view") }}',
                    type: 'get',
                    data:{
                        _token: "{{ csrf_token() }}",
                        province_id: pv
                    },
                    success: function(response){
                        //add response in modal body
                        var obj = JSON.parse(response);
                        $('.city_detail').remove();
                        $.each( obj.city.rajaongkir.results, function(index, city ) {
                            $('.city').append('<option class="city_detail" value="'+city.city_id+'">'+city.city_name+'</option>')
                        });
                        $('.city').removeAttr('disabled');
                    
                        
                    }
                });
            } else {
                $('.city_detail').remove();
                $('.city').attr('disabled', 'disabled');
            }
        });
    });
</script>

@endsection