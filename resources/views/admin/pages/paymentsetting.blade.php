@extends('admin.index')

@section('content')
<link rel="stylesheet" href="/css/btn.css">
    <h1 class="mt-4">Pengaturan Pembayaran</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Pengaturan Pembayaran
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah Tipe Pembayaran
                        </button>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Tipe Pembayaran</th>
                            <th>No rekening</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymenttype as $pt)
                        <tr>
                            <td>{{ $pt->payment_name }}</td>
                            <td>{{ $pt->account_number }}</td>
                            <td><a href="#" class="btn-deletepayment" data-pk="{{ $pt->payment_id }}" data-toggle="modal" data-target="#deletepayment">
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
                <form method="POST" action="{{ route('Payment-Setting-create') }}">
                    @csrf
                    <div class="modal-body">
                        
                            <input type="text" class="form-control" name="payment_name" placeholder="Nama Tipe Pembayaran">
                            <input type="text" class="form-control" name="account_no" id="" placeholder="No. Rekening">
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
                <form method="POST" action="{{ route('Payment-Setting-delete') }}">
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