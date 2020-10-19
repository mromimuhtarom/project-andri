<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cart;
use App\Models\Storeorder;
use App\Models\Product;
use App\Models\Variationdetail;
use App\Models\User;
use App\Models\Address;
use App\Models\Config;
use App\Models\Paymenttype;
use Validator;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $cart = Cart::where('user_id', '=', $user_id)->get();
        $addressmain = Address::where('user_id', '=', $user_id)
                       ->where('status', '=', 2)
                       ->first();
        $addresslist = Address::where('user_id', '=', $user_id)->get();
        $typesend   = Config::where('id', '=', 2)->first();
        $replace = str_replace(':', ',', $typesend->value);
        $typesendexplode = explode(',', $replace);
        $sender = [
            $typesendexplode[0] => $typesendexplode[1],
            $typesendexplode[2] => $typesendexplode[3],
            $typesendexplode[4] => $typesendexplode[5]
        ];


        return view('user.pages.cart', compact('cart', 'addressmain', 'addresslist', 'sender'));
    }

    public function store(Request $request)
    {
        $cart_id  = $request->cart_id;
        $ongkir   = $request->ongkir;
        $payment  = $request->payment;
        $delivery = $request->delivery;
        $service  = $request->service;
        $address  = $request->address;
        $payment  = $request->payment;
        $user_id  = Session::get('user_id');
        $validator = Validator::make($request->all(),[
            'delivery' => 'required',
            'service'  => 'required',
            'address'  => 'required',
            'payment'  => 'required',
            'ongkir'   => 'required|integer',
            'cart_id'  => 'required'
        ]);
        
        if ($validator->fails()) {
            alert()->error('ErrorAlert',$validator->errors()->first());
            return back();
        } 

        $cart  = Cart::where('id', '=', $cart_id)->first();
        if(isset($cart->variation_detail)): 
            $price = $cart->variation_detail->price;
            $totalqtyseller = $cart->variation_detail->qty - $cart->qty;
            Variationdetail::where('id', '=', $cart->variation_detail_id)->update([
                'qty'   => $totalqtyseller
            ]);
            $totalqtysellergeneral = $cart->product->qty - $cart->qty;
            Product::where('product_id', '=', $cart->product_id)->update([
                'qty' => $totalqtysellergeneral
            ]);
        else: 
            $price = $cart->product->price;
            $totalqtyseller = $cart->product->qty - $cart->qty;
            Product::where('product_id', '=', $cart->product_id)->update([
                'qty' => $totalqtyseller
            ]);
        endif; 
        $paymenttype = Paymenttype::where('payment_id', '=', $payment)->first();
        Storeorder::create([
            'product_name'          => $cart->product->product_name,
            'category_id'           => $cart->product->category_id,
            'user_id'               => $user_id,
            'qty'                   => $cart->qty,
            'price_product'         => $price,
            'note'                  => 'Proses Pembuktian',
            'seller_user_id'        => $cart->product->user_id,
            'variation_id'          => $cart->variation_id,
            'variation_name'        => $cart->variation->variation_name,
            'variation_detail_name' => $cart->variation_detail->name_detail_variation,
            'delivery_id'           => $cart->delivery_id,
            'service_name'          => $service,
            'address_id'            => $cart->address_id,
            'postal_code'           => $cart->address->postal_code,
            'city_id'               => $cart->address->city_id,
            'city_name'             => $cart->address->city_name,
            'province_id'           => $cart->address->province_id,
            'province_name'         => $cart->address->province_name,
            'accept_name'           => $cart->address->accept_name,
            'telp'                  => $cart->address->telp,
            'status'                => 4,
            'ongkir'                => $ongkir,
            'payment_id'            => $payment,
            'payment_name'          => $paymenttype->payment_name,
            'picture'               => $cart->product->picture
        ]);

        Cart::where('id', '=', $cart_id)->delete();

        alert()->success('Terima kasih untuk membeli selanjutnya mengirimkan bukti transfer pembayaran');
        return redirect()->route('approvepaymentview');


    }

    public function apiOngkir($param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 4d6444a58c240d9ed1038a8891738950"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function service(Request $request)
    {
            $delivery_id = $request->delivery_id;
            $cart_id     = $request->id;
            $weight      = $request->weight;
            $origin      = $request->origin;
            $cart        = Cart::where('id', '=', $cart_id)->first();
            $param       = "origin=".$origin."&destination=".$cart->address->city_id."&weight=".$weight."&courier=".$delivery_id;
            $ongkir      = $this->apiOngkir($param);
            Cart::where('id', '=', $cart_id)->update([
               'delivery_id'    => $delivery_id 
            ]);
            return json_encode([
                "status"     => "OK",
                "dataongkir" => $ongkir
            ]);
    }

    public function UpdateDelivery(Request $request)
    {
        $delivery_id = $request->delivery_id;
        $cart_id     = $request->id;
        $weight      = $request->weight;
        $origin      = $request->origin;
        $srvc        = $request->srvc;
        if ($request->ajax()) {
            $id  = $request->id;
            $qty = $request->qty;
            $cart = Cart::where('id', '=', $cart_id)->first();
            $param = "origin=".$origin."&destination=".$cart->address->city_id."&weight=".$weight."&courier=".$delivery_id;
            $ongkir = $this->apiOngkir($param);
            $service = $ongkir->rajaongkir->results[0]->costs;
            foreach($service as $srv):
                if($srv->service === $srvc):
                    $price = $srv->cost[0]->value;
                    $etd   = $srv->cost[0]->etd;
                endif;
            endforeach;
            if($id != NULL):
                Cart::where('id', '=', $cart_id)->update([
                    'delivery_id'   =>  $delivery_id,
                    'service'       => $srvc
                ]);
                return json_encode([
                    "status"     => "OK",
                    "dataongkir" => $price,
                    "day"        => $etd
                ]);
            endif;
        }
        return json_encode([
            "message" => 'sdfsd'
        ]);

    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $qty = $request->qty;
            if($id != NULL)
            Cart::where('id', '=', $id)->update([
                'qty'   =>  $qty
            ]);
            return json_encode([
                "status"  => "OK",
                "message" => $qty
            ]);
        }
        return json_encode([
            "message" => 'sdfsd'
        ]);
    }

    public function storeOrder(Request $request)
    {
        $product_id       = $request->product_id;
        $variationdetid   = $request->variation_detail;
        $qty              = $request->qty;
        $product          = Product::where('product_id', $product_id)->first();
        $variation_detail = Variationdetail::where('id',$variationdetid)->first();
        $user_id          = Session::get('user_id');
        if($variation_detail):
        $total_price      = $variation_detail * $qty;
        else: 
            $total_price = $product->price * $qty;
        endif;

        Storeorder::create([
            'product_name'  => $product->product_name,
            'category_id'   => $product->category_id,
            'user_id'       => $user_id,
            'qty'           => $qty,
            'total_price'   => $total_price,
            'note'          => 'Sedang melakukan pembayaran'
        ]);
        
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $pk = $request->pk;
            if($pk != NULL): 
                Cart::where('id', '=', $pk)->delete();

                return json_encode([
                    "status"    =>  "OK",
                    "message"   =>  "Hapus data berhasil"
                ]);
            endif;
                return json_encode([
                    "status"    =>  "OK",
                    "message"   =>  "Hapus data gagal"
                ]);
        }
    }
}
