<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storeorder;
use Session;

class ProcessController extends Controller
{
    public function index()
    {
        $user_id    = Session::get('user_id');
        $storeorder = Storeorder::where('user_id', '=', $user_id)
                      ->where('status', 2)
                      ->get();
        return view('user.pages.process', compact('storeorder'));
    }
}
