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
            $cart = Cart::where('id', '=', $cart_id)->first();
            $param = "origin=".$origin."&destination=".$cart->address->city_id."&weight=".$weight."&courier=".$delivery_id;
            $ongkir = $this->apiOngkir($param);
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
            if($id != NULL)
            Cart::where('id', '=', $cart_id)->update([
                'delivery_id'   =>  $delivery_id,
                'service'       => $srvc
            ]);
            return json_encode([
                "status"     => "OK",
                "dataongkir" => $price,
                "day"        => $etd
            ]);
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
