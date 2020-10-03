<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Session::get('user_id');
        $profile = User::where('user_id', $user_id)->first();
        $province = $this->apiProvinceCity('');
        if($request->ajax()):
                $province_id  = $request->province_id;
                $param = 'province='.$province_id;
                $city = $this->apiProvinceCity($param);
                return json_encode([
                    "data" => $profile,
                    "city" => $city
                ]);
        else: 
            return view('user.pages.profile', compact('profile', 'province'));
        endif;
    }

    public function curlApirajaongkir($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 074c790dd88f6b0c76522f233b530af3"
            ),
        ));

        return $curl;
    }

    public function apiProvinceCity($param)
    {
        if($param != NULL): 
            $param = "?".$param;
        else: 
            $param = '';
        endif;
        $url = "https://api.rajaongkir.com/starter/city".$param;
        $curl = $this->curlApirajaongkir($url);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return json_decode($response);
        }        
    }

    // public function apiCity()
    // {
    //     $url = "https://api.rajaongkir.com/starter/province";
    //     $curl = $this->curlApirajaongkir($url);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         return "cURL Error #:" . $err;
    //     } else {
    //         return json_decode($response);
    //     } 
    // }
}
