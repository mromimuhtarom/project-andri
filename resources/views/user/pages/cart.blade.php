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
                            <tr>
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
                                        <input class="cart_quantity_input{{ $ct->product_id }}" type="text" name="quantity" value="{{ $ct->qty }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" data-product_id="{{ $ct->product_id }}" href="#"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$59</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	{{-- <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
    </section><!--/#do_action--> --}}
    <script>
        $(document).ready(function() {
            // ---- untuk nambah qty -----//
            $('.cart_quantity_up').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var id = $(this).attr('data-pk');
                var qtyclass = 'cart_quantity_input'+product_id;
                var qtyval = $('.'+qtyclass).val();
                var totalqty = parseInt(qtyval) + 1;
                $('.'+qtyclass).val(totalqty);
                console.log(id);

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
                            if(response.status == "OK"){
                               alert('Mantul'); 
                            } else {
                                alert(response);
                            }
                            
                        }
                    });
            });

            // --- untuk ngurang qty --- //
            $('.cart_quantity_down').on('click', function(){
                var product_id = $(this).attr('data-product_id');
                var qtyclass = 'cart_quantity_input'+product_id;
                var qtyval = $('.'+qtyclass).val();
                var totalqty = parseInt(qtyval) - 1;
                if(totalqty > 0)  {
                    $('.'+qtyclass).val(totalqty);
                }
            });
        });
    </script>
@endsection