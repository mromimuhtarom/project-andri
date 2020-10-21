<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymenttype;
use Session;
use Validator;

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
        $validator = Validator::make($request->all(), [
                        'payment_name'  =>  'required|max:50', 
                        'account_no'    =>  'required|max:25'
                    ]);

        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 

        Paymenttype::create([
            'payment_name'   => $paymentname,
            'account_number' => $accountno,
            'user_id'        => $user_id
        ]);

        alert()->success('input data telah berhasil');
        return back();
    }

    public function delete(Request $request){
        $pk = $request->pk;
        $validator = Validator::make($request->all(),[
                        'pk'    =>  'required'
                     ]);

        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 

        Paymenttype::where('payment_id', '=', $pk)->delete();

        alert()->success('Delete data telah berhasil');
        return back();
    }
}
