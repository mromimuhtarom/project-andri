<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymenttype;
use Session;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $paymenttype = Paymenttype::where('user_id', '=', $user_id)->get();
        return view('admin.pages.paymentsetting', compact('paymenttype'));
    }

    public function store(Request $request)
    {
        $paymentname = $request->payment_name;
        $accountno   = $request->account_no;
        $user_id     = Session::get('user_id');

        Paymenttype::create([
            'payment_name'   => $paymentname,
            'account_number' => $accountno,
            'user_id'        => $user_id
        ]);

        return back()->with('success', 'input data telah berhasil');
    }
}
