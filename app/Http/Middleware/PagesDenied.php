<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Http\Response;

class PagesDenied
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $menu_id)
    {
        $role_id = Session::get('role_id');
        if(roletype1($menu_id, $role_id)):
            return $next($request);
        else:
            return new Response(view('admin.pages_denied'));
        endif;
    }
}
