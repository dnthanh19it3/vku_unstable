<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use mikehaertl\pdftk\Pdf;

class SvHosoController extends Controller
{


    /**
     *   Cập nhật dữ liệu sinh viên
     */
    public function suahosoStore(Request $request){
        $data = $this->validate($request,
            [
                "email_khac" => "nullable|email",
                "dienthoai" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
                "zalo" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
                "facebook" => ["nullable", "regex:/(?:http:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/"],
            ],
            [
                "email_khac" => "Định dạng email không đúng",
                "dienthoai" => "Định dạng số điện thoại không đúng",
                "zalo" => "Định dạng số điện thoại không đúng",
                "facebook" => "Định dạng số link facebook không đúng",
            ]);


        $update = DB::table('table_sinhvien_chitiet')->where('masv', session('masv'))->update($data);
        return back();
    }
    /**
     *   View sửa hồ sơ
     */
    public function suahosoIndex()
    {
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->where('table_sinhvien.masv', '=', session('masv'))
            ->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        if (isset($sinhvien->avatar)) {
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }

        return view('Sv.HoSo.SuaHoSo')->with([
            'sinhvien' => $sinhvien,
            'hocky' => $hocky_info,
        ]);
    }

    /**
     *  View hồ sơ
     */
    public function hosoIndex(Request $request){
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->where('table_sinhvien.masv', '=', session('masv'))
            ->first();
        $sinhvien->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", session('masv'))->get();
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        $khenthuong = DB::table('table_sinhvien_khenthuong')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('masv', session('masv'))
            ->get();
        $kyluat = DB::table('table_sinhvien_kyluat')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('masv', session('masv'))->get();
        $timeline = DB::table('table_sinhvien_timeline')->where('masv', session('masv'))->orderBy('thoigian', 'DESC')->get();

        $renluyen = DB::table('table_danhgiarenluyen')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_danhgiarenluyen.masv', session('masv'))
            ->get();


        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png"; // Nếu chưa có hồ sơ thay bằng ảnh trắng
        }

        return view('Sv.HoSo.xemhoso')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvienTamtru', $sinhhvienTamtru)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('timeline', $timeline)
            ->with('renluyen', $renluyen);
    }
}



