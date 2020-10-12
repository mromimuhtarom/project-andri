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
                            <td></td>
                            <td align="center">Barang</td>
							<td align="center">Aksi</td>
						</tr>
					</thead>
					<tbody>
                        @foreach ($storeorder as $so)
							<tr>
                                <td><img src="/image_user/product/{{ $so->picture }}" alt="" style="max-width:100px;max-height:100px;"></td>
                                <td>
                                    <table border="1">
                                        <tr>
                                            <td>
                                                {{ $so->product_name }} 
                                                @if($so->variation_detail_name)
                                                <br>
                                                <b>{{ $so->variation_name}}:{{ $so->variation_detail_name }}</b>
                                                @endif
                                            </td>
                                            <td>Ongkir: Rp. {{ number_format($so->ongkir, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:{{ $so->note }}</td>
                                            <td>{{ $so->delivery_id }}: {{ $so->service_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>Harga Per <br>item</td>
                                                        <td>: Rp. {{ number_format($so->price_product, 2) }}</td>
                                                    </tr>
                                                </table>
                                                
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>Total<br>Keseluruhan</td>
                                                        <td>:  Rp. {{ number_format($so->totalprice, 2) }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah:{{ $so->qty }}</td>
                                            <td>Bank: {{ $so->payment_name }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    @if(!$so->provementpic)
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal{{ $so->id }}">Mengirimkan Bukti Transfer</i></a>
                                    @else 
                                    <span style="color:green">Menunggu Persetujuan dari Penjual</span> 
                                    @endif
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
        @if(!$so->provementpic)
            <div class="modal fade" id="exampleModal{{ $so->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembelian Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{ route('approvepayment-create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $so->id }}">
                            <div>
                                <span>Maukkan Foto Bukti Transfer atau pembayaran</span>
                                <input type="file" name="file">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Mengirmkan</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        @endif
    @endforeach


@endsection