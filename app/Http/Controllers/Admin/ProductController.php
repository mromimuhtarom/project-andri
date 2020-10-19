<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use App\Models\Variation;
use App\Models\Variationdetail;
use App\Models\Pricegroup;
use Validator;
use File;

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
        return view('admin.pages.product', compact('product', 'pricegroup'));
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
        $description            = $request->description;
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
                        'picture'        => $nama_file_unik,
                        'description'    => $description  
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
                    alert()->success('input data telah berhasil');
                    return back();

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
        $img                    = $request->file('file');
        $product_id             = $request->id_product;
        $ekstensi_diperbolehkan = array('png', 'jpg', 'JPEG', 'PNG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $product_id.'.'.$ekstensi;

        $validator_general = Validator::make($request->all(),[
            'file'     => 'required'
        ]);
        
        if ($validator_general->fails()) {
            alert()->error('ErrorAlert', $validator_general->errors()->first());
            return back();
        } 

        $oldimg = Product::where('product_id', '=', $product_id)->select('picture')->first();
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true): 
            list($width, $height)   = getimagesize($img);    
            if($ukuran < 104576):
                $path = '../public/image_user/product/'.$oldimg->picture;
                $backuppath = '../public/image_user/backup_product/'.$oldimg->picture;
                $movepath = File::move($path, $backuppath);
                $updimg = Product::where('product_id', '=', $product_id)->update([
                    'picture' => $nama_file_unik
                ]);

                File:: delete($path);
                $img->move(public_path('image_user/product/'), $nama_file_unik);
                alert()->success('input data telah berhasil');
                return back();
            else:
                alert()->error('ErrorAlert', 'Ukuran file harus di bawah 1mb');
                return back();
            endif;
        else:
            alert()->error('ErrorAlert', 'Ekstensi file harus png atau jpg');
            return back();
        endif;
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
    public function update(Request $request)
    {
        $pk        = $request->pk;
        $name      = $request->name;
        $value     = $request->value;
        if($name === 'name'):
            if(strlen($value) > 255): 
                return response()->json('Tidak boleh melebihi dari 255', 400);
            endif;
            if(!$value): 
                return response()->json('Wajib diisi', 400);
            endif;
        elseif($name === 'weight'):
            if(strlen($value) > 10): 
                return response()->json('Tidak boleh melebihi dari 10', 400);
            endif;

            if(!$value): 
                return response()->json('Wajib diisi', 400);
            endif;
        elseif($name === 'price'):
            if(strlen($value) > 14): 
                return response()->json('Tidak boleh melebihi dari 14', 400);
            endif;
            if(!$value): 
                return response()->json('Wajib diisi', 400);
            endif;
        elseif($name === 'description'):
            if(!$value): 
                alert()->error('Tidak boleh kosong');
                return back();
            endif;
        else: 
            if($request->ajax()): 
                return response()->json('Nama kolom tidak tersedia', 400);
            else:
                alert()->error('Nama kolom tidak tersedia'); 
                return back();
            endif;
        endif;

        if($name === 'name'):
            $pkproduct   = $request->pkproduct;
            $variationid = $request->variationid;
            Pricegroup::where('price_group_id', '=', $pk)->update([
                $name => $value
            ]);
            Product::where('product_id', '=', $pkproduct)->update([
                'price' => $value
            ]);

            Variationdetail::where('variation_id', '=', $variationid)->update([
                'price' => $value
            ]);
        else:
            Product::where('product_id', '=', $pk)->update([
                $name => $value
            ]);

            if($name === 'description'): 
                alert()->success('Edit deskripsi telah berhasil');
                return back();
            endif;
        endif;

    }

    public function updatevariation(Request $request)
    {
        $variationname = $request->variation_name;
        $stok          = $request->variation_stok;
        $pilihan       = $request->pilihan;
        $harga         = $request->Harga;

        foreach ($stok as $stk):
            
        endforeach;
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
