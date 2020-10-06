<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Product;

class DetailProductController extends Controller
{
    public function index($product_id, Request $request)
    {
        $product = Product::where('product_id', '=', $product_id)->first();
        return view('user.pages.detail_product', compact('product'));
    }
}
