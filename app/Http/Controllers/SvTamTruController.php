<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SvTamTruController extends Controller
{
    /**
     * View tạm trú
     * @return View Tạm trú
     */
    function tamTruIndex(Request $request){
        $masv = session('masv');

        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        $khaibaohientai = DB::table('table_sinhvien_tamtru')
            ->where('masv', $masv)
            ->where('trangthai', 1)
            ->where('hienhanh', 1)
            ->where('namhoc', $hocky_info->id)
            ->where('hocky', $hocky_info->hocky)
            ->first();


        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $sinhvien->masv)
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

        return view('Sv.HoSo.TamTruIndex')->with([
            'tamtru' => $tamtru,
            'hocky' => $hocky_info,
            'khaibaohientai' => $khaibaohientai
        ]);

    }
    /**
     *  View tạo tạm trú
     */
    public function taoTamTru(Request $request){
        $masv = session('masv');

        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', $masv)
            ->where('id', '=', $request->tamtru_id)
            ->first();
        if($request->tamtru_id){
            if(!$tamtru){die("Bạn không được phép truy cập bản ghi tạm trú này!");}
        }
        $tamtrukey =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', $masv)
            ->orderBy('created_at', 'desc')
            ->first();
        $tamtrukey = ($tamtrukey != null) ? $tamtrukey->id : null;
        $tinhthanh = DB::table('table_static_provinces')->orderBy('name')->get();

        return view('Sv.HoSo.TaoTamTru')->with([
            'tamtru' => $tamtru,
            'tamtrukey' => $tamtrukey,
            'tinhthanh' => $tinhthanh
        ]);
    }


    /**
     *
     * Tạm trú mới: Mỗi lần khai báo tạm trú mới sẽ chuyển trạng thái tạm trú về 0
     */
    public function taoTamTruStore(Request $request){
        $flag = 1;
        $masv = session('masv');

        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first(); // Thông tin học kì
        $tamtrucu = DB::table('table_sinhvien_tamtru')->where('masv', $masv)->where('trangthai', 1)->first();    //Tạm trú cũ

        $msg = [];
        $error = 0;

        $email_regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $phone_regex = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';

        $data = [];

        $validate_sdt = preg_match($phone_regex, $request->sdtchuho);
        // Validate số điện thoại
        if($validate_sdt){
            $data['sdtchuho'] = $request->sdtchuho;
        } else {
            array_push($msg, "SĐT chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->xaphuong_id && $request->quanhuyen_id && $request->tinhthanh_id && $request->sonha && $request->thonto){
            $data['xaphuong_id'] = $request->xaphuong_id;
            $data['quanhuyen_id'] = $request->quanhuyen_id;
            $data['tinhthanh_id'] = $request->tinhthanh_id;
            $data['sonha'] = $request->sonha;
            $data['thonto'] = $request->thonto;
        } else {
            array_push($msg, "Địa chỉ không hợp lệ");
            $error = 1;
        }
        if($request->tenchuho){
            $data['tenchuho'] = $request->tenchuho;
        } else {
            array_push($msg, "Tên chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->thoigianbatdau){
            $data['thoigianbatdau'] = $request->thoigianbatdau;
        } else {
            array_push($msg, "Thời gian bắt đầu không được bỏ trống");
            $error = 1;
        }

        // Loi input, tra ve thong bao loi
        if($error){
            $request->session()->flash('error', $msg);
            return redirect(route('sv.tamtru.index'));
        }
        // Tiep tuc cap nhat
        $data['trangthai'] = 1;
        $data['hienhanh'] = 1;
        $data['created_at'] = Carbon::now();
        $data['masv'] = $masv;
        $data['namhoc'] = $hocky_info->id;
        $data['hocky'] = $hocky_info->hocky;

        foreach ($data as $key => $value) {
            $value = trim($value);
        }

        // Đổi trạng thái tạm trú cũ sang 0
        $disabletamtrucu = DB::table('table_sinhvien_tamtru')
            ->where('masv', $masv)
            ->update(['hienhanh' => 0]);
        // Tạo bản ghi mới
        $insert = DB::table('table_sinhvien_tamtru')->insert($data);
        if (!$insert) {
            $flag = 0;
        } else {
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 2,
                'created_at' => Carbon::now()
            ]);
        }
        // Cập nhật lại route quay về bảng chi tiết, thêm thông báo thành công!
        if($flag){
            $request->session()->flash('success', "Cập nhật thành công!");
            return redirect(route('sv.tamtru.index'));
        } else {
            $request->session()->flash('error', "Cập nhật thất bại!");
            return redirect(route('sv.tamtru.index'));
        }

    }

    /**
     * Get quan huyen
     */
    function getQuanHuyen(Request $request){
        $quanhuyen = DB::table('table_static_districts')->where('province_id', $request->tinhthanh_id)->get();
        return $quanhuyen;
    }
    /**
     * Get xa phuong
     */
    function getXaPhuong(Request $request){
        $xaphuong = DB::table('table_static_wards')->where('district_id', $request->quanhuyen_id)->get();
        return $xaphuong;
    }
}
