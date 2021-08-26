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
            'gioithieu' => $request->gioithieu,
            'email_cv' => $request->email,
            'masv' => session('masv')
        ];
        $store = DB::table('table_sinhvien_cv')->insert([$data]);
    }
    public function cvViewer(Request $request, $masv){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->first();
        $cv = DB::table('table_sinhvien_cv')->where('masv', $masv)->first();

        $cv->kynang = explode('|', $cv->kynang);
        $cv->kinhnghiem = explode('|', $cv->kinhnghiem);
        $cv->ngoaingu = explode('|', $cv->ngoaingu);


        foreach ($cv->kynang as $key => $item){
            $kynang =  explode(';', $item);
            $item_temp = (object) [];
            $item_temp->kynang = $kynang[0];
            $item_temp->mucdo = $kynang[1];
            $cv->kynang[$key] = $item_temp;
        }
        foreach ($cv->ngoaingu as $key => $item){
            $kynang =  explode(';', $item);
            $item_temp = (object) [];
            $item_temp->ngonngu = $kynang[0];
            $item_temp->trinhdo = $kynang[1];
            $cv->ngoaingu[$key] = $item_temp;
        }

        foreach ($cv->kinhnghiem as $key => $item){

            $kinhnghiem =  explode(';', $item);
            $item_temp = (object) [];
            $item_temp->kinhnghiem = $kinhnghiem[0];
            $item_temp->batdau = $kinhnghiem[1];
            $item_temp->ketthuc = $kinhnghiem[2];
            $item_temp->chitiet = $kinhnghiem[3];

            $cv->kinhnghiem[$key] = $item_temp;
        }
//        dd($kinhnghiem[$key]);
//        dd($cv);

        return view('Sv.Cv.CvTemple')->with([
            'sinhvien' => $sinhvien,
            'cv' => $cv
        ]);
    }
}
