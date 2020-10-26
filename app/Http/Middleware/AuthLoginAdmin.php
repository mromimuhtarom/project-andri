<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\Config;

class AuthLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $login   = Session::get('login');
        $role_id = Session::get('role_id');
        $user_id = Session::get('user_id');
        $user    = User::where('user_id', $user_id)->first();
        $email   = Config::where('id', 4)->first();
        $telp    = Config::where('id', 5)->first();
        if($user->status != 0): 
            if($login == TRUE): 
                if($role_id != 4): 
                    return $next($request);
                else:
                    alert()->error('ErrorAlert', 'Mohon maaf anda tidak bisa mengakses ke halaman selanjutnya');
                    return redirect()->route('login');
                endif;
            else: 
                alert()->success('Akun anda telah keluar');
                return redirect()->route('login');        
            endif;
        else: 
            alert()->error('ErrorAlert', 'Mohon maaf akun anda sedang di nonaktifkan silahkan menghubingi ke email ini:'.$email->value.' atau no. telp:'.$telp->value);
            return redirect()->route('login');  
        endif;
    }
}
