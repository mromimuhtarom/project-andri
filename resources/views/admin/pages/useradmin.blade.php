@extends('admin.index')

@section('content')
<h1 class="mt-4">Akun Admin</h1>
<div class="card mb-4">
    <div class="card-header">
        <table width="100%">
            <tr>
                <td>
                    <i class="fas fa-table mr-1"></i>
                    Akun Admin
                </td>
                <td align="right">
                    <form action="{{ route('User-Admin')}}">
                        <table>
                            <tr>
                                <td>
                                    <input type="text" name="username" class="form-control" placeholder="ID Pengguna / Nama Pengguna" value="{{ $username }}">
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pengguna</th>
                        <th>Nama Pengguna</th>
                        <th>Tipe Peran</th>
                        <th>Status</th>
                        <th>Detail Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $usr)
                        <tr>
                            <td>{{ $usr->user_id }}</td>
                            <td>{{ $usr->username }}</td>
                            <td>{{ $usr->role_name }}</td>
                            <td><a href="#" class="status" data-toggle="modal" data-pk="{{ $usr->user_id }}" data-value="{{ $usr->status }}" data-target="#editstatus">{{ endislbl($usr->status) }}</a></td>
                            <td><button class="btn-detail" data-toggle="modal" data-pk="{{ $usr->user_id }}" data-target="#detailInfo">Detail Info</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex;justify-content: center;">{{ $user->links('admin.pagination.default') }}</div>
        </div>
    </div>
</div> 

    {{-- Detail Info Akun Admin --}}
    <div class="modal fade" id="detailInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Info <span class="fullnamedetailinfo"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body det-info-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Status --}}
    <div class="modal fade" id="editstatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Status <span class="fullnamedetailinfo"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('useradmin-statusupdt') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" class="user_id" name="pk">
                    <select name="status" class="form-control status-edit">
                        <option value="">Pilih Status</option>
                        @foreach (endislbl('') as $index => $value)
                            <option value="{{ $index }}">{{ $value }}</option>
                        @endforeach
                        
                    </select><br>
                    <textarea name="catatan" class="form-control" id="" cols="30" rows="10" placeholder="Catatan"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
                

<script>
    $(document).ready(function() {
        $('.status').on('click', function(){
            var pk = $(this).attr('data-pk');
            var value = $(this).attr('data-value');

            $('.status-edit').val(value);
            $('.user_id').val(pk);
        });
        $('.btn-detail').on('click', function(){
            var user_id = $(this).attr('data-pk');
            $.ajax({
                url: '{{ route("detail-address") }}',
                type: 'post',
                data:{
                    user_id: user_id,
                    _token : "{{ csrf_token() }}"
                },
                success: function(response){
                    var obj = JSON.parse(response);
                    $('.addressdetail').remove();
                    $.each( obj.dataaddress, function(index, adrs ) {
                       $('.det-info-body').append('<table width="100%" class="addressdetail" border="1"><tr><td width="30%">Nama Penerima</td><td width="70%">'+adrs.accept_name+'</td></tr> <tr><td>Kode Pos</td><td>'+adrs.postal_code+'</td></tr><tr><td>telp</td><td>'+adrs.telp+'</td></tr><tr><td>Alamat</td><td>'+adrs.detail_address+','+adrs.city_name+','+adrs.province_name+'</td></tr></table><br class="addressdetail">');
                    });
                }
            });
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