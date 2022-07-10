<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SvLyLichController extends Controller
{
    function getLyLich (Request $request, $masv){

        $sinhvien = $this->getSinhVien($masv);
        $sinhvien_chitiet = null;

        if($sinhvien != null){
            $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->first();
            if($sinhvien_chitiet != null){
                if($sinhvien_chitiet->thanhphangiadinh != null){
                    $sinhvien_chitiet->thanhphangiadinh = ($sinhvien_chitiet->thanhphangiadinh != null) ? explode('|', $sinhvien_chitiet->thanhphangiadinh) : null;
                }
            }
            
            $sinhhvien_tamtru = DB::table('table_sinhvien_tamtru')
                ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
                ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
                ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
                ->where('table_sinhvien_tamtru.masv', "=", $masv)
                ->where('table_sinhvien_tamtru.hienhanh', "=", 1)
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
                    'table_sinhvien_tamtru.hienhanh',
                    'table_sinhvien_tamtru.created_at'
                ]);

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
            return view('Sv.HoSo.LyLich')->with([
                'sinhvien' => $sinhvien,
                'sinhvien_chitiet' => $sinhvien_chitiet,
                'sinhvien_tamtru' => $sinhhvien_tamtru
            ]);
        } else {
            die("Không tìm thấy sinh viên!");
        }
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
