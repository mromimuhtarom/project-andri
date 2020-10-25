@extends('admin.index')

@section('content')
<script>
    function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#imginsert').attr('src', e.target.result);
           };
           reader.readAsDataURL(input.files[0]);
       }
    }

    function readURLfavicon(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#imginsertfavicon').attr('src', e.target.result);
           };
           reader.readAsDataURL(input.files[0]);
       }
    }
</script>
<h1 class="mt-4">Pengaturan Web</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Pengaturan Web
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ubah Icon gambar Web</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#icongambar">Ubah</button></td>
                    </tr>
                    <tr>
                        <td>Ubah Gambar Favicon Icon</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#favicongambar">Ubah</button></td>
                    </tr>
                    <tr>
                        <td>Email untuk dihibungi</td>
                        <td><a href="#" class="usertext" data-name="value" data-pk="{{ $email->id }}" data-type="text" data-url="{{ route('generalsetting-update') }}">{{ $email->value }}</a></td>
                    </tr>
                    <tr>
                        <td>No. Telp untuk dihibungi</td>
                        <td><a href="#" class="usertext" data-name="value" data-pk="{{ $telp->id }}" data-type="number" data-url="{{ route('generalsetting-update') }}">{{ $telp->value }}</a></td>
                    </tr>
                    <tr>
                        <td>Judul Tab Web</td>
                        <td><a href="#" class="usertext" data-name="value" data-pk="{{ $judultab->id }}" data-type="text" data-url="{{ route('generalsetting-update') }}">{{ $judultab->value }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> 

    {{-- Modal Create --}}
    <div class="modal fade" id="icongambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Icon Gambar Web</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('generalsetting-icon') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <table width="100%">
                                <tr>
                                    <td align="center">
                                        <div style="border-radius:10px;border:1px solid black;background-color:#fff;width:243px;height:73px;position: relative;display: inline-block;">
                                            <img src="/store_user/images/home/logo.png" alt="" id="imginsert" width="239px" max-height="69px">
                                        </div><br>                                    
                                        <input type="file" name="file" id="btnimginsert" onchange="readURL(this);" required>
                                    </td>
                                </tr>
                            </table><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Modal edit favicon --}}
    <div class="modal fade" id="favicongambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Favicon Gambar Web</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('generalsetting-favicon') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <table width="100%">
                                <tr>
                                    <td align="center">
                                        <div style="border-radius:10px;border:1px solid black;background-color:#fff;width:243px;height:243px;position: relative;display: inline-block;">
                                            <img src="/store_user/images/home/favicon.png" alt="" id="imginsertfavicon" width="239px" max-height="239px">
                                        </div><br>                                    
                                        <input type="file" name="file" id="btnimginsert" onchange="readURLfavicon(this);" required>
                                    </td>
                                </tr>
                            </table><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
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