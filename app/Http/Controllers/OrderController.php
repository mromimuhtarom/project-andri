<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storeorder;
use Session;

class OrderController extends Controller
{
    Public function index(Request $request)
    {
        $user_id = Session::get('user_id');
        $order = Storeorder::join('user', 'user.user_id', '=', 'store_order.user_id')
                 ->select(
                     'user.fullname',
                     'user.telp',
                     'user.address',
                     'store_order.product_name',
                     'store_order.user_id',
                     'store_order.qty',
                     'store_order.total_price',
                     'store_order.note'
                 )
                 ->where('seller_user_id', '=', $user_id)
                 ->whereIn('status', array(0,2))
                 ->get();
        return view('pages.order', compact('order'));
    }
}
