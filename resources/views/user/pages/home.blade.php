@extends('user.index')

@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Terlaris</h2>
    @foreach ($productmanyview as $pv)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="/image_user/product/{{ $pv->picture }}" alt="" />
                        <h2>Rp. {{ number_format($pv->price, 2) }}</h2>
                        <p>{{ $pv->product_name }}</p>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>Rp. {{ number_format($pv->price, 2) }}</h2>
                            <p>{{ $pv->product_name }}</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endforeach    
</div><!--features_items-->

<div class="features_items">
    <h2 class="title text-center">Baru Dijual</h2>
    @foreach ($productnewsale as $pns)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="/image_user/product/{{ $pv->picture }}" alt="" />
                    <h2>Rp. {{ number_format($pns->price, 2)}}</h2>
                    <p>{{ $pns->product_name }}</p>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>Rp. {{ number_format($pns->price, 2)}}</h2>
                        <p>{{ $pns->product_name }}</p>
                    </div>
                </div>
                <img src="/store_user/images/home/new.png" class="new" alt="" />
            </div>
        </div>
    </div>
    @endforeach
</div>
@foreach ($categorystore as $cs)
@if (!$cs->productcategorychild->isEMPTY())
    @foreach ($cs->productcategorychild as $cs1)
        <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#{{ str_replace(' ', '',$cs1->category_name) }}" data-toggle="tab">{{ $cs1->category_name }}</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt" >
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="/image_user/product/{{ $cs1->picture }}" alt="" />
                                    <h2>Rp. {{ number_fromat($cs1->price, 2) }}</h2>
                                    <p>{{ $cs1->product_name }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/category-tab-->         
    @endforeach
@else
<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="/store_user/images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/category-tab--> 
@endif

@endforeach

@endsection