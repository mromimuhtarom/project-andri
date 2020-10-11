<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storeorder;
use Session;
use DB;

class ApprovePaymentController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $storeorder = Storeorder::select(
                        DB::raw('(price_product * qty) + ongkir as totalprice'),
                        'store_order.*'
                      )
                      ->where('status', '=', 5)
                      ->where('user_id', '=', $user_id)
                      ->get();
        return view('user.pages.approvepayment', compact('storeorder'));
    }
}
