<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvCvController extends Controller
{
    public function taoCvView(){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', '19IT195')->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
        return view('Sv/Cv/TaoCv')->with(['sinhvien' => $sinhvien]);
    }
    public function taoCvStore(Request $request){
        $data = array();
        $kynang = "";
        $ngoaingu = "";
        $kinhnghiem = "";


        foreach ($request->loaikinang as $key => $value){
            $kynang = $kynang. $value .";". $request->danhgia[$key]."|";
        }
        foreach ($request->ngonngu as $key => $value){
            $ngoaingu = $ngoaingu. $value .";". $request->trinhdo[$key]."|";
        }
        foreach ($request->kinhnghiem as $key => $value){
            $kinhnghiem = $kinhnghiem. $value .";". $request->batdau[$key] .";". $request->ketthuc[$key].";".$request->mota[$key]."|";
        }

        $data = [
            "facebook" => $request->facebook,
            "instagram" => $request->instagram,
            "github" => $request->github,
            "linkedin" => $request->linkedin,
            "diachi_cv" => $request->diachi_cv,
            "dienthoai_cv" => $request->dienthoai_cv,
            "kynang" => rtrim($kynang, "|"),
            "ngoaingu" => rtrim($ngoaingu, "|"),
            "kinhnghiem" => rtrim($kinhnghiem, "|"),
        ];
        dd($data);
    }
    public function cvViewer(Request $request, $masv){
//        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
//            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
//            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
//            ->first();
        return view('Sv.Cv.CvTemple');
    }
}
