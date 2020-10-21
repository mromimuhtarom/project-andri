<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                alert()->success('Selamat anda berhasil login');
                return redirect()->route('dashboard');
            else : 
                Session::flush();
                Cache::flush();
                alert()->error('Mohon maaf anda tidak memiliki akses untuk login ini');
                return redirect('/admin');
            endif;
        else : 
            alert()->error('Mohon maaf nama pengguna dan kata sandi anda ada yang salah');
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
