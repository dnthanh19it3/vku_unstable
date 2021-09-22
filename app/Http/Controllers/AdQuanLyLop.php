<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdQuanLyLop extends Controller
{
    function danhSach(){
        $khoa = DB::table("table_lopsh")->distinct()->get("khoaK");
        $lopsh = DB::table("table_lopsh")->get();

        // Danh sách lớp nhóm theo khoá
        foreach ($khoa as $key1 => $item1){
            $lop = array();
            foreach ($lopsh as $key2 => $item2){
                if($item2->khoaK == $item1->khoaK){
                    array_push($lop, $item2);
                }
            }
            $item1->lopsh = $lop;
        }
        return view("Admin.QuanLyLop.DanhSachLop")->with([
            "khoa" => $khoa
        ]);
    }
    function chiTiet(Request $request, $lop_id){
        $listsinhvien = DB::table("table_sinhvien")
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->where("table_lopsh.id", $lop_id)
            ->get([
                'table_sinhvien.id',
                'table_sinhvien.masv',
                'table_sinhvien.hodem',
                'table_sinhvien.ten',
                'table_sinhvien.masv',
                'table_sinhvien.ngaysinh',
                'table_sinhvien.gioitinh',
                'table_sinhvien.email',
                'table_sinhvien_chitiet.avatar',
            ]);
        return view("Admin.QuanLyLop.ChiTietLop")->with([
            "listsinhvien" => $listsinhvien,
            "lop_id" => $request->lop_id
        ]);
    }
    function khenThuongKyLuat(Request $request, $lop_id){
        $khenthuong = DB::table("table_sinhvien")
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_sinhvien_khenthuong", "table_sinhvien.masv", "=", "table_sinhvien_khenthuong.masv")
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where("table_lopsh.id", $lop_id)
            ->get();

        $kyluat = DB::table("table_sinhvien")
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_sinhvien_kyluat", "table_sinhvien.masv", "=", "table_sinhvien_kyluat.masv")
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where("table_lopsh.id", $lop_id)
            ->get();
        return view("Admin.QuanLyLop.KhenThuongKyLuat")->with([
            "khenthuong" => $khenthuong,
            "kyluat" => $kyluat,
            "lop_id" => $request->lop_id
        ]);
    }
    function diemRenLuyen(Request $request, $lop_id){
        $namhoc_hocky = (isset($request->hocky)) ? explode("_", $request->hocky) : null;
        // Lấy danh sách học kỳ
        $danhsachhocky = DB::table("table_danhgiarenluyen")
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->distinct()
            ->get(['table_danhgiarenluyen.namhoc', 'table_danhgiarenluyen.hocky', 'table_namhoc_hocky.nambatdau', 'table_namhoc_hocky.namketthuc']);
        // Lấy kết quả theo lớp và năm học
        $ketquadanhgia = DB::table("table_danhgiarenluyen")
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->where('table_danhgiarenluyen.namhoc', $namhoc_hocky[0])
            ->where('table_danhgiarenluyen.hocky', $namhoc_hocky[1])
            ->get();
        $ketquadanhgia_thongke = ['xeploai' => [], 'soluong' => []];
        $ketquadanhgia_thongkeraw = DB::table("table_danhgiarenluyen")
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->where('table_danhgiarenluyen.namhoc', $namhoc_hocky[0])
            ->where('table_danhgiarenluyen.hocky', $namhoc_hocky[1])
            ->addSelect('table_danhgiarenluyen.xeploai')
            ->distinct()
            ->selectRaw('count(table_danhgiarenluyen.xeploai) as count')
            ->groupBy('table_danhgiarenluyen.xeploai')
            ->get();
        foreach ($ketquadanhgia_thongkeraw as $key => $value){
            array_push($ketquadanhgia_thongke['xeploai'], $value->xeploai);
            array_push($ketquadanhgia_thongke['soluong'], $value->count);
        }



        return view('Admin.QuanLyLop.DiemRenLuyen')->with([
            'danhsachhocky' => $danhsachhocky,
            'ketquadanhgia' => $ketquadanhgia,
            "lop_id" => $request->lop_id,
            'namhoc_hocky' => $request->namhoc_hocky,
            'ketquadanhgia_thongke' => $ketquadanhgia_thongke
        ]);
    }
    /**
     * Ban cán sự
     * role: 1 lớp trưởng 2 lớp phó 3 bí thư 4 phó bí thư 5 uỷ viên
     */
    function banCanSu(Request $request, $lop_id){
        $bancansu = DB::table('table_lopsh_bancansu')
            ->join('table_lopsh_chucvu', 'table_lopsh_bancansu.chucvu_id', '=', 'table_lopsh_chucvu.id')
            ->join('table_sinhvien', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien.masv')
            ->join('table_sinhvien_chitiet', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_lopsh_bancansu.lopsh_id', $lop_id)
            ->where('table_lopsh_bancansu.trangthai', 1)
            ->get();
        return view('Admin.QuanLyLop.BanCanSu')->with([
            'bancansu' => $bancansu,
            'lop_id' => $lop_id
        ]);
    }
    function boNhiemBanCanSu(Request $request, $lop_id){
        $bancansu = DB::table('table_sinhvien')
            ->leftJoin('table_lopsh_bancansu', 'table_sinhvien.masv', '=', 'table_lopsh_bancansu.masv')
            ->leftJoin('table_lopsh_chucvu', 'table_lopsh_bancansu.chucvu_id', '=', 'table_lopsh_chucvu.id')
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->orderBy('table_sinhvien.ten')
            ->get(['table_sinhvien.masv','table_sinhvien.hodem','table_sinhvien.ten','table_lopsh_bancansu.chucvu_id',]);
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.lopsh_id', $lop_id)->get();
        $chucvu = DB::table('table_lopsh_chucvu')->get();
        return view('Admin.QuanLyLop.BoNhiemBanCanSu')->with([
            'bancansu' => $bancansu,
            'chucvu' => $chucvu,
            'sinhvien' => $sinhvien,
            'lop_id' => $lop_id
        ]);
    }
    function boNhiemBanCanSuStore(Request $request, $lop_id){
        //Flag update thanh cong
        $success = 1;
        //Du lieu dau vao
        $data = $request->all();
        //Tach du lieu theo chuc vu
        $output_data = [];
        foreach ($data as $key_chucvu => $masv){
            if($masv == null || $key_chucvu == "_token"){
                unset($value);
            } else {
                $tmp = [];
                $tmp['lopsh_id'] = $lop_id;
                $tmp['masv'] = $masv;
                $tmp['chucvu_id'] = $key_chucvu;
                $tmp['trangthai'] = 1;
                $tmp['created_at'] = Carbon::now();
                $trangthai = 1;
                array_push($output_data, $tmp);
            }
        }

        foreach ($output_data as $key => $item){
            $tontai = DB::table('table_lopsh_bancansu')
                ->where('lopsh_id', $item['lopsh_id'])
                ->where('chucvu_id', $item['chucvu_id'])
                ->first();

            if($tontai != null){
                if($item['masv'] == $tontai->masv){
                    continue;
                } else {
                    $update = DB::table('table_lopsh_bancansu')->where('id', $tontai->id)->update($item);
                    if(!$update){
                        $success = 0;
                    }
                }
            } else {
                $insert = DB::table('table_lopsh_bancansu')->insert($item);
                if(!$insert){
                    $success = 0;
                }
            }
        }
        return back();
    }
}
