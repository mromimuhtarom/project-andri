<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryOrderController extends Controller
{
    public function index()
    {
        return view('pages.historyorder');
    }
}
