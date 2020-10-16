<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Cache;

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
        // dd($username);
        if(Auth::attempt(['username' => $username, 'password' => $password])): 
            Session::put('user_id', Auth::user()->user_id);
            Session::put('username', Auth::user()->username);
            Session::put('login', TRUE);
            alert()->success('Selamat anda berhasil login');
            return redirect()->route('home-view');
        else:
            alert()->error('Mohon maaf nama pengguna dan kata sandi anda ada yang salah');
            return redirect()->route('home-view');
        endif;
    }

    public function registerview()
    {
        return view('user.pages.register');
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        alert()->error('Terima Kasih telah Keluar dari akun anda');
        return redirect()->route('home-view');
    }
}
