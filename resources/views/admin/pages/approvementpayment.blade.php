@extends('admin.index')

@section('content')
<link rel="stylesheet" href="/css/btn.css">
    <h1 class="mt-4">Bukti Transfer</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active" style="width:100%">
            <table width="100%" height="auto" align="center">
                <tr>
                    <td width="10%"></td>
                    <td width="30%">
                        <input type="text" class="form-control" name="" id="" placeholder="Nama Pelanggan">
                    </td>
                    <td width="30%">
                        <select class="form-control" name="" id="">
                            <option value="">Pilih Status</option>
                            <option value="3">Tolak</option>
                            <option value="4">Selesai</option>
                        </select>
                    </td>
                    <td width="20%">
                        <button type="button" class="btn btn-primary">Cari</button>
                    </td>
                    <td width="10%"></td>
                </tr>
            </table>
        </li>
    </ol> --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Bukti Transfer Pelanggan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=id">ID Order <i class="fa fa-sort{{ iconsorting('id') }}"></i></a></th>
                            <th>Bukti Transfer</th>
                            <th>Gambar Produk</th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=user_id">Id Pelanggan <i class="fa fa-sort{{ iconsorting('user_id') }}"></i></a></th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=fullname">Nama Pelanggan <i class="fa fa-sort{{ iconsorting('fullname') }}"></i></a></th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=product_name">Nama Produk <i class="fa fa-sort{{ iconsorting('product_name') }}"></i></a></th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=qty">Jumlah <i class="fa fa-sort{{ iconsorting('qty') }}"></i></a></th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=totalpriceall">Total Harga <i class="fa fa-sort{{ iconsorting('totalpriceall') }}"></i></a></th>
                            <th>Detail Info</th>
                            <th>Status</th>
                            <th><a href="{{ route('Approvement-Payment') }}?sorting={{ $sorting }}&namecolumn=datetime">Tanggal Pembelian <i class="fa fa-sort{{ iconsorting('datetime') }}"></i></a></th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approve as $ap)
                            <tr>
                                <td>
                                    {{ $ap->id }}
                                </td>
                                <td>
                                    <a href="#" class="provementpayment" data-toggle="modal" data-target="#detail_image" data-url="/image/buktitransfer/{{ $user_id }}/{{ $ap->provementpic }}">
                                        <div  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                            <img src="/image/buktitransfer/{{ $user_id }}/{{ $ap->provementpic }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="productimg" data-toggle="modal" data-target="#detail_imageproduct" data-url="/image_user/product/{{ $ap->picture }}">
                                        <div  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                            <img src="/image_user/product/{{ $ap->picture }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $ap->user_id }}</td>
                                <td>{{ $ap->fullname }}</td>
                                <td>
                                    {{ $ap->product_name }} <br>
                                    @if ($ap->variation_name)
                                        <b>{{ $ap->variation_name }} : {{ $ap->variation_detail_name }}</b>
                                    @endif
                                </td>
                                <td>{{ $ap->qty }}</td>
                                <td>Rp. {{ number_format($ap->totalpriceall, 2) }}</td>
                                <td>
                                    <button class="btn btn-secondary detailinfo-btn" data-fullname="{{ $ap->fullname }}" data-acceptname="{{ $ap->accept_name }}" data-telp="{{ $ap->telp }}" data-ongkir="{{ $ap->ongkir }}" data-deliveryid="{{ $ap->delivery_id }}" data-servicename="{{ $ap->service_name }}" data-addressdetail="{{ $ap->detail_address }}" data-cityname="{{ $ap->city_name }}" data-province="{{ $ap->province_name }}" data-postalcode="{{ $ap->postal_code }}" data-toggle="modal" data-target="#detailInfo">Detail info</button>
                                </td>
                                <td>
                                    <span style="color:blue">{{ $ap->strStatus($ap->status) }}</span>
                                </td>
                                <td>{{ date('d F Y', strtotime($ap->datetime)) }}</td>
                                <td>
                                    <button class="btn btn-success approve-btn" data-pk="{{ $ap->id }}" data-toggle="modal" data-target="#accept"><i class="fas fa-check-circle"></i></button>
                                    <button class="btn btn-danger decline-btn" data-pk="{{ $ap->id }}" data-toggle="modal" data-target="#decline"><i class="fas fa-times-circle"></i></button>                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;">{{ $approve->links('admin.pagination.default') }}</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menerima Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approvement-accept') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="pk-approve" name="pk" value="">
                        Apakah anda ingin menerima Bukti Transfer ini
                        <input type="text" name="resi" class="form-control" placeholder="No. Resi" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Terima</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="decline" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menerima Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('approvement-decline')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="pk-decline" name="pk" value="">
                        <span>Apakah anda ingin menolak Bukti Transfer ini?</span>
                        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Alasan Menolak" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Menolak</button>
                    </div>
                </form>
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
            $('.approve-btn').on('click', function(){
                var pk =$(this).attr('data-pk');
                $('.pk-approve').val(pk);
            });

            $('.decline-btn').on('click', function(){
                var pk =$(this).attr('data-pk');
                $('.pk-decline').val(pk);
            });

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