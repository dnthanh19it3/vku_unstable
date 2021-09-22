<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvLyLichController extends Controller
{
    function getLyLich (Request $request, $masv){
        $sinhvien = getSinhVienData($request->masv);
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $sinhvien->masv)
            ->where('table_sinhvien_tamtru.trangthai',1)
            ->orderBy('table_sinhvien_tamtru.created_at', 'desc')
            ->first([
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
                'table_sinhvien_tamtru.created_at'
            ]);
        return view('Sv.HoSo.LyLich')->with([
            'sv' => $sinhvien,
            'tamtru' => $tamtru
        ]);
    }
}
