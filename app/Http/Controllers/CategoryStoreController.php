<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryStoreController extends Controller
{
    public function index()
    {
        return view('user.pages.category');
    }
}
