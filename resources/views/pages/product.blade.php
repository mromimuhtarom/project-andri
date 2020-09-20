@extends('index')

@section('content')
    <h1 class="mt-4">Produk</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Produk
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kode Produk</th>
                            <th>Berat</th>
                            <th>Group Harga</th>
                            <th>Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $pd)
                        <tr>
                            <td></td>
                            <td>{{ $pd->product_name }}</td>
                            <td>{{ $pd->product_id }}</td>
                            <td>{{ $pd->weight }}</td>
                            <td>{{ $pd->pricegroup()->name }}</td>
                            <td>
                                @foreach ($pd->variation() as $vr)
                                    {{ $vr->variation_name}}: {{ $vr->qty }},
                                @endforeach
                            </td>
                            <td>{{ $vr->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection