@extends('user.template.default')

@section('content')
	<section id="cart_items">
		<div class="container">
			{{-- <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div> --}}
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                            <td align="center">Gambar</td>
							<td align="center">Nama Barang</td>
							<td class="description" align="center">Deskripsi</td>
							<td class="price" align="center">Harga</td>
                            <td class="quantity" align="center">Qty</td>
                            <td align="center">Ongkir</td>
                            <td align="center">Jenis Pengiriman</td>
                            <td class="total" align="center">Total</td>
                            <td align="center">Nama Bank</td>
							<td align="center">Aksi</td>
						</tr>
					</thead>
					<tbody>
                        @foreach ($storeorder as $so)
							<tr>
                                <td><img src="/image_user/product/{{ $so->picture }}" alt="" style="max-width:100px;max-height:100px;"></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>{{ $so->product_name }}</td>
                                        </tr>
                                        @if($so->variation_detail_name)
                                        <tr>
                                            <td><b> {{ $so->variation_name}}:{{ $so->variation_detail_name }}</b></td>
                                        </tr>
                                        @endif
                                    </table>
                                </td>
                                <td>{{ $so->note }}</td>
                                <td>Rp. {{ number_format($so->price_product, 2) }}</td>
                                <td>{{ $so->qty }}</td>
                                <td>Rp. {{ number_format($so->ongkir, 2) }}</td>
                                <td>{{ $so->delivery_id }}: {{ $so->service_name }}</td>
                                <td>Rp. {{ number_format($so->totalprice, 2) }}</td>
                                <td>{{ $so->payment_name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal{{ $so->id }}">Mengirimkan Bukti Transfer</i></a>
                                </td>
							</tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section> <!--/#cart_items-->
    <!-- Modal -->
    @foreach ($storeorder as $so)
        <div class="modal fade" id="exampleModal{{ $so->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembelian Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Mengirmkan</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    @endforeach


@endsection