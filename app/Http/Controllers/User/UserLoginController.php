<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Cache;
use Validator;
use App\Models\Address;
use App\Models\Config;

class UserLoginController extends Controller
{
    public function index()
    {
        if(Session::get('login')): 
            return back();
        endif;
        return view('user.pages.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user    = User::where('username', $username)->first();
        $email   = Config::where('id', 4)->first();
        $telp    = Config::where('id', 5)->first();

        if($user->status == 0): 
            alert()->error('ErrorAlert', 'Mohon maaf akun anda sedang di nonaktifkan silahkan menghubingi ke email ini:'.$email->value.' atau no. telp:'.$telp->value);
            return redirect()->route('home-view');
        endif;

        // dd($username);
        if(Auth::attempt(['username' => $username, 'password' => $password])): 
            Session::put('user_id', Auth::user()->user_id);
            Session::put('username', Auth::user()->username);
            Session::put('login', TRUE);
            Session::put('role_id', Auth::user()->role_id);
            alert()->success('Selamat anda berhasil login');
            return redirect()->route('home-view');
        else:
            alert()->error('Mohon maaf nama pengguna dan kata sandi anda ada yang salah');
            return redirect()->route('home-view');
        endif;
    }

    public function registerview()
    {
        $province = apiProvince('');
        return view('user.pages.register', compact('province'));
    }

    public function city(Request $request) {
        $province_id  = $request->province_id;
        $param = 'province='.$province_id;
        $city = apiCity($param);
        return json_encode([
            "city" => $city
        ]);
    }

    public function storeRegister(Request $request) {
        $username      = $request->username;
        $firstname     = $request->front_name;
        $lastname      = $request->last_name;
        $accept_name   = $request->accept_name;
        $telp          = $request->no_hp;
        $postalcode    = $request->postal_code;
        $province_id   = $request->province;
        $city_id       = $request->city;
        $district      = $request->kecamatan;
        $detailaddress = $request->address;
        $newpwd        = $request->password;
        $confirmpwd    = $request->confirmpassword;
        $data        = array(
                           'Nama Pengguna'         => $username,
                           'Nama Depan'            => $firstname,
                           'Nama Belakang'         => $lastname,
                           'Nama Penerima'         => $accept_name,
                           'No Telp Penerima'      => $telp,
                           'Kode Pos'              => $postalcode,
                           'Provinsi'              => $province_id,
                           'Kota atau Kabupaten'   => $city_id,
                           'Kecamatan'             => $district,
                           'Alamat'                => $detailaddress,
                           'Kata Sandi'            => $newpwd,
                           'Konfirmasi Kata Sandi' => $confirmpwd
                       );

        if ((preg_match("/[^a-z0-9_]/", $username)) ):
            alert()->error('ErrorAlert', 'Nama Pengguna harus huruf kecil dan hanya di perbolehkan angka dan huruf');
            return back();
        endif;
        $validator = Validator::make($data,[
            'Nama Pengguna'         => 'required|regex:/^\S*$/u|regex:/[a-z]/|unique:user,username|max:25',
            'Nama Depan'            => 'required|max:127',
            'Nama Belakang'         => 'required|max:127',
            'Nama Penerima'         => 'required|max:100',
            'No Telp Penerima'      => 'required|numeric|regex:/(08)[0-9]{9}/',
            'Kode Pos'              => 'required',
            'Provinsi'              => 'required',
            'Kota atau Kabupaten'   => 'required',
            'Kecamatan'             => 'required',
            'Alamat'                => 'required',
            'Kata Sandi'            => 'required|regex:/^\S*$/u|max:255',
            'Konfirmasi Kata Sandi' => 'required|same:Kata Sandi|regex:/^\S*$/u|max:255'
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
        $bcrypt = bcrypt($newpwd);

        $user = User::create([
                    'username'  =>  $username,
                    'password'  =>  $bcrypt,
                    'fullname'  =>  $firstname.' '.$lastname,
                    'role_id'   =>  4
                ]);

        Address::create([
            'accept_name'    => $accept_name,
            'province_id'    => $province_id,
            'province_name'  => $province_name,
            'city_id'        => $city_id,
            'city_name'      => $city_name,
            'postal_code'    => $postalcode,
            'detail_address' => $detailaddress.','.$district,
            'user_id'        => $user->id,
            'telp'           => $telp,
            'status'         => 2
        ]);

        alert()->success('Akun anda terdaftar silahkan login untuk melakukan selanjutnya');
        return redirect()->route('loginuser');
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        alert()->error('Terima Kasih telah Keluar dari akun anda');
        return redirect()->route('home-view');
    }
}
