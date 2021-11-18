<?php

namespace App\Http\Controllers;

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
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        $khaibaohientai = DB::table('table_sinhvien_tamtru')->where(['masv' => session('masv'), 'namhoc' => $hocky_info->id, 'hocky' => $hocky_info->hocky])->first();
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $sinhvien->masv)
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
                'table_sinhvien_tamtru.trangthai',
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
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
            ->where('id', '=', $request->tamtru_id)
            ->where('masv', session('masv'))
            ->first();

        $tamtrukey =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
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
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first(); // Thông tin học kì
        $tamtrucu = DB::table('table_sinhvien_tamtru')->where('masv', session('masv'))->where('trangthai', 1)->first();    //Tạm trú cũ

        $data = $request->validate([
            'sonha' => ['required', 'regex:/[^a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/'],
            'thonto' => 'required',
            'xaphuong_id' => 'required|numeric',
            'quanhuyen_id' => 'required|numeric',
            'tinhthanh_id' => 'required|numeric',
            'tenchuho' => ['required', 'regex:/[^a-z0-9A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/'],
            'sdtchuho' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})/'],
            'thoigianbatdau' => 'required|before:' . now(),
        ]);
        $data['trangthai'] = 1;
        $data['created_at'] = now();
        $data['masv'] = session('masv');
        $data['namhoc'] = $hocky_info->id;
        $data['hocky'] = $hocky_info->hocky;

        foreach ($data as $key => $value) {
            $value = trim($value);
        }
        // Đổi trạng thái tạm trú cũ sang 0
        if (isset($tamtrucu)) {
            $disabletamtrucu = DB::table('table_sinhvien_tamtru')
                ->where('id', $tamtrucu->id)
                ->update(['trangthai' => 0]);
        }
        // Tạo bản ghi mới
        $insert = DB::table('table_sinhvien_tamtru')->insert($data);
        if (!$insert) {
            $flag = 0;
        } else {
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => session('masv'),
                'id_log_loai' => 2,
                'created_at' => now()
            ]);
        }
        // Return back
        if($flag){
            return back()->with(['flash_level'=>'success','flash_message'=>'Thành công!']);
            return back();
        } else {
            return back()->with(['flash_level'=>'danger','flash_message'=>'Thất bại!']);
            return back();
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
