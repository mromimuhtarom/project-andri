<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Storeorder;
use Session;
use DB;

class OrderController extends Controller
{
    Public function index(Request $request)
    {
        $orderid    = $request->order_id;
        $user_id    = Session::get('user_id');
        $sorting    = $request->sorting;
        $username   = $request->username;
        $status     = $request->status;
        $namecolumn = $request->namecolumn;
        $route      = 'order';

        if($sorting === 'asc' || $sorting === NULL): 
            $sorting = 'desc';
        else: 
            $sorting = 'asc';
        endif;

        if($namecolumn === NULL): 
            $namecolumn = 'store_order.datetime';
        endif;

        $order = Storeorder::join('user', 'user.user_id', '=', 'store_order.user_id')
                 ->select(
                     'user.fullname',
                     'user.telp',
                     'user.username',
                     'store_order.product_name',
                     'store_order.user_id',
                     'store_order.id',
                     'store_order.province_id',
                     'store_order.province_name',
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
                     'store_order.ongkir',
                     'store_order.delivery_id',
                     'store_order.service_name',
                     'store_order.payment_name',
                     'store_order.provementpic',
                     'store_order.picture',
                     'store_order.note',
                     'store_order.status',
                     'store_order.datetime',
                     'store_order.detail_address',
                     DB::raw('(store_order.price_product * store_order.qty) + store_order.ongkir as totalpriceall')
                 )
                 ->where('seller_user_id', '=', $user_id)
                 ->whereIn('status', array(1,2,3))
                 ->orderBy($namecolumn, $sorting)
                 ->paginate(5);
        $order->appends($request->all());
        return view('admin.pages.order', compact('order', 'user_id', 'sorting', 'orderid', 'username', 'status', 'route'));
    }

    public function search(Request $request){
        $orderid    = $request->order_id;
        $user_id    = Session::get('user_id');
        $username   = $request->username;
        $status     = $request->status;
        $sorting    = $request->sorting;
        $namecolumn = $request->namecolumn;
        $route      = 'order-search';


        if($sorting === 'asc' || $sorting === NULL): 
            $sorting = 'desc';
        else: 
            $sorting = 'asc';
        endif;

        if($namecolumn === NULL): 
            $namecolumn = 'store_order.datetime';
        endif;
        $storeorder = Storeorder::join('user', 'user.user_id', '=', 'store_order.user_id')
                      ->select(
                        'user.fullname',
                        'user.telp',
                        'user.username',
                        'store_order.product_name',
                        'store_order.user_id',
                        'store_order.id',
                        'store_order.province_id',
                        'store_order.province_name',
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
                        'store_order.ongkir',
                        'store_order.delivery_id',
                        'store_order.service_name',
                        'store_order.payment_name',
                        'store_order.provementpic',
                        'store_order.picture',
                        'store_order.note',
                        'store_order.status',
                        'store_order.datetime',
                        'store_order.detail_address',
                        DB::raw('(store_order.price_product * store_order.qty) + store_order.ongkir as totalpriceall')
                     )
                     ->where('seller_user_id', '=', $user_id)
                     ->whereIn('status', array(1,2,3));

        if($orderid != NULL && $username != NULL && $status != NULL):
            if(is_numeric($username) !== true): 
                $order = $storeorder->where('user.username', 'LIKE', '%'.$username.'%')
                         ->where('store_order.id', '=', $orderid)
                         ->where('store_order.status', '=', $status)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            else: 
                $order = $storeorder->where('store_order.user_id', '=', $username)
                         ->where('store_order.id', '=', $orderid)
                         ->where('store_order.status', '=', $status)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            endif; 
            $order->appends($request->all());
        elseif($orderid != NULL && $username != NULL):
            if(is_numeric($username) !== true): 
                $order = $storeorder->where('user.username', 'LIKE', '%'.$username.'%')
                         ->where('store_order.id', '=', $orderid)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            else: 
                $order = $storeorder->where('store_order.user_id', '=', $username)
                         ->where('store_order.id', '=', $orderid)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            endif; 
            $order->appends($request->all());
        elseif($orderid != NULL && $status != NULL):
            $order = $storeorder->where('store_order.id', '=', $orderid)
                        ->where('store_order.status', '=', $status)
                        ->orderBy($namecolumn, $sorting)
                        ->paginate('5');
            $order->appends($request->all());
        elseif($username != NULL && $status != NULL):
            if(is_numeric($username) !== true): 
                $order = $storeorder->where('user.username', 'LIKE', '%'.$username.'%')
                         ->where('store_order.status', '=', $status)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            else: 
                $order = $storeorder->where('store_order.user_id', '=', $username)
                         ->where('store_order.status', '=', $status)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            endif; 
            $order->appends($request->all());
        elseif($status != NULL):
            $order = $storeorder->where('store_order.status', '=', $status)
                        ->orderBy($namecolumn, $sorting)
                        ->paginate('5');
            $order->appends($request->all());
        elseif($username != NULL):
            if(is_numeric($username) !== true):
                $order = $storeorder->where('user.username', 'LIKE', '%'.$username.'%')
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            else: 
                $order = $storeorder->where('store_order.user_id', '=', $username)
                         ->orderBy($namecolumn, $sorting)
                         ->paginate('5');
            endif; 
            $order->appends($request->all());
        elseif($orderid != NULL):
            $order = $storeorder->where('store_order.id', '=', $orderid)
                        ->orderBy($namecolumn, $sorting)
                        ->paginate('5');
            $order->appends($request->all());
            dd($orderid);
        else:
            return redirect()->route('order');
        endif;

        return view('admin.pages.order', compact('order', 'user_id', 'sorting', 'orderid', 'username', 'status', 'route'));
    }
}
