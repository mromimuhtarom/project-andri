@extends('index')

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
                            <th>Nama Pelanggan</th>
                            <th>Nama Produk</th>
                            <th>Kode Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Detail Info</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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
                <div class="modal-body">
                    <form action="">
                        <table width="100%">
                            <tr>
                                <td align="center">
                                    <div style="border-radius:10px;border:1px solid black;background-color:#cccccc;width:200px;height:100px;position: relative;display: inline-block;">
                                        <img src="/image/product/uploadimg.png" alt="" id="imginsert" max-width="100px" height="98px">
                                    </div><br>                                    
                                    <input type="file" name="" id="btnimginsert" onchange="readURL(this);">
                                </td>
                            </tr>
                        </table><br>
                        <input type="text" class="form-control" name="" id="" placeholder="Nama Barang"><br>
                        <input type="text" class="form-control" name="" id="" placeholder="Kode Produk"><br>
                        <input type="number" class="form-control" name="" id="" placeholder="Berat Barang"><br>
                        <input type="number" class="form-control" name="" id="" placeholder="Stok Barang"><br>
                        <select class="form-control" name="" id="">
                            <option value="">Pilih Group Harga</option>
                        </select><br>
                        <input type="text" class="form-control" name="" id="" placeholder="Harga">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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