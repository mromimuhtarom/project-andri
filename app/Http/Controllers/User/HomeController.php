<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $productmanyview = Product::orderby('view', 'desc')->where('qty', '>', 0)->limit(3)->get();
        $productnewsale = Product::orderby('datetime', 'desc')->where('qty', '>', 0)->limit(3)->get();
        $categorystore = Category::limit('4')->get();
        return view('user.pages.home', compact('productmanyview', 'productnewsale', 'categorystore'));
    }

    public function searchproduct(Request $request)
    {
        $productname     = $request->productname;
        $productmanyview = Product::where('product_name', 'LIKE', '%'.$productname.'%')
                           ->where('qty', '>', 0)
                           ->paginate(25);
        return view('user.pages.searchproduct', compact('productmanyview', 'productname'));
    }
}
