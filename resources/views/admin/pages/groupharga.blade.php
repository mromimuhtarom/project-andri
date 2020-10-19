@extends('index')

@section('content')
<link rel="stylesheet" href="/css/btn.css">
    <h1 class="mt-4">Pengaturan Group Harga</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Pengaturan Group Harga
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah Group Harga
                        </button>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Group</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricegroup as $pg)
                        <tr>
                            <td>{{ $pg->name }}</td>
                            <td>{{ $pg->price }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('gouphargabarangpengaturan-create') }}">
                    @csrf
                    <div class="modal-body">
                        
                            <input type="text" class="form-control" name="name" placeholder="Nama Group Harga">
                            <input type="text" class="form-control" name="harga" id="" placeholder="Harga">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "bLengthChange": false,
                "searching": false
            });
        });
    </script>
@endsection