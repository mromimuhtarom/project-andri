@extends('user.template.template-w-sidebar');

@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">{{ $category_detail->category_name}}</h2>
        @foreach ($product as $pd)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="/image_user/product/{{ $pd->picture }}" alt="" />
                            <h2>Rp. {{ number_format($pd->price, 2)}}</h2>
                            <p>{{ $pd->prodcut_name}}</p>
                            <a href="@if(Session::get('login')){{ route('detailproduct-view', $pd->product_id)}}@else {{ route('loginuser') }} @endif" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail Produk</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>Rp.{{ number_format($pd->price, 2) }}</h2>
                                <p>{{ $pd->product_name}}</p>
                                <a href="@if(Session::get('login')){{ route('detailproduct-view', $pd->product_id)}}@else {{ route('loginuser') }} @endif" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail Produk</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        @endforeach

        {{ $product->links('user.pagination.default') }}
    </div><!--features_items-->
@endsection