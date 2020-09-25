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
                <form method="POST" action="{{ route('productcreate') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <table width="100%">
                                <tr>
                                    <td align="center">
                                        <div style="border-radius:10px;border:1px solid black;background-color:#cccccc;width:200px;height:100px;position: relative;display: inline-block;">
                                            <img src="/image/product/uploadimg.png" alt="" id="imginsert" max-width="100px" height="98px">
                                        </div><br>                                    
                                        <input type="file" name="file" id="btnimginsert" onchange="readURL(this);">
                                    </td>
                                </tr>
                            </table><br>
                            <div class="breadcrumb">
                            Catatan : <br>
                            - Untuk Group Harga Boleh di kosongin atau pun di isi<br>
                            - Untuk Variasi dan pilihan boleh di kosongin atau<br>
                            - Pilihan akan muncul jika variasi di isi <br>
                            - ketika sudah di isi nama variasi, maka wajib mengisi pilihan<br>
                            - ketika sudah di isi pilihan maka nama variasi tidak boleh kosong
                            </div>
                            *
                            <input type="text" class="form-control" name="product_name" id="" placeholder="Nama Barang"><br>
                            *
                            <input type="text" class="form-control" name="product_code" id="" placeholder="Kode Produk"><br>
                            *
                            <input type="number" class="form-control" name="product_weight" id="" placeholder="Berat Barang"><br>
                            *
                            <input type="number" class="form-control" name="stock_general" id="" placeholder="Stok Barang"><br>
                            <select class="form-control" name="price_group" id="test">
                                <option value="">Pilih Group Harga</option>
                                @foreach ($pricegroup as $pg)
                                <option value="{{$pg->price_group_id}}" data-price="{{$pg->price}}">{{ $pg->name }} ({{ $pg->price}})</option>
                                @endforeach
                            </select><br>
                            *
                            <input type="text" class="form-control" name="price_general" id="harga" placeholder="Harga"><br>

                            <span>Variasi</span>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="4">
                                            <input type="text" class="form-control" name="variation_name" placeholder="Nama Variasi" id="variation_name">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="textboxDiv">
                                    <tr>
                                        <td><input class="form-control" type="text" name="variation_stok[]" id="" placeholder="Stok"></td>
                                        <td><input class="form-control" type="text" name="pilihan[]" id="" placeholder="Nama pilihan"></td>
                                        <td><input class="form-control" type="text" name="Harga[]" id="" placeholder="Harga"></td>
                                        <td><a href="#" class="btn btn-secondary" id="Add">Tambah</a></td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <script>
                                $(document).ready(function() {  
                                    var i = 0;
                                    $('#textboxDiv').hide();  
                                    $("#Add").on("click", function() {  
                                        $("#textboxDiv").append('<tr class="variasipilihan'+i+'"><td><input class="form-control variasipilihan'+i+'" type="text" name="variation_stok[]" placeholder="Stok" required></td><td><input class="form-control variasipilihan'+i+'" type="text" name="pilihan[]" id="" placeholder="Nama Pilihan" required></td><td><input class="form-control variasipilihan'+i+'" type="text" name="Harga[]" id="" placeholder="Harga" required></td><td><a href="#" class="removepilihan btn btn-danger" id="variasipilihan'+i+'">Remove</a></td></tr>');  
                                        i++;
                                    });
                                    $("#textboxDiv").on("click", ".removepilihan", function() {
                                        var idrmvplh = $(this).attr('id');
                                        $('.'+idrmvplh).remove();
                                    }) 
                                    $('#test').change(function(){
                                        var a = $(this).find(':selected').data('price');
                                    });
                                    
                                    $("#variation_name").keyup(function(e) {
                                        e.preventDefault();
                                        var valvariationlength = $(this).val().length;

                                        if(valvariationlength < 1)
                                        {
                                            $('#textboxDiv').hide();                                         
                                        } else {
                                            $('#textboxDiv').show();
                                        }
                                    });
    
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