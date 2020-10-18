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
                     'store_order.product_name',
                     'store_order.user_id',
                     'store_order.province_id',
                     'store_order.province_name',
                     'store_order.city_id',
                     'store_order.city_name',
                     'store_order.accept_name',
                     'store_order.telp',
                     'store_order.qty',
                     'store_order.price_product',
                     'store_order.ongkir',
                     'store_order.postal_code',
                     'store_order.ongkir',
                     'store_order.delivery_id',
                     'store_order.service_name',
                     'store_order.payment_name',
                     'store_order.note',
                     'store_order.status'
                 )
                 ->where('seller_user_id', '=', $user_id)
                 ->whereIn('status', array(2,3))
                 ->get();
        return view('pages.order', compact('order'));
    }
}
