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
							<td class="total">Total</td>
							<td></td>
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
                                    <p>{{$ct->variation->variation_name }} : {{ $ct->variation_detail->name_detail_variation }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $ct->variation_detail->price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" href="#"> + </a>
                                        <input class="cart_quantity_input" id="cart_quantity_input{{ $ct->product_id }}" type="text" name="quantity" value="{{ $ct->qty }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" data-pk="{{ $ct->id }}" data-product_id="{{ $ct->product_id }}" href="#"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
										<table class="cart_total_price">
											<tr id="totalprice">
												<td>Rp.</td>
												<td class="pricetotal{{ $ct->product_id }}" data-price="@if($ct->variation_detail != NULL){{ $ct->variation_detail->price}}@else{{ $ct->product->price }}@endif"></td>
											</tr>
										</table>		
                                </td>
                                <td class="cart_delete">
									<a class="cart_menu" href="#" data-toggle="modal" data-target="#exampleModal{{ $ct->id }}">Beli</i></a>
                                </td>
							</tr>
								<!-- Modal -->
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
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn cart_menu">Bayar</button>
										</div>
									</form>
								</div>
								</div>
							</div>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
    <script>
        $(document).ready(function() {
			@foreach ($cart as $ct)
			var a{{$ct->product_id}} = $('#cart_quantity_input{{ $ct->product_id }}').val();
			var b{{$ct->product_id}} = $('.pricetotal{{ $ct->product_id }}').attr('data-price');
			var total{{$ct->product_id}} = a{{$ct->product_id}} * b{{$ct->product_id}};
			$('.pricetotal{{ $ct->product_id }}').html(total{{$ct->product_id}});
			@endforeach

            // ---- untuk nambah qty -----//
            $('.cart_quantity_up').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var id         = $(this).attr('data-pk');
                var qtyclass   = 'cart_quantity_input'+product_id;
                var qtyval     = $('#'+qtyclass).val();
                var totalqty   = parseInt(qtyval) + 1;
				var priceclass = "pricetotal"+product_id;
				var price      = $('.'+priceclass).attr('data-price');
				$('.'+priceclass).remove();
				var total      = parseInt(price) * parseInt(totalqty);
				$('#totalprice').append('<td class="pricetotal'+product_id+'" data-price="'+price+'">'+total+'</td>');
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
							var obj = JSON.parse(response);
							// if(obj.status == "OK"){
                            //    alert(obj.message); 
                            // } else {
                            //     alert(obj.message);
                            // }
                      
                            
                        }
                    });
            });

            // --- untuk ngurang qty --- //
            $('.cart_quantity_down').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var qtyclass   = 'cart_quantity_input'+product_id;
                var id         = $(this).attr('data-pk');
                var qtyval     = $('#'+qtyclass).val();
                var totalqty   = parseInt(qtyval) - 1;
				var priceclass = "pricetotal"+product_id;
				var price      = $('.'+priceclass).attr('data-price');
				console.log(totalqty)
                if(totalqty > 0)  {
					$('.'+priceclass).remove();
					var total      = parseInt(price) * parseInt(totalqty);
					$('#totalprice').append('<td class="pricetotal'+product_id+'" data-price="'+price+'">'+total+'</td>');
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