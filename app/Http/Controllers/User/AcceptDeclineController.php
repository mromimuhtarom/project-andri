<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Storeorder;

class AcceptDeclineController extends Controller
{
    public function index()
    {
        $user_id    = Session::get('user_id');
        $storeorder = Storeorder::where('user_id', '=', $user_id)
                      ->where('status', array(1,2,3))
                      ->get();
        return view('user.pages.acceptdecline', compact('storeorder'));
    }
}
