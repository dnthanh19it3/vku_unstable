<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdQuanLyHopLop extends Controller
{
    function listHopLopIndex(Request $request)
    {
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $lopsh = DB::table('table_lopsh')->get();
        $arrayMonth = array();
        $thang = ($request->thang != null) ? $request->thang : date('m');
        $months = [];
        $thongke = [];

        foreach ($result as $dt) {
            array_push($months, $dt->format('m'));
        }

        $arrayBienBan = [];
        foreach ($lopsh as $key => $lop_item) {
            $data = DB::table('table_lopsh_hoplop')->where('lopsh', $lop_item->id)->where('thang', $thang)->first();
            $arrayBienBan[$lop_item->tenlop] = $data;
        }


        $thongke = [
            'danop' => 0,
            'chuanop' => 0,
            'tongso' => count($arrayBienBan)
        ];

        foreach ($arrayBienBan as $item) {
            if ($item != null) {
                $thongke['danop'] += 1;
            } else {
                $thongke['chuanop'] += 1;
            }
        }

        array_push($arrayMonth, (object)[
            'thang' => $thang,
            'thang_text' => Carbon::create()->month($thang)->format('M'),
            'bienban' => $arrayBienBan,
        ]);

        return view('Admin.HopLop.ListBienBan')->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'thang' => $thang,
            'months' => $months,
            'thongke' => (object)$thongke
        ]);
    }
    function listPhanHoiIndex(Request $request)
    {
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $lopsh = DB::table('table_lopsh')->get();
        $arrayMonth = array();
        $thang = ($request->thang != null) ? $request->thang : date('m');
        $months = [];
        $thongke = [];

        foreach ($result as $dt) {
            array_push($months, $dt->format('m'));
        }

        $arrayBienBan = [];
        foreach ($lopsh as $key => $lop_item) {
            $data = DB::table('table_lopsh_hoplop')->where('lopsh', $lop_item->id)->where('thang', $thang)->first();
            $arrayBienBan[$lop_item->tenlop] = $data;
        }


        $thongke = [
            'danop' => 0,
            'chuanop' => 0,
            'tongso' => count($arrayBienBan)
        ];

        foreach ($arrayBienBan as $item) {
            if ($item != null) {
                $thongke['danop'] += 1;
            } else {
                $thongke['chuanop'] += 1;
            }
        }

        array_push($arrayMonth, (object)[
            'thang' => $thang,
            'thang_text' => Carbon::create()->month($thang)->format('M'),
            'bienban' => $arrayBienBan,
        ]);

        return view('Admin.HopLop.ListPhanHoi')->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'thang' => $thang,
            'months' => $months,
            'thongke' => (object)$thongke
        ]);
    }

    function xemBienBanIndex(Request $request)
    {
        $data = DB::table('table_lopsh_hoplop')
            ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
            ->where('table_lopsh_hoplop.id', '=', $request->id)
            ->first([
                'table_lopsh_hoplop.id',
                'table_lopsh_hoplop.thang',
                'table_lopsh_hoplop.thoigianhop',
                'table_lopsh_hoplop.diadiem',
                'table_lopsh_hoplop.chuongtrinh',
                'table_lopsh_hoplop.noidung',
                'table_lopsh_hoplop.gopy',
                'table_lopsh_hoplop.gvcn_nhanxet',
                'table_lopsh_hoplop.xacnhan_loptruong',
                'table_lopsh_hoplop.xacnhan_bithu',
                'table_lopsh_hoplop.xacnhan_gvcn',
                'table_lopsh_hoplop.phanhoi_nhatruong',
                'table_lopsh.tenlop',
                'table_lopsh.loptruong',
                'table_lopsh.loppho1',
                'table_lopsh.loppho2',
                'table_lopsh.bithu',
                'table_lopsh.phobithu',
                'table_lopsh.uyvien'
            ]);


        $loptruong = DB::table('table_sinhvien')->where('masv', $data->loptruong)->first();
        $loppho1 = DB::table('table_sinhvien')->where('masv', $data->loppho1)->first();
        $loppho2 = DB::table('table_sinhvien')->where('masv', $data->loppho2)->first();
        $bithu = DB::table('table_sinhvien')->where('masv', $data->bithu)->first();
        $phobithu = DB::table('table_sinhvien')->where('masv', $data->phobithu)->first();
        $uyvien = DB::table('table_sinhvien')->where('masv', $data->uyvien)->first();
        $bancansu = (object)[
            'loptruong' => $loptruong,
            'loppho1' => $loppho1,
            'loppho2' => $loppho2,
            'bithu' => $bithu,
            'phobithu' => $phobithu,
            'uyvien' => $uyvien
        ];


        return view('Admin.HopLop.XemBienBan')->with([
            'data' => $data,
            'bancansu' => $bancansu,
        ]);
    }

    function phanHoi(Request $request)
    {
        $update = DB::table('table_lopsh_hoplop')->where('id', $request->id)->update(['phanhoi_nhatruong' => $request->phanhoi]);
        return redirect()->back();
    }

}
