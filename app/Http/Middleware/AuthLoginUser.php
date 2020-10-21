<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class AuthLoginUser
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
        if($login == TRUE):
            return $next($request);
        else: 
            alert()->success('Akun anda telah keluar');
            return redirect()->route('loginuser');  
        endif;
    }
}
