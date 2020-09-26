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

    function readURLeditimg(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#imgedit').attr('src', e.target.result);
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
                            <td align="center" class="kolomeditgambar{{ $pd->product_id}}">
                                <div class="gambarbelumedit{{ $pd->product_id}}"  style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;">
                                    <img class="gambarbelumedit{{ $pd->product_id}}" src="/image_user/product/{{ $pd->picture }}" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;magin-top:auto;margin-bottom:auto;">
                                </div>
                                <br class="gambarbelumedit{{ $pd->product_id}}">
                                <a href="#" class="btn btn-primary ubahgambar{{ $pd->product_id}}">Ubah Gambar</a>                                
                            </td>
                            <td>{{ $pd->product_name }}</td>
                            <td>{{ $pd->product_id }}</td>
                            <td>{{ $pd->weight }}</td>
                            <td>{{ $pd->pricegroup->name }}</td>
                            <td>
                                @foreach ($pd->variation_detail as $vr)
                                    {{ $vr->name_detail_variation}}: {{ $vr->qty }},
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
                                        <input type="file" name="file" id="btnimginsert" onchange="readURL(this);" required>
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
                                        <td><input class="form-control stok_pilihan" type="text" name="variation_stok[]" id="" placeholder="Stok"></td>
                                        <td><input class="form-control nama_pilihan" type="text" name="pilihan[]" id="" placeholder="Nama pilihan"></td>
                                        <td><input class="form-control harga_pilihan" type="text" name="Harga[]" id="" placeholder="Harga"></td>
                                        <td><a href="#" class="btn btn-secondary" id="Add">Tambah</a></td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <script>
                                $(document).ready(function() {  
                                    var i = 0;
 
                                    $("#editgambar").attr('disabled', 'disabled');
                                    $("#Add").on("click", function() {  
                                        $("#textboxDiv").append('<tr class="variasipilihan'+i+'"><td><input class="form-control stok_pilihan variasipilihan'+i+'" type="text" name="variation_stok[]" placeholder="Stok" required></td><td><input class="form-control nama_pilihan variasipilihan'+i+'" type="text" name="pilihan[]" id="" placeholder="Nama Pilihan" required></td><td><input class="form-control harga_pilihan variasipilihan'+i+'" type="text" name="Harga[]" id="" placeholder="Harga" required></td><td><a href="#" class="removepilihan btn btn-danger" id="variasipilihan'+i+'">Remove</a></td></tr>');  
                                        i++;
                                    });
                                    $("#textboxDiv").on("click", ".removepilihan", function() {
                                        var idrmvplh = $(this).attr('id');
                                        $('.'+idrmvplh).remove();
                                    }) 
                                    $('#test').change(function(){
                                        var groupprice = $(this).find(':selected').data('price');
                                        $('#harga').val(groupprice);
                                        $('.harga_pilihan').val(groupprice);

                                    });
                                    
                                    $("#variation_name").keyup(function(e) {
                                        e.preventDefault();
                                        var valvariationlength = $(this).val().length;

                                        if(valvariationlength < 1)
                                        {
                                            $('#textboxDiv').hide();
                                            $('.stok_pilihan').attr('disabled', 'disabled');   
                                            $('.nama_pilihan').attr('disabled', 'disabled');   
                                            $('.harga_pilihan').attr('disabled', 'disabled');                                         
                                        } else {
                                            $('#textboxDiv').show();
                                            $('.stok_pilihan').removeAttr('disabled');   
                                            $('.nama_pilihan').removeAttr('disabled');   
                                            $('.harga_pilihan').removeAttr('disabled');  
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
            @foreach($product as $pd)
            $(".ubahgambar{{ $pd->product_id}}").on("click", function() {
                $(this).hide();
                $(".gambarbelumedit{{ $pd->product_id}}").css("display", "none");
                $(".kolomeditgambar{{ $pd->product_id}}").append('<form action="{{ route("productimage-update") }}" enctype="multipart/form-data" class="editgambar{{ $pd->product_id}}">@csrf<div style="border-radius:5px;border:1px solid black;position: relative;display: inline-block;width:200px;height:100px;"><img src="/image_user/product/{{ $pd->picture }}" id="imgedit" alt="" style="display: block;max-width:190px;max-height:90px;margin-left: auto; margin-right: auto;"></div><br><input type="hidden" name="id_product" value="{{ $pd->product_id}}"><input type="file" onchange="readURLeditimg(this)" class="btn btn-secondary" name="" id="editgambar"><br><button type="submit" class="btn btn-success">Simpan</button> <a href="#" class="btn btn-danger editgambar" id="bataleditgambar{{ $pd->product_id}}">Batal</a></form>');
            });

            $('.kolomeditgambar{{ $pd->product_id}}').on('click', '#bataleditgambar{{ $pd->product_id}}', function(){
                $(".ubahgambar{{ $pd->product_id}}").show();
                $(".gambarbelumedit{{ $pd->product_id}}").css("display", "block");
                $(".editgambar{{ $pd->product_id}}").remove();
            });
            @endforeach
        });

        
    </script>
@endsection