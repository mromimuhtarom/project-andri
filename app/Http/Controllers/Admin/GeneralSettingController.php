<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Validator;
use File;

class GeneralSettingController extends Controller
{
    public function index(){
        $email    = Config::where('id', 4)->first();
        $telp     = Config::where('id', 5)->first();
        $judultab = Config::where('id', 6)->first();

        return view('admin.pages.general_setting', compact('email', 'telp', 'judultab'));
    }

    public function editicon(Request $request){
        $icon = $request->file('file');;
        $validator = Validator::make($request->all(),[
            'file'  =>  'required|mimes:png|dimensions:min_width=139,max_width=39'
        ]);

        if($validator->fails()):
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;
        $namafile = 'logo.png';
        $icon->move(public_path('store_user/images/home/'), $namafile);

        alert()->success('Ganti Ikon Web telah berhasil');
        return back();
    }

    public function editfavicon(Request $request){
        $icon = $request->file('file');;
        $validator = Validator::make($request->all(),[
            'file'  =>  'required|mimes:png|dimensions:ratio=3/3'
        ]);

        if($validator->fails()):
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;
        $namafile = 'favicon.png';
        $icon->move(public_path('store_user/images/home/'), $namafile);

        alert()->success('Ganti Ikon Web telah berhasil');
        return back();
    }

    public function update(Request $request){
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        if($pk == 4): 
            $data = $request->all();
            $data['email'] = $value;
            $validator = Validator::make($data,[
                'email' =>  'required|email'
            ]);
            if($validator->fails()): 
                return response()->json($validator->errors()->first(), 400);
            endif;
            if(strlen($value) > 500): 
                return response()->json('Mohon maaf email tidak boleh lebih dari 500', 400);
            endif;
        elseif($pk == 5): 
            if(strlen($value) > 15): 
                return response()->json('Mohon maaf telp tidak boleh lebih dari 15', 400);
            endif;
        elseif($pk == 6):
            if(strlen($value) > 25): 
                return response()->json('Mohon maaf judul tab tidak boleh lebih dari 25', 400);
            endif;
        endif;
        Config::where('id', $pk)->update([
            $name => $value
        ]);
    }
}
