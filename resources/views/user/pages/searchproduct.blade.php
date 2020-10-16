@extends('user.template.template-w-sidebar')

@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">{{ $productname }}</h2>
        @foreach ($productmanyview as $pdv)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="/image_user/product/{{ $pdv->picture }}" alt="" />
                            <h2>Rp. {{ number_format($pdv->price) }}</h2>
                            <p>{{ $pdv->product_name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>Rp. {{ number_format($pdv->price) }}</h2>
                                <p>{{ $pdv->product_name }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach        
        {{ $productmanyview->links('user.pagination.default') }}
        {{-- <ul class="pagination">
            <li class="active"><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">&raquo;</a></li>
        </ul> --}}
    </div><!--features_items-->
</div>


@endsection