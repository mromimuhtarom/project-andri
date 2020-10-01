<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cart;
use App\Models\Storeorder;
use App\Models\Product;
use App\Models\Variationdetail;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $cart = Cart::where('user_id', '=', $user_id)->get();
        return view('user.pages.cart', compact('cart'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $qty = $request->qty;
            if($id != NULL)
            Cart::where('id', '=', $id)->update([
                'qty'   =>  $qty
            ]);
            return json_encode([
                "status"  => "OK",
                "message" => $qty
            ]);
        }
        return json_encode([
            "message" => 'sdfsd'
        ]);
    }

    public function storeOrder(Request $request)
    {
        $product_id       = $request->product_id;
        $variationdetid   = $request->variation_detail;
        $qty              = $request->qty;
        $product          = Product::where('product_id', $product_id)->first();
        $variation_detail = Variationdetail::where('id',$variationdetid)->first();
        $user_id          = Session::get('user_id');
        if($variation_detail):
        $total_price      = $variation_detail * $qty;
        else: 
            $total_price = $product->price * $qty;
        endif;

        Storeorder::create([
            'product_name'  => $product->product_name,
            'category_id'   => $product->category_id,
            'user_id'       => $user_id,
            'qty'           => $qty,
            'total_price'   => $total_price,
            'note'          => 'Sedang melakukan pembayaran'
        ]);
        
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $pk = $request->pk;
            if($pk != NULL): 
                Cart::where('id', '=', $pk)->delete();

                return json_encode([
                    "status"    =>  "OK",
                    "message"   =>  "Hapus data berhasil"
                ]);
            endif;
                return json_encode([
                    "status"    =>  "OK",
                    "message"   =>  "Hapus data gagal"
                ]);
        }
    }
}
