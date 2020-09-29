<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        dd(Session::get('login'));
        return view('pages.dashboard');
    }
}
