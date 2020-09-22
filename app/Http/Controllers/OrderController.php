<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    Public function index(Request $request)
    {
        $order = Order::join('user', 'user.user_id', '=', 'order.user_id')
                 ->select(
                     'user.fullname',
                     'user.telp',
                     'user.address',
                     'order.product_name',
                     'order.user_id',
                     'order.qty',
                     'order.total_price',
                     'order.note'
                 )
                 ->whereIn('status', array(0,2))
                 ->get();
        return view('pages.order', compact('order'));
    }
}
