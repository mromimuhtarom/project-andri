@extends('admin.index')

@section('content')
<h1 class="mt-4">Kategori</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Kategori
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Kategori
                    </button>
                </div>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Category</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $ct)
                        <tr>
                            <td>{{ $ct->category_id }}</td>
                            <td><a href="#" class="usertext" data-name="category_name" data-pk="{{ $ct->category_id }}" data-type="text" data-url="{{ route('category-update') }}">{{ $ct->category_name }}</a></td>
                            <td><a href="#" class="delete-category" data-pk="{{ $ct->category_id }}" data-toggle="modal" data-target="#deletecategory"><i class="fas fa-times" style="color:red"></i></a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('category-create') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="category_name" class="form-control" placeholder="Nama Kategori">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        {{-- Modal Delete --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('category-delete') }}">
                        {{ method_field('delete')}}
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" class="pk-delete" name="pk" value="">
                            Apakah anda yakin ingin menghapusnya
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.delete-category').on('click', function(){
            var pk = $(this).attr('data-pk');
            $('.pk-delete').val(pk);
        });
        $('#dataTable').DataTable({
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('.usertext').editable({
                    mode :'inline',
                    validate: function(value) {
                        if($.trim(value) == '') {
                        return 'Tidak boleh kosong';
                        }
                    }
                });
            }
        });
    });
</script>
@endsection