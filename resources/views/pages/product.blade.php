@extends('index')

@section('content')
<link rel="stylesheet" href="/css/btn.css">
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
</script>
    <h1 class="mt-4">Produk</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Produk
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Produk
                    </button>
                </div>
            </div>
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
                <form action="th.php">
                    @csrf
                    <div class="modal-body">
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
                                @foreach ($pricegroup as $pg)
                                <option value="{{$pg->price_group_id}}">{{ $pg->name }} ({{ $pg->price}})</option>
                                @endforeach
                            </select><br>
                            <input type="text" class="form-control" name="" id="" placeholder="Harga"><br>
                            
                            <span>Variasi</span>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="4">
                                            <input type="text" class="form-control" name="variation_name" placeholder="Nama Variasi" id="">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="textboxDiv">
                                    <tr>
                                        <td><input class="form-control" type="text" name="variation_stok" id="" placeholder="Stok" required></td>
                                        <td><input class="form-control" type="text" name="pilihan" id="" placeholder="Nama pilihan" required></td>
                                        <td><input class="form-control" type="text" name="Harga" id="" placeholder="Harga" required></td>
                                        <td><a href="#" class="btn btn-secondary" id="Add">Tambah</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {  
                                    var i = 0;
                                    $("#Add").on("click", function() {  
                                        $("#textboxDiv").append('<tr class="variasipilihan'+i+'"><td><input class="form-control variasipilihan'+i+'" type="text" name="variation_stok" placeholder="Stok" required></td><td><input class="form-control variasipilihan'+i+'" type="text" name="pilihan" id="" placeholder="Nama Pilihan" required></td><td><input class="form-control variasipilihan'+i+'" type="text" name="Harga" id="" placeholder="Harga" required></td><td><a href="#" class="removepilihan btn btn-danger" id="variasipilihan'+i+'">Remove</a></td></tr>');  
                                        i++;
                                    });
                                    $("#textboxDiv").on("click", ".removepilihan", function() {
                                        var idrmvplh = $(this).attr('id');
                                        $('.'+idrmvplh).remove();
                                    }) 
    
                                }); 
                            </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "bLengthChange": false
            });
        });
    </script>
@endsection