<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    function webLoginView(Request $request){
        return view('Admin.Auth.login');
    }
    function webLogin(Request $request){
        $data = null;
        $check = DB::table('table_chuyenvien_taikhoan')->where('email', $request->email)->where('password', $request->password)->first();
        if($check){
            $data = [
                'logged' => true,
                'role' => 0,
                'avatar' => "https://looseends.nl/wp-content/uploads/2021/01/avatar-anonymous-300x300-1.png",
                'hoten' => $check->tenchuyenvien
            ];
            session()->put($data);
            return redirect(route('admin.thutuc.dashboard'));
        } else {
            return redirect(route('admin.login.view'));
        }
    }
    function webLogout(Request $request){
        Session::flush();
        return redirect(route('admin.login.view'));
    }
}
