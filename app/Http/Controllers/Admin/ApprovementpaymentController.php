<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Storeorder;
use Validator;

class ApprovementpaymentController extends Controller
{
    public function index(Request $request)
    {
        $user_id    = Session::get('user_id');
        $sorting    = $request->sorting;
        $namecolumn = $request->namecolumn;

        if($sorting === 'asc' || $sorting === NULL): 
            $sorting = 'desc';
        else: 
            $sorting = 'asc';
        endif;

        if($namecolumn === NULL): 
            $namecolumn = 'store_order.datetime';
        endif;
        $approve = Storeorder::join('user', 'user.user_id', '=', 'store_order.user_id')
                 ->select(
                     'store_order.id',
                     'user.fullname',
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
                     'store_order.picture',
                     'store_order.note',
                     'store_order.status',
                     'store_order.datetime',
                     'store_order.provementpic',
                     DB::raw('(store_order.price_product * store_order.qty) + store_order.ongkir as totalpriceall')
                 )
                 ->where('seller_user_id', '=', $user_id)
                 ->where('status', 4)
                 ->orderBy($namecolumn, $sorting)
                 ->paginate(5);
        return view('admin.pages.approvementpayment', compact('approve', 'user_id', 'sorting'));
    }

    public function acceptprovement(Request $request) {
        $pk   = $request->pk;
        $resi = $request->resi;
        $data = $request->all();
        $validate = [
            'pk'    => 'required',
            'resi'  => 'required'
        ];
    
        $validator = Validator::make($data,$validate);
    
        if($validator->fails()):
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        endif;

        Storeorder::where('id', $pk)->update([
            'status'  => 1,
            'note'    => 'Proses Pengiriman',
            'no_resi' => $resi
        ]);
        alert()->success('Bukti Transfer telah di terima');
        return back();
    }

    public function declineapprovement(Request $request) {
        $pk          = $request->pk;
        $description = $request->description;
        $data        = $request->all();

        $validate = [
            'pk'          => 'required',
            'description' => 'required'
        ];
    
        $validator = Validator::make($data,$validate);
    
        if($validator->fails()):
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        endif;

        Storeorder::where('id', $pk)->update([
            'status' => 2,
            'note'   => $description
        ]);

        alert()->success('Bukti transfer telah di tolak');
        return back();
    }
}
