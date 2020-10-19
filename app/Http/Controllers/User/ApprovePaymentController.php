<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storeorder;
use Session;
use DB;
use Validator;

class ApprovePaymentController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $storeorder = Storeorder::select(
                        DB::raw('(price_product * qty) + ongkir as totalprice'),
                        'store_order.*'
                      )
                      ->where('status', '=', 4)
                      ->where('user_id', '=', $user_id)
                      ->get();
        return view('user.pages.approvepayment', compact('storeorder'));
    }

    public function Uploadimage(Request $request)
    {
        $id        = $request->id;
        $store_order = Storeorder::where('id', '=', $id)
                       ->where('status', '=', 5)
                       ->first();
        $ekstensi_diperbolehkan = array('png', 'jpg', 'JPEG', 'PNG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $file                   = $request->file('file');
        $folder                 = $store_order->seller_user_id;
        $filename               = $store_order->id.'.'.$ekstensi;
        $validator = Validator::make($request->all(),[
            'file'             => 'required',
        ]);
        
        if ($validator->fails()):
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        endif;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true): 
            if($ukuran < 1048576):
                $file->move(public_path('image/buktitransfer/'.$folder.'/'), $filename);
                Storeorder::where('id', '=', $id)->where('status', '=', 1)->update([
                    'provementpic' => $filename
                ]);
            endif;
        endif;

    }
}
