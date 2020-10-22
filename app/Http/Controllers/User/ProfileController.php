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
        $province = apiProvince('');
        $city     = apiCity('');
        if($request->ajax()):
                $province_id  = $request->province_id;
                $param = 'province='.$province_id;
                $city = apiCity($param);
                return json_encode([
                    "data" => $profile,
                    "city" => $city
                ]);
        else: 
            return view('user.pages.profile', compact('profile', 'province', 'city'));
        endif;
    }

    public function storeAddress(Request $request)
    {
        $accept_name = $request->accept_name;
        $postal_code = $request->postal_code;
        $province_id = $request->province;
        $city_id     = $request->city;
        $tlp         = $request->telp;
        $detail      = $request->detail_address;
        $provinceapi = apiProvince('');
        $cityapi     = apiCity('');
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
        $utama       = $request->utama;
        $provinceapi = apiProvince('');
        $cityapi     = apiCity('');
        $address_id  = $request->address_id;
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

        if($utama != NULL): 
            $validatorstatus = Validator::make($request->all(),[
                'utama' =>  'required'
            ]);
            if($validatorstatus->fails()): 
                alert()->error('ErrorAlert', $validatorstatus->errors()->first());
                return back();
            endif;
            $address = Address::where('user_id', '=', $user_id)->get();
            $addressid = Address::where('address_id', '=', $address_id)->first();
    
            if($addressid->status != $utama): 
                Address::where('address_id', '=', $address_id)->update([
                    'status'    =>  $utama
                ]);
                foreach($address as $ads):
                    if($ads->address_id != $address_id):
                    Address::where('address_id', '=', $ads->address_id)->update([
                        'status' => 1
                    ]);
                    endif;
                endforeach;
            else:
                Address::where('address_id', '=', $address_id)->update([
                    'status'    =>  $utama
                ]);
            endif;

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

    public function deleteAddress(Request $request) {
        $pk = $request->pk;

        $validator = Validator::make($request->all(),[
            'pk'    =>  'required'
        ]);

        if($validator->fails()): 
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        Address::where('address_id', '=', $pk)->delete();

        alert()->success('Alamat berhasil di hapus');
        return back();
    }
}
