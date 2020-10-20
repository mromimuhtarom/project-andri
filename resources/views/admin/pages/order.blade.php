@extends('admin.index')

@section('content')
@php 
setlocale(LC_TIME, 'id_ID.utf8');
@endphp
<link rel="stylesheet" href="/css/btn.css">
    <h1 class="mt-4">Pesanan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active" style="width:100%">
            <form action="{{ route('order-search')}}">
                <table align="center">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="order_id" id="" placeholder="ID Order" value="{{ $orderid }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="username" id="" placeholder="Nama Pengguna Pelanggan atau ID Pelanggan" value="{{ $username }}">
                        </td>
                        <td>
                            <select class="form-control" name="status" id="">
                                <option value="">Pilih Status</option>
                                <option value="1"@if($status == 1) selected @endif>Menunggu</option>
                                <option value="2"@if($status == 2) selected @endif>Terima</option>
                                <option value="3"@if($status == 3) selected @endif>Mengirimkan</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </td>
                    </tr>
                </table>
            </form>
        </li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Pesanan Pelanggan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=id">ID Order <i class="fa fa-sort{{ iconsorting('id') }}"></i></a></th>
                            <th>Bukti Transfer</th>
                            <th>Gambar Produk</th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=user_id">Id Pelanggan <i class="fa fa-sort{{ iconsorting('user_id') }}"></i></a></th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=username">Nama Pengguna Pelanggan <i class="fa fa-sort{{ iconsorting('username') }}"></i></a></th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=fullname">Nama lengkap Pelanggan <i class="fa fa-sort{{ iconsorting('fullname') }}"></i></a></th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=product_name">Nama Produk <i class="fa fa-sort{{ iconsorting('product_name') }}"></i></a></th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=qty">Jumlah <i class="fa fa-sort{{ iconsorting('qty') }}"></i></a></th>
                            <th><a href="{{ route($route) }}?sorting={{ $sorting }}&namecolumn=totalpriceall">Total Harga <i class="fa fa-sort{{ iconsorting('totalpriceall') }}"></i></a></th>
                            <th>Detail Info</th>
                            <th>Status</th>
                            <th><a href="{{ route('order') }}?sorting={{ $sorting }}&namecolumn=datetime">Tanggal Pembelian <i class="fa fa-sort{{ iconsorting('datetime') }}"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $od)
                        
                            <tr>
                                <td>
                                    {{ $od->id }}
                                </td>
                                <td>
                                    <a href="#" class="provementpayment" data-toggle="modal" data-target="#detail_image" data-url="/image/buktitransfer/{{ $user_id }}/{{ $od->provementpic }}">
                                        <div  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                            <img src="/image/buktitransfer/{{ $user_id }}/{{ $od->provementpic }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="productimg" data-toggle="modal" data-target="#detail_imageproduct" data-url="/image_user/product/{{ $od->picture }}">
                                        <div  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                            <img src="/image_user/product/{{ $od->picture }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $od->user_id }}</td>
                                <td>{{ $od->username}}</td>
                                <td>{{ $od->fullname }}</td>
                                <td>
                                    {{ $od->product_name }} <br>
                                    @if ($od->variation_name)
                                        <b>{{ $od->variation_name }} : {{ $od->variation_detail_name }}</b>
                                    @endif
                                </td>
                                <td>{{ $od->qty }}</td>
                                <td>Rp. {{ number_format($od->totalpriceall, 2) }}</td>
                                <td>
                                    <button class="btn btn-secondary detailinfo-btn" data-fullname="{{ $od->fullname }}" data-acceptname="{{ $od->accept_name }}" data-telp="{{ $od->telp }}" data-ongkir="{{ $od->ongkir }}" data-deliveryid="{{ $od->delivery_id }}" data-servicename="{{ $od->service_name }}" data-addressdetail="{{ $od->detail_address }}" data-cityname="{{ $od->city_name }}" data-province="{{ $od->province_name }}" data-postalcode="{{ $od->postal_code }}" data-toggle="modal" data-target="#detailInfo">Detail info</button>
                                </td>
                                <td>
                                    <span style="color:blue">{{ $od->strStatus($od->status) }}</span>
                                </td>
                                <td>{{ date('d F Y', strtotime($od->datetime)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;">{{ $order->links('admin.pagination.default') }}</div>
            </div>
        </div>
    </div>


        {{-- Detail Gambar Bukti Transfer --}}
        <div class="modal fade" id="detail_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Bukti Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="provementpicdet" width="100%" height="auto" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Gambar Produk dibeli --}}
        <div class="modal fade" id="detail_imageproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="productdetimg" width="100%" height="auto" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>


    {{-- Detail Info Pesanan Pelanggan --}}
    <div class="modal fade" id="detailInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Info <span class="fullnamedetailinfo"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <span>Nama Penerima</span><br>
                        <input class="form-control acceptname" type="text" value=""" disabled><br>
                        <span>No Telp.</span><br>
                        <input type="text" class="form-control telp" value="" disabled>
                        <span>Ongkir</span><br>
                        <input class="form-control ongkir" type="text" value="" disabled><br>
                        <span>Jenis Pengiriman</span><br>
                        <input class="form-control deliveryid" type="text" value="" disabled><br>
                        <span>Nama Layanan</span><br>
                        <input class="form-control servicename" type="text" value="" disabled><br>
                        <span>Alamat</span><br>
                        <textarea class="form-control address" disabled></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.provementpayment').on('click', function(){
                var urlimg = $(this).attr('data-url');
                $('.provementpicdet').attr('src', urlimg);
            });

            $('.productimg').on('click', function(){
                var urlimg = $(this).attr('data-url');
                $('.productdetimg').attr('src', urlimg);
            });
            $('.detailinfo-btn').on('click', function(){
                var accept_name   = $(this).attr('data-acceptname');
                var telp          = $(this).attr('data-telp');
                var ongkir        = $(this).attr('data-ongkir');
                var deliveryid    = $(this).attr('data-deliveryid');
                var servicename   = $(this).attr('data-servicename');
                var addressdetail = $(this).attr('data-addressdetail');
                var cityname      = $(this).attr('data-cityname');
                var province      = $(this).attr('data-province');
                var postalcode    = $(this).attr('data-postalcode');
                var fullname      = $(this).attr('data-fullname');
                $('.fullnamedetailinfo').html(fullname)
                $('.acceptname').val(accept_name);
                $('.telp').val(telp);
                $('.ongkir').val('Rp. '+ongkir);
                $('.deliveryid').val(deliveryid);
                $('.servicename').val(servicename);
                $('.address').val(addressdetail+','+cityname+','+province+', Kode Pos :'+postalcode);
            });
            $('#dataTable').DataTable({
                "bLengthChange": false,
                "searching": false,
                "paging":false,
                "bInfo":false,
                "ordering": false
            });
        });
    </script>
@endsection