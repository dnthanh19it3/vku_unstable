<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdQuanLyHopLop extends Controller
{
    function listHopLopIndex(Request $request, $namhoc = null, $hocky = null)
    {

        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $list_kyhoc = DB::table('table_namhoc_hocky')->get();

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
            $data = DB::table('table_lopsh_hoplop')
                ->where('lopsh', $lop_item->id)
                ->where('thang', $thang)
                ->where('namhoc', $namhoc)
                ->where('hocky', $hocky)
                ->first();
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
            'thongke' => (object) $thongke,
            'namhoc' => $kyhoc_hienhanh->id,
            'hocky' => $kyhoc_hienhanh->hocky,
            'list_kyhoc' => $list_kyhoc
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
            'thongke' => (object) $thongke
        ]);
    }

    function xemBienBanIndex(Request $request)
    {
        $data = DB::table('table_lopsh_hoplop')
            ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_lopsh_hoplop.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_lopsh_hoplop.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_lopsh_hoplop.id','=', $request->id)
            ->first([
                'table_lopsh_hoplop.id',
                'table_lopsh_hoplop.lopsh',
                'table_lopsh_hoplop.thoigianhop',
                'table_lopsh_hoplop.chuongtrinh',
                'table_lopsh_hoplop.noidung',
                'table_lopsh_hoplop.gopy',
                'table_lopsh_hoplop.gvcn_nhanxet',
                'table_lopsh_hoplop.xacnhan_loptruong',
                'table_lopsh_hoplop.xacnhan_bithu',
                'table_lopsh_hoplop.xacnhan_gvcn',
                'table_lopsh_hoplop.xacnhan_nhatruong',
                'table_lopsh_hoplop.phanhoi_nhatruong',
                'table_lopsh_hoplop.thoigianphanhoi',
                'table_lopsh_hoplop.thoigianduyet',
                'table_lopsh.tenlop',
                'table_namhoc_hocky.nambatdau',
                'table_namhoc_hocky.namketthuc',
                'table_namhoc_hocky.hocky',
                'table_lopsh_hoplop.thang',
                'table_lopsh_hoplop.created_at',
            ]);

        $bancansu = $bancansu = DB::table('table_lopsh_bancansu')
            ->join('table_lopsh_chucvu', 'table_lopsh_bancansu.chucvu_id', '=', 'table_lopsh_chucvu.id')
            ->join('table_sinhvien', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien.masv')
            ->join('table_sinhvien_chitiet', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_lopsh_bancansu.lopsh_id', $data->lopsh)
            ->where('table_lopsh_bancansu.trangthai', 1)
            ->orderBy('table_lopsh_chucvu.id', 'ASC')
            ->get();

        return view('Sv.LopSH.XemBienBan')->with([
            'data' => $data,
            'bancansu' => $bancansu
        ]);
    }

    function phanHoi(Request $request)
    {
        $update = DB::table('table_lopsh_hoplop')->where('id', $request->id)->update(['phanhoi_nhatruong' => $request->phanhoi]);
        return redirect()->back();
    }

}
