<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupHargaController extends Controller
{
    public function index()
    {
        return view('pages.groupharga');
    }
}
