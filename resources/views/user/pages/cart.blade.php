@extends('user.template.default')

@section('content')
	<section id="cart_items">
		<div class="container">
			{{-- <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div> --}}
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Nama Barang</td>
							<td class="description"></td>
							<td class="price">Harga</td>
                            <td class="quantity">Qty</td>
                            <td width="10%">Ganti Alamat</td>
							<td class="total">Total</td>
							<td>Aksi</td>
						</tr>
					</thead>
					<tbody>
                        @foreach ($cart as $ct)
							<tr class="rowproduct{{ $ct->id }}">
                                <td class="cart_product">
                                    <a href=""><img src="/image_user/product/{{ $ct->product->picture }}" alt="" style="max-width:100px;max-height:100px;"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $ct->product->product_name }}</a></h4>
                                    @if($ct->variation_detail_id != 0)<p>{{$ct->variation->variation_name }} : {{ $ct->variation_detail->name_detail_variation }}</p>@endif
                                </td>
                                <td class="cart_price">
                                    <p class="priceitem{{ $ct->id }}">
                                        @if($ct->variation_detail_id != 0)
                                        {{ $ct->variation_detail->price }}
                                        @else 
                                        {{$ct->product->price}}
                                        @endif
                                    </p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" href="#"> + </a>
                                        <input class="cart_quantity_input" id="cart_quantity_input{{ $ct->id }}" type="text" name="quantity" value="{{ $ct->qty }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" href="#"> - </a>
                                    </div>
                                </td>
                                <td>
                                    <select name="address" id="address{{ $ct->id }}" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" class="addressdetail">
                                        <option value="">Pilih Alamat</option>
                                        @foreach ($addresslist as $adl)
                                        <option value="{{ $adl->address_id }}" @if($adl->address_id == $addressmain->address_id) selected @endif>{{ $adl->detail_address}}, {{ $adl->city_name }}, {{ $adl->province_name }}, Kode Pos: {{ $adl->postal_code }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="cart_total">
										<table class="cart_total_price">
											<tr id="totalprice">
												<td>Rp.</td>
												<td class="pricetotal{{ $ct->id }}" data-price="@if($ct->variation_detail != NULL){{ $ct->variation_detail->price}}@else{{ $ct->product->price }}@endif"></td>
											</tr>
										</table>		
                                </td>
                                <td align="center">
									<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal{{ $ct->id }}">Beli</i></a>
                                </td>

							</tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section> <!--/#cart_items-->
    <!-- Modal -->
    @foreach ($cart as $ct)
        <div class="modal fade" id="exampleModal{{ $ct->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembelian Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="product_id" value="{{ $ct->product_id }}">
                        <input type="hidden" name="qty" value="{{ $ct->qty }}">
                        <input type="hidden" name="variation_detail" value="{{ $ct->variation_detail_id }}">
                        <select name="" id="">
                            <option value="">Pilih Tipe Pembayaran</option>
                            @foreach ($ct->paymentType as $pt)
                                <option value="{{ $pt->payment_id }}">{{ $pt->payment_name }}</option>
                            @endforeach
                        </select>
                        <select name="delivery" id="delivery{{ $ct->id }}" data-weight="{{ $ct->product->weight }}" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" data-origin={{ $ct->originaddressseller->city_id }} class="delivery">
                            <option value="" disabled>Pilih Pengiriman</option>
                            @foreach ($sender as $key => $value)
                                <option value="{{ $key }}" @if($key === $ct->delivery_id) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select name="service" class="service" id="service{{ $ct->id }}">
                            
                        </select>
                        <table width="100%">
                            <tr class="etdtable{{$ct->id}}">
                                <td width="25%">Jangka Waktu Pengiriman(Hari)</td>
                                <td width="5%">:</td>
                                <td class="etd{{ $ct->id }}"></td>
                            </tr>
                            <tr class="priceongkirtable{{$ct->id}}">
                                <td>Ongkir</td>
                                <td>:</td>
                                <td class="priceongkir{{$ct->id}}"></td>
                            </tr>
                            <tr class="totalwithcouriertable{{$ct->id}}">
                                <td>Total Harga</td>
                                <td>:</td>
                                <td class="totalwithcourier{{$ct->id}}"></td>
                            </tr>
                        </table>
                        <script>
                            var dlvr       = $('#delivery{{ $ct->id }}').val();
                            var service    = $('#service{{ $ct->id }}').val();
                            var product_id = $('#delivery{{ $ct->id }}').attr('data-product_id');
                            var id         = $('#delivery{{ $ct->id }}').attr('data-pk');
                            var weight     = $('#delivery{{ $ct->id }}').attr('data-weight');
                            var qty        = $('#cart_quantity_input{{ $ct->id }}').val();
                            var origin     = $('#delivery{{ $ct->id }}').attr('data-origin');
                            var price      = $('.pricetotal{{ $ct->id }}').attr('data-price');

                            if(dlvr){
                                var svb = '{{ $ct->service }}';
                                    $.ajax({
                                        url: '{{ route("cart-servicelist") }}',
                                        type: 'post',
                                        data:{
                                            delivery_id: dlvr,
                                            id         : id,
                                            weight     : weight,
                                            origin     : origin,
                                            _token     : "{{ csrf_token() }}"
                                        },
                                        success: function(response){
                                            var obj = JSON.parse(response);
                                            $('#service{{ $ct->id }}').append('<option value="" class="scrv{{ $ct->id }}" disabled>Pilih Service</option>');
                                            $.each( obj.dataongkir.rajaongkir.results[0].costs, function(index, srv ) {
                                                if(svb == srv.service){
                                                    var total = price * qty + srv.cost[0].value;
                                                    $('#service{{ $ct->id }}').append('<option class="scrv{{ $ct->id }}" selected value="'+srv.service+'">'+srv.service+'</option>');
                                                    $('.etd{{ $ct->id }}').append(srv.cost[0].etd)
                                                    $('.priceongkir{{$ct->id}}').append(srv.cost[0].value);
                                                    $('.totalwithcourier{{$ct->id}}').append(total);
                                                } else {
                                                    $('#service{{ $ct->id }}').append('<option class="scrv{{ $ct->id }}" value="'+srv.service+'">'+srv.service+'</option>');
                                                }
                                            });
                                        }
                                    });


                            }

                            if(dlvr && service){
                                    $.ajax({
                                        url: '{{ route("cart-upddelivery") }}',
                                        type: 'post',
                                        data:{
                                            delivery_id: dlvr,
                                            id         : id,
                                            weight     : weight,
                                            origin     : origin,
                                            srvc       : service,
                                            _token     : "{{ csrf_token() }}"
                                        },
                                        success: function(response){
                                            var obj = JSON.parse(response);
                                            var total = price * qty + obj.dataongkir;
                                            $('.etd{{ $ct->id }}').append(obj.day)
                                            $('.priceongkir{{$ct->id}}').append(obj.dataongkir);
                                            $('.totalwithcourier{{$ct->id}}').append(total);
                                            
                                            console.log(total);
                                        }
                                    });

                            }
                            $('#service{{ $ct->id }}').on('change', function(){
                                var val        = $(this).val();
                                if(val){
                                    $.ajax({
                                        url: '{{ route("cart-upddelivery") }}',
                                        type: 'post',
                                        data:{
                                            delivery_id: dlvr,
                                            id         : id,
                                            weight     : weight,
                                            origin     : origin,
                                            srvc       : val,
                                            _token     : "{{ csrf_token() }}"
                                        },
                                        success: function(response){
                                            var obj = JSON.parse(response);
                                            console.log(obj);
                                            var total = price * qty + obj.dataongkir;
                                            $('.etd{{ $ct->id }}').remove();
                                            $('.priceongkir{{$ct->id}}').remove();
                                            $('.totalwithcourier{{$ct->id}}').remove();
                                            $('.etdtable{{ $ct->id }}').append('<td class="etd{{ $ct->id }}">'+obj.day+'</td>')
                                            $('.priceongkirtable{{$ct->id}}').append('<td class="priceongkir{{ $ct->id }}">'+obj.dataongkir+'</td>');
                                            $('.totalwithcouriertable{{$ct->id}}').append('<td class="totalwithcourier{{$ct->id}}">'+total+'</td>');
                                            
                                            console.log(obj);
                                        }
                                    });
                                }
                            });
                            $('#delivery{{ $ct->id }}').on('change', function(){
                                $('.etd{{ $ct->id }}').remove();
                                $('.priceongkir{{$ct->id}}').remove();
                                $('.totalwithcourier{{$ct->id}}').remove();
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Bayar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    @endforeach


    <script>
        $(document).ready(function() {
			@foreach ($cart as $ct)
			var a{{$ct->id}} = $('#cart_quantity_input{{ $ct->id }}').val();
			var b{{$ct->id}} = $('.pricetotal{{ $ct->id }}').attr('data-price');
			var total{{$ct->id}} = a{{$ct->id}} * b{{$ct->id}};
            var delivery{{$ct->id}} = $('#delivery{{ $ct->id }}').val();
            if(delivery{{$ct->id}}){
                $('.pricetotal{{ $ct->id }}').html(total{{$ct->id}});
            } else {
                $('.pricetotal{{ $ct->id }}').html('0');
            }
			
			@endforeach

            // ---- untuk nambah qty -----//
            $('.cart_quantity_up').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var id         = $(this).attr('data-pk');
                var qtyclass   = 'cart_quantity_input'+id;
                var qtyval     = $('#'+qtyclass).val();
                var totalqty   = parseInt(qtyval) + 1;
				var priceclass = "pricetotal"+id;
				var price      = $('.'+priceclass).attr('data-price');
				$('.'+priceclass).remove();
				var total      = parseInt(price) * parseInt(totalqty);
                $('#'+qtyclass).val(totalqty);
                var delivery = $('#delivery'+id).val();
                    $.ajax({
                        url: '{{ route("cart-qty-update") }}',
                        type: 'post',
                        data:{
                            qty: totalqty,
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response){
                            //add response in modal body
							var obj = JSON.parse(response);
							// if(obj.status == "OK"){
                            //    alert(obj.message); 
                            // } else {
                            //     alert(obj.message);
                            // }
                      
                            
                        }
                    });

                if(delivery) {
                    $('#totalprice').append('<td class="pricetotal'+id+'" data-price="'+price+'">'+total+'</td>');
                } else {
                    $('#totalprice').append('<td class="pricetotal'+id+'" data-price="'+price+'">0</td>');
                }
            });
            
            $('.delivery').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var id         = $(this).attr('data-pk'); 
                var weight     = $(this).attr('data-weight');
                var delivery   = $('#delivery'+id).val();
                var qty        = $('#cart_quantity_input'+id).val();
                var origin     = $(this).attr('data-origin');
                console.log(id);
                  
                    $.ajax({
                        url: '{{ route("cart-servicelist") }}',
                        type: 'post',
                        data:{
                            delivery_id: delivery,
                            id: id,
                            weight: weight,
                            origin: origin,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response){
							var obj = JSON.parse(response);
                            $('.scrv'+id).remove();
                            $('#service'+id).append('<option value="" class="scrv'+id+'" selected disabled>Pilih Service</option>');
                            $.each( obj.dataongkir.rajaongkir.results[0].costs, function(index, srv ) {
                                    $('#service'+id).append('<option class="scrv'+id+'" value="'+srv.service+'">'+srv.service+'</option>');
                            });
                            console.log(obj);
                        }
                    });

            })

            // --- untuk ngurang qty --- //
            $('.cart_quantity_down').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var id         = $(this).attr('data-pk');
                var qtyclass   = 'cart_quantity_input'+id;
                var qtyval     = $('#'+qtyclass).val();
                var totalqty   = parseInt(qtyval) - 1;
				var priceclass = "pricetotal"+id;
				var price      = $('.'+priceclass).attr('data-price');
                var delivery = $('#delivery'+id).val();

				console.log(totalqty)
                if(totalqty > 0)  {
					$('.'+priceclass).remove();
					var total      = parseInt(price) * parseInt(totalqty);
                    if(delivery){
                        $('#totalprice').append('<td class="pricetotal'+id+'" data-price="'+price+'">'+total+'</td>');
                    } else {
                        $('#totalprice').append('<td class="pricetotal'+id+'" data-price="'+price+'">0</td>');
                    }
                    $('#'+qtyclass).val(totalqty);
					$.ajax({
                        url: '{{ route("cart-qty-update") }}',
                        type: 'post',
                        data:{
                            qty: totalqty,
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response){
                            //add response in modal body
                            // if(response.status == "OK"){
                            //    alert('Mantul'); 
                            // } else {
                            //     alert(response);
                            // }
                            
                        }
                    });
                } else if(totalqty == 0) {
					var rowclass = 'rowproduct'+id;
					$('.'+rowclass).remove();
					$.ajax({
                        url: '{{ route("cart-delete") }}',
                        type: 'post',
                        data:{
                            pk: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response){
                            //add response in modal body
							var obj = JSON.parse(response);
							// if(obj.status == "OK"){
                            //    alert(obj.message); 
                            // } else {
                            //     alert(obj.message);
                            // }
                      
                            
                        }
                    });
				}
            });
        });
    </script>
@endsection