<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class SvAuthController extends Controller
{
    /*
        API Controller
    */
    function createUserDB()
    {
        $user_list = DB::table('table_sinhvien')->get();
        $total = DB::table('table_sinhvien')->count('email');
        $i = 0;

        foreach ($user_list as $item) {
            $log = DB::table('table_sinhvien_taikhoan')->insert(['masv' => $item->masv, 'password' => Hash::make('secret')]);
            if ($log) {
                $i += 1;
                print_r("{$i}/{$total} - Add {$item->masv} to DB <hr/>");
            }
        }
    }

    function loginNew(Request $request)
    {
        $user_data = null;
        $token = uniqid();
        $response = null;
        $token_store = null;

        $user_data = DB::table('table_sinhvien_taikhoan')->join('table_sinhvien', 'table_sinhvien_taikhoan.masv', '=', 'table_sinhvien.masv')
            ->where('table_sinhvien.email', $request->email)
            ->first();

        if ($user_data) {
            if (Hash::check($request->password, $user_data->password)) {
                $data = DB::table('table_sinhvien')->where('table_sinhvien.masv', '=', $user_data->masv)->first();
                $data_chitiet = DB::table('table_sinhvien_chitiet')->where('table_sinhvien_chitiet.masv', '=', $user_data->masv)->first();
                if(isset($data_chitiet->avatar)){
                    $data_chitiet->avatar = asset($data_chitiet->avatar);
                }
                $token_store = DB::table('table_sinhvien_taikhoan')
                    ->where('table_sinhvien_taikhoan.masv', '=', $user_data->masv)
                    ->update(['token' => Hash::make($token), 'ftoken' => $request->ftoken, 'token_due' => Carbon::now()->addWeeks(3)]);
                $response = [
                    'code' => 1,
                    'msg' => "Đăng nhập thành công!",
                    'sinhvien_data' => $data,
                    'sinhvien_data_chitiet' => $data_chitiet,
                    'token' => $token
                ];
            } else {
                $response = [
                    'code' => 0,
                    'msg' => "Đăng nhập thất bại! Vui lòng kiểm tra lại thông tin",
                    'sinhvien_data' => null,
                    'sinhvien_data_chitiet' => null,
                    'token' => null
                ];
            }
        }

        return $response;
    }
    function loginToken(Request $request)
    {
        $user_data = null;
        $response = null;

        $user_data = DB::table('table_sinhvien_taikhoan')->join('table_sinhvien', 'table_sinhvien_taikhoan.masv', '=', 'table_sinhvien.masv')
            ->where('table_sinhvien.email', $request->email)
            ->first();
        if ($user_data) {
            if (Hash::check($request->token, $user_data->token)) {
                $data = DB::table('table_sinhvien')->where('table_sinhvien.masv', '=', $user_data->masv)->first();
                $data_chitiet = DB::table('table_sinhvien_chitiet')->where('table_sinhvien_chitiet.masv', '=', $user_data->masv)->first();
                if(isset($data_chitiet->avatar)){
                    $data_chitiet->avatar = asset($data_chitiet->avatar);
                }
                $response = [
                    'code' => 1,
                    'msg' => "Đăng nhập thành công!",
                    'sinhvien_data' => $data,
                    'sinhvien_data_chitiet' => $data_chitiet,
                    'token' => null
                ];
            } else {
                $response = [
                    'code' => 0,
                    'msg' => "Thông tin đăng nhập sai hoặc phiên đăng nhập đã hết hạn!",
                    'sinhvien_data' => null,
                    'sinhvien_data_chitiet' => null,
                    'token' => null
                ];
            }
        }
        return $response;
    }
    function logout(Request $request){
        $response = null;
        $logout = DB::table('table_sinhvien_taikhoan')->join('table_sinhvien', 'table_sinhvien_taikhoan.masv', '=', 'table_sinhvien.masv')->where('email', '=', $request->email)->update(['token' => '', 'token_due' => null]);
        if($logout){
            $response = [
                'code' => 1,
                'msg' => "Đăng xuất thành công!",
                'sinhvien_data' => null,
                'token' => null
            ];
        } else {
            $response = [
                'code' => 0,
                'msg' => "Có lỗi xảy ra khi đăng xuất!",
                'sinhvien_data' => null,
                'token' => null
            ];
        }
        return $response;
    }
    /*
        Web Controller
    */

    //Login

    public function webLoginView()
    {
        return view('Sv.Auth.login');
    }

    function webLogin(Request $request)
    {
        $login_info = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $data = null;
        $logged = false;

        $checkUser = DB::table('table_sinhvien_taikhoan')
            ->join('table_sinhvien', 'table_sinhvien.masv', '=', 'table_sinhvien_taikhoan.masv')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_sinhvien.email', '=', $request->email)
            ->first();
        if ($checkUser) {
            if (Hash::check($request->password, $checkUser->password)) {
                $logged = true;
                if($checkUser->avatar != null){
                    $data = [
                        'logged' => true,
                        'role' => 1,
                        'masv' => $checkUser->masv,
                        'avatar' => asset($checkUser->avatar),
                        'hoten' => $checkUser->hodem . $checkUser->ten
                    ];
                } else {
                    $data = [
                        'logged' => true,
                        'role' => 1,
                        'masv' => $checkUser->masv,
                        'hoten' => $checkUser->hodem . $checkUser->ten,
                        'avatar' => 'https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png'
                    ];
                }
            }
        }
        if ($logged) {
            $request->session()->put($data);
            return Redirect::route('suahoso');
        } else {
            return "Đăng nhập không thành công!";
        }
    }
    function webLogout(Request $request){
        Session::flush();
        return redirect(route('sv.login'));
    }

}
