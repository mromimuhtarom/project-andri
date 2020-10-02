<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Session::get('user_id');
        $profile = User::where('user_id', $user_id)->first();
        if($request->ajax()): 
                return json_encode([
                    "data" => $profile
                ]);
        else: 
            return view('user.pages.profile', compact('profile'));
        endif;
    }
}
