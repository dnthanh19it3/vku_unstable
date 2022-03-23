<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon;


class SvHosoController extends Controller
{
    /**
     *   Cập nhật dữ liệu sinh viên
     */
    public function suahosoStore(Request $request){
        $masv = session('masv');
        $flag = 1;

//        $data = $this->validate($request,
//            [
//                "email_khac" => "nullable|email",
//                "dienthoai" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
//                "zalo" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
//                "facebook" => ["nullable", "regex:/(?:http:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/"],
//            ]);

        $data = $request->all();
        $data['updated_at'] = Carbon::now();
        unset($data['_token']);


        $update = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->update($data);
        if (!$update) {
            $flag = 0;
        }
        if ($flag) {
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 1,
                'chitiet' => "$masv đã cập nhật thông tin liên hệ",
                'created_at' => Carbon::now()
            ]);
            return back();
        } else {
            return back();
        }
    }
    /**
     *   View sửa hồ sơ
     */
    public function suahosoIndex()
    {

        $masv = session('masv');

        $sinhvien_static = $this->getSinhVien($masv);

        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->where('table_sinhvien.masv', '=', $masv)
            ->first();

        if(!$sinhvien) {die('Không tìm thấy thông tin sinh viên');}

        switch ($sinhvien->doanthe) {
            case 0:
                $sinhvien->doanthe = "Không";
                break;
            case 1:
                $sinhvien->doanthe = "Đoàn viên";
                break;
            case 2:
                $sinhvien->doanthe = "Đảng viên";
                break;
        }

        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();

        return view('Sv.HoSo.SuaHoSo')->with([
            'sinhvien' => $sinhvien,
            'sinhvien_static' => $sinhvien_static,
            'hocky' => $hocky_info
        ]);
    }

    /**
     *  View hồ sơ
     */
    public function hosoIndex(Request $request){
        $masv = session('masv');
        $sinhvien = $this->getSinhVien($masv);
        $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->first();

        if(!$sinhvien || !$sinhvien_chitiet){
            die("Không tìm thấy thông tin sinh viên!");
        }

        $sinhvien_chitiet->thanhphangiadinh = ($sinhvien_chitiet->thanhphangiadinh != null) ? explode('|', $sinhvien_chitiet->thanhphangiadinh) : null;

        switch ($sinhvien_chitiet->doanthe) {
            case 0:
                $sinhvien_chitiet->doanthe = "Không";
                break;
            case 1:
                $sinhvien_chitiet->doanthe = "Đoàn viên";
                break;
            case 2:
                $sinhvien_chitiet->doanthe = "Đảng viên";
                break;
        }

        $khenthuong = DB::table('table_sinhvien_khenthuong')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('table_sinhvien_khenthuong.masv', $masv)->where('table_sinhvien_khenthuong.trangthai', 1)
            ->get();

        $kyluat = DB::table('table_sinhvien_kyluat')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('table_sinhvien_kyluat.trangthai', 1)
            ->where('table_sinhvien_kyluat.masv', $masv)->get();
        //Tam tru
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $masv)
            ->where('table_sinhvien_tamtru.trangthai', '=', 1)
            ->orderBy('table_sinhvien_tamtru.created_at', 'desc')
            ->get([
                'table_sinhvien_tamtru.id',
                'table_sinhvien_tamtru.masv',
                'table_sinhvien_tamtru.hocky',
                'table_sinhvien_tamtru.namhoc',
                'table_sinhvien_tamtru.sonha',
                'table_sinhvien_tamtru.thonto',
                'table_static_provinces.name as tinhthanh',
                'table_static_districts.name as quanhuyen',
                'table_static_wards.name as xaphuong',
                'table_sinhvien_tamtru.thoigianbatdau',
                'table_sinhvien_tamtru.tenchuho',
                'table_sinhvien_tamtru.sdtchuho',
                'table_sinhvien_tamtru.hienhanh',
                'table_sinhvien_tamtru.created_at',
                'table_namhoc_hocky.nambatdau',
                'table_namhoc_hocky.namketthuc'
            ]);
        $log_sinhvien = DB::table('table_log_sinhvien')->join('table_log_loai', 'table_log_sinhvien.id_log_loai', '=', 'table_log_loai.id')->where('masv', $masv)->orderBy('created_at', 'DESC')->get();
        $renluyen = DB::table('table_danhgiarenluyen')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_danhgiarenluyen.masv', $masv)
            ->get();
        //Get Chart data
        $renluyen_chart = [
            'value' => [],
            'label' => []
        ];
        foreach ($renluyen as $key => $item){
            array_push($renluyen_chart['value'], $item->diem);
            array_push($renluyen_chart['label'], 'HK '.$item->hocky .' '.$item->nambatdau."-".$item->namketthuc);
        }




        return view('Sv.HoSo.xemhoso')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvien_chitiet', $sinhvien_chitiet)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('log_sinhvien', $log_sinhvien)
            ->with('renluyen', $renluyen)
            ->with('renluyen_chart', $renluyen_chart)
            ->with('tamtru', $tamtru);
    }
    // Helper function
    function getSinhVien($masv){
        $sinhvien = null;
        $sinhvien_all = json_decode(Storage::disk('public')->get(("config/sinhvien_full.json")));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien = $item;
                break;
            }
        }
        if($sinhvien!=null){
            return $sinhvien;
        } else {
            return null;
        }
    }
}
