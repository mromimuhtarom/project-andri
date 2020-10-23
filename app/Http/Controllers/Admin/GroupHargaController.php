<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pricegroup;
use Session;
use Validator;
use App\Models\Product;

class GroupHargaController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $pricegroup = Pricegroup::where('user_id', '=', $user_id)->get();
        return view('admin.pages.groupharga', compact('pricegroup'));
    }

    public function store(Request $request)
    {
        $user_id = Session::get('user_id');
        $name    = $request->name;
        $harga   = $request->harga;

        Pricegroup::create([
            'name'    => $name,
            'price'   => $harga,
            'user_id' => $user_id
        ]);

        alert()->success('input data telah berhasil');
        return back();
    }

    public function delete(Request $request){
        $pk        = $request->pk;
        $validator = Validator::make($request->all(),[
                        'pk'    =>  'required'
                     ]);

        $product = Product::where('price_group_id', $pk)->first();
        if($product): 
            alert()->error('ErrorAlert', 'Harga Group ini di pakai oleh produk tertentuk, silahkan diubah group harga di produk baru bsa menghapus group haraga ini');
            return back();
        endif;

        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 

        Pricegroup::where('price_group_id', '=', $pk)->delete();

        alert()->success('Delete data telah berhasil');
        return back();
    }
}
