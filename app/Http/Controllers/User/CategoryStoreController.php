<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryStoreController extends Controller
{
    public function index(Request $request, $categoryname)
    {
        $category_name = str_replace('_', ' ', $categoryname);
        $category_detail = Category::where('category_name', '=', $category_name)->first();
        if(!$category_detail): 
            return back();
        endif;
        $product = Product::where('category_id', '=', $category_detail->category_id)->paginate(12);

        return view('user.pages.category', compact('product', 'category_detail'));
    }
}
