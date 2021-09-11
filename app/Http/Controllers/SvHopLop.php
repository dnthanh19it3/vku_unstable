<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SvHopLop extends Controller
{
    function listHopLopIndex(Request $request){
        //Get thong tin ky hoc
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        //Get thong tin thang
        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        //Get thong tin lop
        $lopsh_id = DB::table('table_sinhvien')->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')->where('table_sinhvien.masv', session('masv'))->first(['table_lopsh.id'])->id;
        //Tính các tháng trong thời gian kì học
        $arrayMonth = array();
        foreach ($result as $dt) {
            array_push($arrayMonth, (object) [
                'thang' => $dt->format("m"),
                'thang_text' => $dt->format("M"),
                'bienban' => DB::table('table_lopsh_hoplop')
                    ->leftJoin('table_sinhvien', 'table_lopsh_hoplop.nguoilapbienban', '=', 'table_sinhvien.masv')
                    ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
                    ->join("table_namhoc_hocky", function ($join){
                        $join->on("table_lopsh_hoplop.namhoc", "=", "table_namhoc_hocky.id");
                        $join->on("table_lopsh_hoplop.hocky", "=", "table_namhoc_hocky.hocky");
                    })
                    ->where('lopsh', $lopsh_id)->where('thang',  $dt->format("m"))->first([
                        'table_lopsh_hoplop.id',
                        'table_lopsh_hoplop.lopsh',
                        'table_lopsh_hoplop.thoigianhop',
                        'table_lopsh_hoplop.chuongtrinh',
                        'table_lopsh_hoplop.noidung',
                        'table_lopsh_hoplop.gopy',
                        'table_lopsh_hoplop.gvcn_nhanxet',
                        'table_lopsh_hoplop.xacnhan_loptruong',
                        'table_lopsh_hoplop.xacnhan_bithu',
                        'table_lopsh_hoplop.xacnhan_bgh',
                        'table_lopsh_hoplop.xacnhan_khoa',
                        'table_lopsh_hoplop.xacnhan_bgh',
                        'table_lopsh_hoplop.xacnhan_ctsv',
                        'table_lopsh_hoplop.phanhoi',
                        'table_lopsh_hoplop.thoigianphanhoi',
                        'table_lopsh_hoplop.thoigianduyet',
                        'table_lopsh.tenlop',
                        'table_namhoc_hocky.nambatdau',
                        'table_namhoc_hocky.namketthuc',
                        'table_namhoc_hocky.hocky',
                        'table_lopsh_hoplop.thang',
                        'table_lopsh_hoplop.created_at',
                        'table_sinhvien.hodem',
                        'table_sinhvien.ten'
                    ])
            ]);
        }

        return view("Sv.LopSH.ListBienBan")->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh
        ]);
    }
    function taoBienBanIndex(Request $request){
        //Ky hoc hien tai
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        //Lop cua nguoi lap bien ban
        $lopsh = DB::table('table_sinhvien')->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->where('table_sinhvien.masv', session('masv'))
            ->first();
        //Thong tin ban can su
        $bancansu = $bancansu = DB::table('table_lopsh_bancansu')
            ->join('table_lopsh_chucvu', 'table_lopsh_bancansu.chucvu_id', '=', 'table_lopsh_chucvu.id')
            ->join('table_sinhvien', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien.masv')
            ->join('table_sinhvien_chitiet', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_lopsh_bancansu.lopsh_id', $lopsh->id)
            ->where('table_lopsh_bancansu.trangthai', 1)
            ->orderBy('table_lopsh_chucvu.id', 'ASC')
            ->get();

        return view('Sv.LopSH.TaoBienBanV2')->with([
            'lopsh' => $lopsh,
            'thang' => $request->thang,
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'bancansu' => $bancansu
        ]);
    }
    function taoBienBanStore(Request $request){
        $flag = 1; //Flag trang thai
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $lopsh = DB::table('table_sinhvien')->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->where('table_sinhvien.masv', session('masv'))
            ->first('table_lopsh.id');
        //Validate
        $data = $request->validate([
            'thang' => 'numeric|required',
            'thoigianhop' => 'required|date',
            'chuongtrinh' => 'required',
            'noidung' => 'required',
            'gopy' => 'nullable',
            'gvcn_nhanxet' => 'nullable',
        ]);

        // Add thong tin
        $data['lopsh'] = $lopsh->id;
        $data['xacnhan_loptruong'] = 1;
        $data['namhoc'] = $kyhoc_hienhanh->id;
        $data['hocky'] = $kyhoc_hienhanh->hocky;
        $data['nguoilapbienban'] = session('masv');
        $data['created_at'] = now();


        $store = DB::table('table_lopsh_hoplop')->insert($data);
        if(!$store){
            $flag = 0;
        }
        return redirect(route('sv.hoplop.listhoplop'));
    }

    function xemBienBanIndex(Request $request, $id){
        $data = DB::table('table_lopsh_hoplop')
            ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_lopsh_hoplop.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_lopsh_hoplop.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_lopsh_hoplop.id','=', $id)
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
                'table_lopsh_hoplop.xacnhan_khoa',
                'table_lopsh_hoplop.xacnhan_bgh',
                'table_lopsh_hoplop.xacnhan_ctsv',
                'table_lopsh_hoplop.phanhoi',
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
    function suaBienBanIndex(Request $request, $id){
        $data = DB::table('table_lopsh_hoplop')
            ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_lopsh_hoplop.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_lopsh_hoplop.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_lopsh_hoplop.id','=', $id)
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
                'table_lopsh_hoplop.xacnhan_khoa',
                'table_lopsh_hoplop.xacnhan_bgh',
                'table_lopsh_hoplop.xacnhan_ctsv',
                'table_lopsh_hoplop.phanhoi',
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

        return view('Sv.LopSH.SuaBienBan')->with([
            'data' => $data,
            'bancansu' => $bancansu
        ]);
    }

    function suaBienBanUpdate(Request $request, $id){
        $flag = 1;
        $data = $request->validate([
            'chuongtrinh' => 'required',
            'noidung' => 'required',
            'gopy' => 'nullable',
        ]);

        // Add thong tin
        $data['updated_at'] = now();
        $update = DB::table('table_lopsh_hoplop')->where('id', '=', $id)->update($data);
        if(!$update){
            $flag = 0;
        }
        return redirect(route('sv.hoplop.listhoplop'));
    }
    function xacNhan(Request $request, $id, $role){
        $record = (array) DB::table('table_lopsh_hoplop')->where('id', $id)->first();
        $update = null;

        if($record['xacnhan_'.$role]){
            $update = (array) DB::table('table_lopsh_hoplop')->where('id', $id)->update(['xacnhan_'."$role" => 0]);
        } else {
            $update = (array) DB::table('table_lopsh_hoplop')->where('id', $id)->update(['xacnhan_'."$role" => 1]);
        }
        if(!$update){
            $flag = 0;
        }

        return back();
    }
}
