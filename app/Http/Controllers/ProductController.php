<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use App\Models\Variation;
use App\Models\Variationdetail;
use App\Models\Pricegroup;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Session::get('user_id');
        $product = Product::where('user_id', '=', $user_id)->get();
        $pricegroup = Pricegroup::where('user_id', '=', $user_id)->get();
        return view('pages.product', compact('product', 'pricegroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_code           = $request->product_code;
        $product_name           = $request->product_name;
        $product_weight         = $request->product_weight;
        $product_stok_general   = $request->stock_general;
        $price_group            = $request->price_group;
        $price_general          = $request->price_general;
        $variation_name         = $request->variation_name;
        $user_id                = Session::get('user_id');
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('png', 'jpg', 'JPEG', 'PNG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $product_code.'.'.$ekstensi; 
        $validator = Validator::make($request->all(),[
            'file'             => 'required',
            'product_code'     => 'required|unique:product,product_id',
            'product_name'     => 'required',
            'product_weight'   => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 

        // -- Ketika variasi kosong maka dihidupkan validasi harga dan stock barang yg general --//
        if($variation_name == NULL): 
            $validator_general = Validator::make($request->all(),[
                'price_general'     => 'required',
                'stock_general'     => 'required'
            ]);
            
            if ($validator_general->fails()) {
                alert()->error('ErrorAlert', $validator_general->errors()->first());
                return back();
            } 
        endif;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true): 
            list($width, $height)   = getimagesize($file);    
            if($ukuran < 1048576):
                    $file->move(public_path('image_user/product/'), $nama_file_unik);
                    Product::create([
                        'product_id'     => $product_code,
                        'product_name'   => $product_name,
                        'weight'         => $product_weight,
                        'price_group_id' => $price_group,
                        'price'          => $price_general,
                        'user_id'        => $user_id,
                        'picture'        => $nama_file_unik
                    ]); 
                    if($variation_name != NULL):
                        $variation = Variation::create([
                            'product_id'     => $product_code,
                            'variation_name' => $variation_name
                        ]);
                        $a = 0;
                        foreach($request->pilihan as $key => $value):
                            Variationdetail::create([
                                'variation_id'  => $variation->id,
                                'name_detail_variation' => $value,
                                'qty'           =>  $request->variation_stok[$a],
                                'price'         => $request->Harga[$a]
                            ]);
                            $a++;
                        endforeach;

                    endif;

                    return back()->with('success', 'input data telah berhasil');

            else:
                alert()->error('ErrorAlert', 'Ukuran file harus di bawah 1mb');
                return back();
            endif;
        else: 
            alert()->error('ErrorAlert', 'Ekstensi file harus png atau jpg');
            return back();
        endif;

    }

    public function updateimage(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
