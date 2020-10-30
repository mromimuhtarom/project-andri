<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Validator;

class UserAdminController extends Controller
{
    public function index(Request $request) {
        $username = $request->username;
        $tbuser = User::join('role', 'role.role_id', '=', 'user.role_id')
                ->whereIn('user.role_id', array(1,2,3));

        if($username != NULL): 
            if(is_numeric($username) != TRUE):
                $user = $tbuser->where('user.username', 'LIKE', '%'.$username.'%')
                        ->paginate(20); 
            else: 
                $user = $tbuser->where('user.user_id', $username)
                        ->paginate(20);
            endif;
        else: 
            $user = $tbuser->paginate(20);
        endif;
    
        return view('admin.pages.useradmin', compact('user', 'username'));
    }

    public function store(Request $request){
        $username = $request->username;
        $role     = $request->role;
        $password = $request->password;
        $data     = $request->all();
        $bcrypt   = bcrypt($password);
        $data['Nama Pengguna']  = $username;
        $data['Kata Sandi']     = $password;
        $data['Peran']          = $role;

        $validator = Validator::make($data,[
            'Nama Pengguna' =>  'required|regex:/^\S*$/u|regex:/[a-z]/|unique:user,username|max:25',
            'Kata Sandi'    =>  'required|max:6',
            'Peran'         =>  'required'
        ]);

        User::create([
            'username' => $username,
            'password' => $bcrypt,
            'role_id'  => $role
        ]);

        alert()->success('Admin')
        return back();
    }

    public function Address(Request $request) {
        $user_id = $request->user_id;
        $user = User::join('role', 'role.role_id', '=', 'user.role_id')
                ->where('user_id', $user_id)
                ->whereIn('user.role_id', array(1,2,3))
                ->first();
        $address = Address::where('user_id', $user_id)->get();

        return json_encode([
            "status"      => "OK",
            "datauser"    => $user,
            "dataaddress" => $address
        ]);
    }

    public function updateStatus(Request $request){
        $pk     = $request->pk;
        $status = $request->status;
        $note   = $request->catatan;
        $data   = $request->all();
        
        $validator = Validator::make($data,[
            'pk'      => 'required',
            'status'  => 'required',
            'catatan' => 'required'
        ]);

        if($validator->fails()): 
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        User::where('user_id', $pk)->update([
            'status' => $status
        ]);

        alert()->success('Ubah Status Berhasil');
        return back();
    }
}
