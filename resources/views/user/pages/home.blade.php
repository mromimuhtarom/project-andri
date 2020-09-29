@extends('user.template.template-w-sidebar')

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
                    <img src="/image_user/product/{{ $pns->picture }}" alt="" />
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
    @php
        $productcategory = App\Models\Product::where('category_id', '=', $cs->category_id)->get();    
    @endphp
    @if (!$productcategory->isEMPTY())
        <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#{{ str_replace(' ', '',$cs->category_name) }}" data-toggle="tab">{{ $cs->category_name }}</a></li>
                </ul>
            </div>
            @foreach ($productcategory as $pc)
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt" >
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="/image_user/product/{{ $pc->picture }}" alt="" />
                                    <h2>Rp. {{ number_format($pc->price, 2) }}</h2>
                                    <p>{{ $pc->product_name }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/category-tab-->  
    @endif
  
@endforeach

@endsection