<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return view('admin.pages.category', compact('category'));
    }

    public function store(Request $request) {
        $categoryname = $request->category_name;
        $data         = $request->all();
        $data['Nama Kategori'] = $categoryname;
        $validator = Validator::make($data,[
            'Nama Kategori' =>  'required|max:255'
        ]);

        if($validator->fails()): 
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        Category::create([
            'category_name' => $categoryname,
            'parent_id' =>  0
        ]);

        alert()->success('Data berhasil ditambahkan');
        return back();
        
    }

    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        if(strlen($value) > 255):
            return response()->json('Nama kategori tidak boleh melebihi dari 255 karakter', 400);
        endif;

        Category::where('category_id', $pk)->update([
            $name => $value
        ]);
    }
}
