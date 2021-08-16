<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SvHopLop extends Controller
{
    function listHopLopIndex(Request $request){
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $arrayMonth = array();


        foreach ($result as $dt) {
            array_push($arrayMonth, (object) [
                'thang' => $dt->format("m"),
                'thang_text' => $dt->format("M"),
                'bienban' => DB::table('table_lopsh_hoplop')->where('lopsh', 17)->where('thang',  $dt->format("m"))->first()
            ]);
        }
//        dd($arrayMonth);
        return view("Sv.LopSH.ListBienBan")->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh
        ]);
    }
    function taoBienBanIndex(Request $request){
        $result = CarbonPeriod::create('2021-08-02', '1 month', '2021-12-31');
        $arrayMonth = array();


//        dd($arrayMonth);
        return view('Sv.LopSH.TaoBienBan')->with([
            'thang' => $request->thang
        ]);
    }
    function taoBienBanStore(Request $request){
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $lopsh = DB::table('table_sinhvien')->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')->where('table_sinhvien.masv', session('masv'))->first();
        $data = [
            'lopsh' => $lopsh->tenlop,
            'thang' => $request->thang,
            'thoigianhop' => $request->thoigianhop,
            'diadiem' => $request->diadiem,
            'chuongtrinh' => $request->chuongtrinh,
            'noidung' => $request->noidung,
            'gopy' => $request->gopy,
            'gvcn_nhanxet' => $request->gvcn_nhanxet,
            'xacnhan_loptruong' => 1,
            'namhoc_hocky' => $kyhoc_hienhanh->namhoc_key
        ];
    $store = DB::table('table_lopsh_hoplop')->insert($data);
    }

    function suaBienBanIndex(Request $request){
        $data = DB::table('table_lopsh_hoplop')->where('id','=', $request->id);
        return view('Sv.LopSH.SuaBienBan')->with([
            'data' => $data
        ]);
    }

    function suaBienBanUpdate(Request $request){
        $data = [
            'thoigianhop' => $request->thoigianhop,
            'diadiem' => $request->diadiem,
            'chuongtrinh' => $request->chuongtrinh,
            'noidung' => $request->noidung,
            'gopy' => $request->gopy,
            'gvcn_nhanxet' => $request->gvcn_nhanxet,
        ];
        $update = DB::table('table_lopsh_hoplop')->where('id', '=', $request->id)->update($data);
    }
}