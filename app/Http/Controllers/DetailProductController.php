<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\Variationdetail;
use App\Models\Cart;
use App\Models\Address;
use Validator;

class DetailProductController extends Controller
{
    public function index($product_id, Request $request)
    {
        $product = Product::where('product_id', '=', $product_id)->first();
        return view('user.pages.detail_product', compact('product'));
    }

    public function totalprice(Request $request)
    {
        $qty        = $request->qty;
        $dataname   = $request->dataname;
        $product_id = $request->product_id;
        $variation  = $request->variation_id;

        if(Session::get('login')): 
            return redirect()->route('loginuser');
        endif;

        if($dataname): 
            $variation = Variationdetail::where('id', '=', $variation)
                         ->where('name_detail_variation', '=', $dataname)
                         ->first();
            $totalprice = $qty * $variation->price;
        else: 
            $product = Product::where('product_id', '=', $product_id)->first();
            $totalprice = $qty * $product->price;
        endif;

        return json_encode([
            "totalprice" => $totalprice
        ]);
    }

    public function cartstore(Request $request)
    {
        $product_id      = $request->product_id;
        $qty             = $request->qty;
        $variationid     = $request->variation;
        $user_id         = Session::get('user_id');
        $address         = Address::where('user_id', '=', $user_id)
                           ->where('status', '=', 2)
                           ->first();
        $variationdetail = Variationdetail::where('id', '=', $variationid)
                           ->first();

        $validator = Validator::make($request->all(),[
            'qty'             => 'required|integer',
            'variation'       => 'required',
        ]);
        
        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 
        
        $cart = Cart::where('product_id', '=', $product_id)
                ->where('user_id', '=', $user_id)
                ->where('variation_id', '=', $variationdetail->variation_id)
                ->where('variation_detail_id', '=', $variationid)
                ->first();

        if($cart): 
            $totalqty = $cart->qty + $qty;
            Cart::where('product_id', '=', $product_id)
            ->where('user_id', '=', $user_id)
            ->where('variation_id', '=', $variationdetail->variation_id)
            ->where('variation_detail_id', '=', $variationid)
            ->update([
                'qty'  => $totalqty
            ]);
        else: 
            Cart::create([
                'product_id'          => $product_id,
                'variation_id'        => $variationdetail->variation_id,
                'variation_detail_id' => $variationid,
                'qty'                 => $qty,
                'user_id'             => $user_id,
                'address_id'          => $address->address_id
            ]);
        endif;

        alert()->success('Item Telah Di Tambahkan');
        return redirect()->route('cart-view');
    }
}
