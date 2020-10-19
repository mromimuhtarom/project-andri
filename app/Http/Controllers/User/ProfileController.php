<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\Address;
use Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user_id  = Session::get('user_id');
        $profile  = User::where('user_id', $user_id)->first();
        $province = $this->apiProvince('');
        $city     = $this->apiCity('');
        if($request->ajax()):
                $province_id  = $request->province_id;
                $param = 'province='.$province_id;
                $city = $this->apiCity($param);
                return json_encode([
                    "data" => $profile,
                    "city" => $city
                ]);
        else: 
            return view('user.pages.profile', compact('profile', 'province', 'city'));
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
                "key: 4d6444a58c240d9ed1038a8891738950"
            ),
        ));

        return $curl;
    }

    public function apiCity($param)
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

    public function apiProvince($param)
    {
        if($param != NULL): 
            $param = "?".$param;
        else: 
            $param = '';
        endif;
        $url = "https://api.rajaongkir.com/starter/province".$param;
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

    public function storeAddress(Request $request)
    {
        $accept_name = $request->accept_name;
        $postal_code = $request->postal_code;
        $province_id = $request->province;
        $city_id     = $request->city;
        $tlp         = $request->telp;
        $detail      = $request->detail_address;
        $provinceapi = $this->apiProvince('');
        $cityapi     = $this->apiCity('');
        $user_id     = Session::get('user_id');
        $validator_general = Validator::make($request->all(),[
            'accept_name'     => 'required',
            'postal_code'     => 'required',
            'province'        => 'required',
            'city'            => 'required',
            'telp'            => 'required',
            'detail_address'  => 'required'
        ]);
        
        if ($validator_general->fails()) {
            alert()->error('ErrorAlert', $validator_general->errors()->first());
            return back();
        }
        foreach ($provinceapi->rajaongkir->results as $pv):
            if($pv->province_id == $province_id):
                    $province_name = $pv->province;
            endif;
        endforeach;
        if($province_name == NULL): 
            alert()->error('ErrorAlert', 'Provinsi tidak ada');
            return back();
        endif;
        foreach ($cityapi->rajaongkir->results as $ct):
            if($ct->city_id == $city_id):
                $city_name = $ct->city_name;
            endif;
        endforeach;

        if($city_name == NULL): 
            alert()->error('ErrorAlert', 'Kota tidak ada');
            return back();
        endif;
        $addrs = Address::where('user_id', '=', $user_id)->get();
        $sttsadd = array();
        foreach ($addrs as $ad):
            $sttsadd[] .= $ad->status;
        endforeach;
        if (in_array(2, $sttsadd)):
            $sttsadrs = 1;
        else: 
            $sttsadrs = 2;
        endif;
        Address::create([
            'accept_name'    => $accept_name,
            'province_id'    => $province_id,
            'province_name'  => $province_name,
            'city_id'        => $city_id,
            'city_name'      => $city_name,
            'postal_code'    => $postal_code,
            'detail_address' => $detail,
            'user_id'        => $user_id,
            'telp'           => $tlp,
            'status'         => $sttsadrs
        ]);

        alert()->success('Input data telah berhasil');
        return back();
    }

    public function updateprofile(Request $request)
    {
        $user_id        = Session::get('user_id');
        $username       = $request->username;
        $fullname       = $request->fullname;

        User::where('user_id', '=', $user_id)->update([
            'username'  =>  $username,
            'fullname'  =>  $fullname
        ]);

        alert()->success('Edit data telah berhasil');
        return back();
    }

    public function updatepassword(Request $request)
    {
        $new     = $request->newpaddword;
        $confirm = $request->confirmpassword;
        $user_id = Session::get('user_id');
        $encryptpwd = bcrypt($new);

        if($new != $confirm):
            alert()->error('ErrorAlert', 'Katasandi baru dengan konfirmasi tidak sama silahkan ulang kembali'); 
            return back();
        endif;

        User::where('user_id', '=', $user_id)->update([
            'password'  => $encryptpwd
        ]);
    }

    public function updateAddress(Request $request)
    {
        $accept_name = $request->accept_name;
        $postal_code = $request->postal_code;
        $province_id = $request->province;
        $city_id     = $request->city;
        $tlp         = $request->telp;
        $detail      = $request->detail_address;
        $provinceapi = $this->apiProvince('');
        $cityapi     = $this->apiCity('');
        $address_id  = $request->address_id;

        $validator_general = Validator::make($request->all(),[
            'accept_name'     => 'required',
            'postal_code'     => 'required',
            'province'        => 'required',
            'city'            => 'required',
            'telp'            => 'required',
            'detail_address'  => 'required'
        ]);
        
        if ($validator_general->fails()) {
            alert()->error('ErrorAlert', $validator_general->errors()->first());
            return back();
        }
        foreach ($provinceapi->rajaongkir->results as $pv):
            if($pv->province_id == $province_id):
                    $province_name = $pv->province;
            endif;
        endforeach;
        if($province_name == NULL): 
            alert()->error('ErrorAlert', 'Provinsi tidak ada');
            return back();
        endif;
        foreach ($cityapi->rajaongkir->results as $ct):
            if($ct->city_id == $city_id):
                $city_name = $ct->city_name;
            endif;
        endforeach;

        if($city_name == NULL): 
            alert()->error('ErrorAlert', 'Kota tidak ada');
            return back();
        endif;

        Address::where('address_id', '=', $address_id)->update([
            'accept_name'    => $accept_name,
            'province_id'    => $province_id,
            'province_name'  => $province_name,
            'city_id'        => $city_id,
            'city_name'      => $city_name,
            'postal_code'    => $postal_code,
            'detail_address' => $detail,
            'telp'           => $tlp
        ]);

        alert()->success('Edit data telah berhasil');
        return back();
    }
}
