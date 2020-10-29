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
		
		<section id="form"><!--form-->
			<div class="container">
				<div class="row">
					<div class="col col-sm-offset-1">
                        <link rel="stylesheet" href="/store_user/css/login.css">
                        <style>
                            .form-control{
                                background-color:#ffff !important;
                            }
                        </style>

                        <div class="login-form"><!--login form-->
                            <h2>Selamat datang</h2>
                            <h4>silahkan isi alamat lengkap anda supaya bisa melakukan hal selanjutnya</h4>
                            <form action="{{ route('registerAddress-create')}}" method="POST">
                                @csrf
                                <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap" required>
                                <input type="text" name="accept_name" class="form-control" placeholder="Nama Penerima" required>
                                <input type="text" name="no_hp" class="form-control" placeholder="No Telp Penerima" required>
                                <input type="text" name="postal_code" class="form-control" placeholder="Kode Pos" required>
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <select name="province" class="form-control province" required>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($province->rajaongkir->results as $pv)
                                                    <option value="{{ $pv->province_id }}">{{ $pv->province }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="city" class="form-control city" required>
                                                <option value="">Pilih Kota atau Kabupaten</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>

                                <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan">
                                <textarea name="address" class="form-control" placeholder="Alamat" rows="5" style="margin-bottom:15px;"></textarea>
                                <button type="submit" class="btn btn-disabled" style="background-color:blue">Simpan Alamat</button>
                            </form>
                        </div><!--/login form--> 

                        <script>
                            $('.city').attr('disabled', 'disabled');
                            $('.btn-disabled').attr('disabled', 'disabled');
                            $('.province').on('change', function(){
                                var pv = $(this).val();
                                $('.city').attr('disabled', 'disabled');
                                $('.btn-disabled').attr('disabled', 'disabled');
                                $.ajax({
                                    url: '{{ route("city-view") }}',
                                    type: 'get',
                                    data:{
                                        _token: "{{ csrf_token() }}",
                                        province_id: pv
                                    }, 
                                    success: function(response){
                                        var obj = JSON.parse(response);
                                        $('.city_detail').remove();
                                        $.each(obj.city.rajaongkir.results, function(index, city){
                                            $('.city').append('<option class="city_detail" value="'+city.city_id+'">'+city.city_name+'</option>');
                                        });
                                        $('.city').removeAttr('disabled');
                                        $('.btn-disabled').removeAttr('disabled');
                                    }
                                });
                            });
                        </script>
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