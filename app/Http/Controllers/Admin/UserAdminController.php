<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Validator;
use Session;

class UserAdminController extends Controller
{
    public function index(Request $request) {
        $username = $request->username;
        $tbuser = User::join('role', 'role.role_id', '=', 'user.role_id')
                ->whereIn('user.role_id', array(1,3,4));

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

    public function store(Request $request) {
        $username = $request->username;
        $pwd      = $request->password;
        $role     = $request->role;
        $data     = $request->all();
        $bcrypt   = bcrypt($pwd);
        $data['Nama Pengguna'] = $username;
        $data['Kata Sandi']    = $pwd;
        $data['Peran']         = $role;

        $validator = Validator::make($data,[
            'Nama Pengguna' => 'required|regex:/^\S*$/u|regex:/[a-z]/|unique:user,username|max:25',
            'Kata Sandi'    => 'required|max:8',
            'Peran'         => 'required'
        ]);

        if($validator->fails()): 
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        User::create([
            'username'  =>  $username,
            'password'  =>  $bcrypt,
            'role_id'   =>  $role,
            'status'    =>  2
        ]);

        alert()->success('Akun Admin telah ditambahkan');
        return back();
    }

    public function resetPwd(Request $request){
        $thispwd = $request->thispass;
        $pwd     = $request->newpwd;
        $data    = $request->all();
        $pk      = $request->pk;
        $user_id = Session::get('user_id');
        $data['Kata Sandi yang sedang login']   = $thispwd;
        $data['Kata Sandi baru untuk akun ini'] = $pwd;

        $validator = Validator::make($data,[
            'pk'                             => 'required',
            'Kata Sandi yang sedang login'   => 'required',
            'Kata Sandi baru untuk akun ini' => 'required|max:6'
        ]);

        if($validator->fails()):
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        $user = User::where('user_id', $user_id)->first();

        if(!password_verify($thispwd, $user->password)):
            alert()->error('ErrorAlert', 'Kata sandi anda tidak cocok silahkan coba lagi');
            return back();
        endif;

        $bcrypt = bcrypt($pwd);
        User::where('user_id', $pk)->update([
            'password'  => $bcrypt
        ]);

        alert()->success('Kata Sandi berhasil di ubah');
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

    public function delete(Request $request) {
        $pk = $request->pk;
        
        $validator = Validator::make($request->all(),[
            'pk' => required
        ]);

        if($validator->fails()): 
            alert()->error('ErrorAlert', $validator->errors()->first());
            return back();
        endif;

        User::where('user_id', $pk)->delete();

        alert()->success('Hapus data telah berhasil');
        return back();
    }
}
