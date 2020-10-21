<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

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
    }
}
