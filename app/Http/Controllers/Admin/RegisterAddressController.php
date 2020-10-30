<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Session;
use Validator;

class RegisterAddressController extends Controller
{
    public function index() {
        $province = apiProvince('');
        return view('admin.pages.registeraddress', compact('province'));
    }
    public function update(Request $request) {
            $user_id = Session::get('user_id');
            $accept_name   = $request->accept_name;
            $telp          = $request->no_hp;
            $postalcode    = $request->postal_code;
            $province_id   = $request->province;
            $city_id       = $request->city;
            $district      = $request->kecamatan;
            $detailaddress = $request->address;
            $fullname      = $request->fullname;
            $data        = array(
                               'Nama Lengkap'          => $fullname,
                               'Nama Penerima'         => $accept_name,
                               'No Telp Penerima'      => $telp,
                               'Kode Pos'              => $postalcode,
                               'Provinsi'              => $province_id,
                               'Kota atau Kabupaten'   => $city_id,
                               'Kecamatan'             => $district,
                               'Alamat'                => $detailaddress
                           );
    
            $validator = Validator::make($data,[
                'Nama Lengkap'          => 'required|max:255',
                'Nama Penerima'         => 'required|max:100',
                'No Telp Penerima'      => 'required|numeric|regex:/(08)[0-9]{9}/',
                'Kode Pos'              => 'required',
                'Provinsi'              => 'required',
                'Kota atau Kabupaten'   => 'required',
                'Kecamatan'             => 'required',
                'Alamat'                => 'required',
            ]);
            
    
            if($validator->fails()):
                alert()->error('ErrorAlert', $validator->errors()->first()); 
                return back();
            endif;
    
    
            $provinceapi = apiProvince('');
            $cityapi     = apiCity('');
    
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
            User::where('user_id', $user_id)->update([
                'status'   => 1,
                'fullname' => $fullname
            ]);
            Address::create([
                'accept_name'    => $accept_name,
                'province_id'    => $province_id,
                'province_name'  => $province_name,
                'city_id'        => $city_id,
                'city_name'      => $city_name,
                'postal_code'    => $postalcode,
                'detail_address' => $detailaddress.','.$district,
                'user_id'        => $user_id,
                'telp'           => $telp,
                'status'         => 2
            ]);
    
            alert()->success('Alamat anda sudah di tambahkan');
            return redirect()->route('dashboard');
        
        
    }
}
