<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Storeorder;

class ApprovementpaymentController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $approve = Storeorder::join('user', 'user.user_id', '=', 'store_order.user_id')
                 ->select(
                     'store_order.id',
                     'user.fullname',
                     'user.telp',
                     'store_order.product_name',
                     'store_order.user_id',
                     'store_order.province_id',
                     'store_order.province_name',
                     'store_order.detail_address',
                     'store_order.city_id',
                     'store_order.city_name',
                     'store_order.accept_name',
                     'store_order.telp',
                     'store_order.qty',
                     'store_order.price_product',
                     'store_order.variation_name',
                     'store_order.variation_detail_name',
                     'store_order.ongkir',
                     'store_order.postal_code',
                     'store_order.delivery_id',
                     'store_order.service_name',
                     'store_order.payment_name',
                     'store_order.note',
                     'store_order.status',
                     'store_order.datetime',
                     'store_order.provementpic',
                     DB::raw('(store_order.price_product * store_order.qty) + store_order.ongkir as totalpriceall')
                 )
                 ->where('seller_user_id', '=', $user_id)
                 ->where('status', 4)
                 ->paginate(1);
        return view('admin.pages.approvementpayment', compact('approve', 'user_id'));
    }
}
