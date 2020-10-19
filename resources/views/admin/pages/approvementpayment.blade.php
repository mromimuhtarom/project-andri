@extends('admin.index')

@section('content')
<link rel="stylesheet" href="/css/btn.css">
    <h1 class="mt-4">Pesanan</h1>
    <ol class="breadcrumb mb-4">
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
                            <th>ID Order</th>
                            <th>Bukti Transfer</th>
                            <th>Id Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Detail Info</th>
                            <th>Status</th>
                            <th>Tanggal Pembelian</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approve as $ap)
                            <tr>
                                <td>
                                    {{ $ap->id }}
                                </td>
                                <td>
                                    <div  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                        <img src="/image/buktitransfer/{{ $user_id }}/{{ $ap->provementpic }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                    </div>
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
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#detailInfo{{ $ap->id }}">Detail info</button>
                                </td>
                                <td>
                                    <span style="color:blue">{{ $ap->strStatus($ap->status) }}</span>
                                </td>
                                <td>{{ date('d F Y', strtotime($ap->datetime)) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex;justify-content: center;">{{ $approve->links('admin.pagination.default') }}</div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    @foreach ($approve as $ap)
        <div class="modal fade" id="detailInfo{{ $ap->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Info {{ $ap->fullname }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span>Nama Penerima</span><br>
                        <input class="form-control" type="text" value="{{ $ap->accept_name }}" disabled><br>
                        <span>No Telp.</span><br>
                        <input type="text" class="form-control" value="{{ $ap->telp }}" disabled>
                        <span>Ongkir</span><br>
                        <input class="form-control" type="text" value="Rp. {{ number_format($ap->ongkir, 2) }}" disabled><br>
                        <span>Jenis Pengiriman</span><br>
                        <input class="form-control" type="text" value="{{ $ap->delivery_id }}" disabled><br>
                        <span>Nama Layanan</span><br>
                        <input class="form-control" type="text" value="{{ $ap->service_name }}" disabled><br>
                        <span>Alamat</span><br>
                        <textarea class="form-control" disabled>{{ $ap->detail_address }}, {{ $ap->city_name }}, {{ $ap->province_name }}, Kode Pos: {{ $ap->postal_code }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        $(document).ready(function() {
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