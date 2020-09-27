<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricegroup;
use Session;

class GroupHargaController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');
        $pricegroup = Pricegroup::where('user_id', '=', $user_id)->get();
        return view('pages.groupharga', compact('pricegroup'));
    }

    public function store(Request $request)
    {
        $user_id = Session::get('user_id');
        $name    = $request->name;
        $harga   = $request->harga;

        Pricegroup::create([
            'name'    => $name,
            'price'   => $harga,
            'user_id' => $user_id
        ]);

        return back()->with('success', 'input data telah berhasil');


    }
}
