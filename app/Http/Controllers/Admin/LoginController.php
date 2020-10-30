<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Config;
use Session;
use Cache;


class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function processlogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if(Auth::attempt(['username' => $username, 'password' => $password])): 
            if(Auth::user()->role_id != 4):
                Session::put('user_id', Auth::user()->user_id);
                Session::put('username', Auth::user()->username);
                Session::put('role_id', Auth::user()->role_id);
                Session::put('login', TRUE);
                if(Auth::user()->status != 2):
                    alert()->success('Selamat anda berhasil login');
                    return redirect()->route('dashboard');
                else:
                    alert()->success('Selamat anda berhasil login silahkan mengisisi data alamat lengkap anda');
                    return redirect()->route('registerAddress');
                endif;
            else : 
                Session::flush();
                Cache::flush();
                alert()->error('Mohon maaf anda tidak memiliki akses untuk login ini');
                return redirect('/admin');
            endif;
        else : 
            $telp  = Config::where('id', 5)->first();
            $email = Config::where('id', 4)->first();
            alert()->error('Mohon maaf nama pengguna dan kata sandi anda tidak ditemukan jika tetap tidak bisa hubungi ke no. ini'.$telp->value.' atau emain ini'.$email->value);
            return redirect('/admin');
        endif;
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        alert()->error('Terima Kasih telah Keluar dari akun anda');
        return redirect('/admin');
    }
}
