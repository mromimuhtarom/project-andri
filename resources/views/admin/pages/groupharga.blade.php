@extends('admin.index')

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricegroup as $pg)
                        <tr>
                            <td>{{ $pg->name }}</td>
                            <td>{{ $pg->price }}</td>
                            <td>
                                <a href="#" class="btn-deletepayment" title="Hapus" data-pk="{{ $pg->price_group_id }}" data-toggle="modal" data-target="#deletepayment">
                                    <i class="fas fa-times" style="color:red"></i>
                                </a>
                            </td>
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
                <form method="POST" action="{{ route('Price-Group-create') }}">
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
 
    {{-- Modal delete --}}
    <div class="modal fade" id="deletepayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Tipe Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('Price-Group-delete') }}">
                    {{ method_field('delete')}}
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="pk-deletepayment" name="pk" value="">
                        Apakah anda yakin ingin menghapus data tersebut ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.btn-deletepayment').on('click', function(){
                var pk = $(this).attr('data-pk');
                $('#pk-deletepayment').val(pk);
            });

            $('#dataTable').DataTable({
                "bLengthChange": false,
                "searching": false
            });
        });
    </script>
@endsection