<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cart;

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
}
