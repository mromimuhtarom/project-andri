<?php

namespace App\Http\Controllers;

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
        return view('login');
    }

    public function processlogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if(Auth::attempt(['username' => $username, 'password' => $password])): 
            Session::put('user_id', Auth::user()->user_id);
            Session::put('username', Auth::user()->username);

            return redirect()->route('dashboard');
        endif;
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        return redirect('/')->with('alert', 'Terima Kasih telah Keluar dari akun anda');
    }
}
