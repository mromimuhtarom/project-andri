@extends('user.template.template-w-sidebar')

@section('content')
	<section>
		<div class="container">
			<div class="row">				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="/image_user/product/{{ $product->picture }}" style="object-fit:cover;" alt="" />
								{{-- <h3>ZOOM</h3> --}}
							</div>
							{{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="/store_user/images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="/store_user/images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="/store_user/images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="/store_user/images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> --}}

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								{{-- <img src="/store_user/images/product-details/new.jpg" class="newarrival" alt="" /> --}}
								<h2>{{ $product->product_name }}</h2>
								<img src="/store_user/images/product-details/rating.png" alt="" />
								<span>
									<span class="price">Rp. {{ number_format($product->price, 2) }}</span>
									<label>Jumlah Barang Tersedia: {{ number_format($product->qty) }}</label>
									<form action="{{ route('addcart') }}" method="post">
										@csrf
										<input type="hidden" name="product_id" value="{{ $product->product_id }}">
										<input type="number" name="qty" class="qty" data-name="" data-variation="" data-productid="{{ $product->product_id }}" value="1" required>
										{{-- @if(!$product->variation) --}}
										{{-- @else 
											<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-fefault cart">Tambahkan</button>
										@endif --}}
										<br>
										<label>{{$product->variation->variation_name }}</label>
										<select name="variation" class="variation form-control" id="" required>
											<option value="">Pilih {{$product->variation->variation_name }}</option>

											@if($product->variation->variation_detail)
												@foreach ($product->variation->variation_detail as $vd)
													<option value="{{ $vd->id }}" data-variationname="{{ $vd->name_detail_variation }}">{{ $vd->name_detail_variation }} || Qty: {{ number_format($vd->qty) }} || Harga: {{ number_format($vd->price, 2) }}</option>
												@endforeach
											@endif
										</select><br>
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Tambahkan
										</button>
									</form>
								</span>
							</div><!--/product-information-->

						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								{{-- <li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li> --}}
								<li class="active"><a href="#reviews" data-toggle="tab">Deskripsi</a></li>
							</ul>
						</div>
						<div class="tab-content">
							{{-- <div class="tab-pane fade" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="/store_user/images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div> --}}
							 
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>{{ $product->user->fullname }}</a></li>
									</ul>
									{!!html_entity_decode($product->description)!!}
									
									{{-- <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="/store_user/images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form> --}}
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					{{-- <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/store_user/images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items--> --}}
					
				</div>
			</div>
		</div>
	</section>
		@if($product->variation->variation_detail)
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambahkan Ke Keranjang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<form action="{{ route('cart-create') }}" method="POST">
						@csrf
						<div class="modal-body">
							<span>Qty</span>
							<input type="number"><br>
							<span>{{$product->variation->variation_name }}</span>
							<select name="variation" class="variation form-control" id="">
								<option value="">Pilih {{$product->variation->variation_name }}</option>

								@if($product->variation->variation_detail)
									@foreach ($product->variation->variation_detail as $vd)
										<option value="{{ $vd->name_detail_variation }}" data-variation="{{ $vd->id }}">{{ $vd->name_detail_variation }}, Qty: {{ number_format($vd->qty) }}, Harga: {{ number_format($vd->price, 2) }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-warning">Tambahkan ke Keranjang</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		@endif

	<script>
		$('.qty').on('keyup', function(){
			var qty = $(this).val();
			var dataname = $(this).attr('data-name');
			var product_id = $(this).attr('data-productid');
			var variation = $(this).attr('data-variation');
			totalprice(qty, dataname, product_id, variation);
			
		});
		$('.variation').on('change', function(){
			var variation   = $(this).val();
			var product_id = $('.qty').attr('data-productid');
			var dataname  = $('option:selected', this).attr('data-variationname');
			var qty = $('.qty').val();
			$('.qty').attr('data-name', dataname);
			$('.qty').attr('data-variation', variation);
			totalprice(qty, dataname, product_id, variation);
		});

		function totalprice(qty, dataname, product_id, variation)
		{
			$.ajax({
				url: '{{ route("totalprice") }}',
				type: 'post',
				data:{
					qty         : qty,
					dataname    : dataname,
					product_id  : product_id,
					variation_id: variation,
					_token      : "{{ csrf_token() }}"
				},
				success: function(response){
					var obj = JSON.parse(response);
					$(".price").html('Rp. '+addCommas(obj.totalprice));
				}
			});
		}
	</script>
@endsection