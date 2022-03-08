<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class AdQuanLySv extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Quản lý sinh viên theo lớp
    |--------------------------------------------------------------------------
    | Chuyên viên có thể tìm và nhóm sinh viên theo lớp. Chuyên viên có thể xem thống kê sinh viên được khen thưởng, \
    | khiển trách.
    |
    |
    */


    function danhSachSvView(Request $request)
    {
        $lop = DB::table("table_lopsh")->get();
        $nganh = DB::table("table_nganh")->get();

        $sinhvien_stmt = DB::table("table_sinhvien")
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id");

        if (isset($request->masv)) {
            $sinhvien_stmt->where("table_sinhvien.masv", "LIKE", "%" . $request->masv . "%");
        }
        if (isset($request->lop)) {
            $sinhvien_stmt->where("table_sinhvien.lopsh_id", "=", $request->lop);
        }
        if (isset($request->nganh)) {
            $sinhvien_stmt->where("table_sinhvien.nganh_id", "=", $request->nganh);
        }

        $sinhvien = $sinhvien_stmt->paginate(100);
        return view("Admin.SinhVien.DanhSach")->with([
            "nganh" => $nganh,
            "lop" => $lop,
            "sinhvien" => $sinhvien
        ]);
    }

    function chiTietSinhVienView(Request $request, $masv)
    {   //Thong tin sinh vien
        $sinhvien = getSinhVienData($masv);
        //Thanh phan gia dinh
        $sinhvien->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;
        //Thong tin tam tru
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $masv)
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
        //Khen thuong
        $khenthuong = DB::table("table_sinhvien_khenthuong")
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where("table_sinhvien_khenthuong.masv", $masv)
            ->get();
        //KyLuat
        $kyluat = DB::table("table_sinhvien_kyluat")
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where("table_sinhvien_kyluat.masv", $masv)
            ->get();
        //Timeline
        $log_sinhvien = DB::table('table_log_sinhvien')->join('table_log_loai', 'table_log_sinhvien.id_log_loai', '=', 'table_log_loai.id')->where('masv', $masv)->orderBy('created_at', 'DESC')->get();
        //Ren luyen
        $renluyen = DB::table("table_danhgiarenluyen")
            ->where("table_danhgiarenluyen.masv", $masv)
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->get();
        //Get Chart data
        $renluyen_chart = [
            'value' => [],
            'label' => []
        ];
        foreach ($renluyen as $key => $item){
            array_push($renluyen_chart['value'], $item->diem);
            array_push($renluyen_chart['label'], 'HK '.$item->hocky .' '.$item->nambatdau."-".$item->namketthuc);
        }
        //Avatar
        if (isset($sinhvien->avatar)) {
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        return view("Admin.SinhVien.Chitiet")
            ->with("sinhvien", $sinhvien)
            ->with("tamtru", $tamtru)
            ->with("kyluat", $kyluat)
            ->with("khenthuong", $khenthuong)
            ->with("renluyen", $renluyen)
            ->with('log_sinhvien', $log_sinhvien)
            ->with('renluyen_chart', $renluyen_chart);;
    }
    /*
     Sua ho so
    */

    //Ca nhan get
    public function caNhanView(Request $request, $masv)
    {
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_nganh", "table_sinhvien.nganh_id", "=", "table_nganh.id")
            ->first();
        $sinhvien->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        return view("Admin.SinhVien.Sua.CaNhan")->with([
            "sinhvien" => $sinhvien,
        ]);
    }


    /**
     * Cập nhật thông tin sinh viên
     * @param  $masv string Mã sinh viên
     * @return view mã sinh viên
     * */
    public function caNhanStore(Request $request, $masv)
    {
        $sinhvien_chitiet = [
            "cmnd" => $request->cmnd,
            "ngaycap" => $request->ngaycap,
            "noicap" => $request->noicap,
            "ma_bhyt" => $request->ma_bhyt,
            "doanthe" => $request->doanthe,
            "ngayketnap" => $request->ngayketnap,
            "tongiao" => $request->tongiao,
            //Thong tin cha
            "hotencha" => $request->hotencha,
            "namsinhcha" => $request->namsinhcha,
            "dantoc_cha" => $request->dantoc_cha,
            "cmnd_cha" => $request->cmnd_cha,
            "nghenghiep_cha" => $request->nghenghiep_cha,
            "sdt_cha" => $request->sdt_cha,
            "email_cha" => $request->email_cha,
            "diachi_cha" => $request->diachi_cha,
            //Thong tin me
            "hotenme" => $request->hotenme,
            "namsinhme" => $request->namsinhme,
            "dantoc_me" => $request->dantoc_me,
            "cmnd_me" => $request->cmnd_me,
            "nghenghiep_me" => $request->nghenghiep_me,
            "sdt_me" => $request->sdt_me,
            "email_me" => $request->email_me,
            "diachi_me" => $request->diachi_me,
            // Thanh phan gia
            "thanhphangiadinh" => $request->thanhphangiadinh,
            "tinh_thanh" => $request->tinh_thanh,
            "quan_huyen" => $request->quan_huyen,
            "xa_phuong" => $request->xa_phuong,
            "thon_to" => $request->thon_to,
            //Thong tin lien he
            "dia_chi_lien_lac" => $request->dia_chi_lien_lac,
            "email_khac" => $request->email_khac,
            "facebook" => $request->facebook,
            "dienthoai" => $request->dienthoai,
            "dienthoaigiadinh" => $request->dienthoaigiadinh,
            "zalo" => $request->zalo
        ];
        // Xử lý thành phần gia đình
        $str_thanhphangiadinh = "";
        if(isset($sinhvien_chitiet['thanhphangiadinh'])){
            foreach ($sinhvien_chitiet['thanhphangiadinh'] as $value){
                $str_thanhphangiadinh = $str_thanhphangiadinh . $value . "|";
            }
        }
        $str_thanhphangiadinh = rtrim($str_thanhphangiadinh, "|");
        $sinhvien_chitiet['thanhphangiadinh'] = $str_thanhphangiadinh;
        $update_sinhvien_chitiet = DB::table("table_sinhvien_chitiet")->where("masv", $masv)->update($sinhvien_chitiet);
        if(!$update_sinhvien_chitiet){
            $flag = 0;
        }
        //Log
        $log = DB::table('table_log_sinhvien')->insert([
            'masv' => $masv,
            'id_log_loai' => 3,
            'created_at' => now()
        ]);
        // Return back


        if ($update_sinhvien_chitiet) {
            pushNotify(1);
            return back();
        } else {
            pushNotify(0);
            return back();
        }
    }
    // Anh
    function anhView(Request $request, $masv){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        if(isset($sinhvien->avatar)){
        $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        $anhdatailen = DB::table("table_sinhvien_anhcu")->where("masv", "=", $masv)->get();

        return view("Admin.SinhVien.Sua.Anh")->with([
            "sinhvien" => $sinhvien,
            "anhdatailen" => $anhdatailen
        ]);
    }
    function duyetAnh(Request $request, $masv)
    {

        $sinhvien = DB::table("table_sinhvien_chitiet")->where("masv", "=", $masv)->first();
        $old_path = "AnhHoSoCu/" . $masv . "_" . time() . ".png";

        if(isset($sinhvien->avatar)){
            $backup_cu = File::copy(public_path($sinhvien->avatar), public_path($old_path));
            DB::table("table_sinhvien_anhcu")->insert([
                "masv" => $masv,
                "duongdan" => $old_path,
                "created_at" => Carbon::now()
            ]);
        }

        $copy = File::copy(public_path($sinhvien->avatar_temp), public_path("AnhHoSo/" . $masv . ".png"));
        $change = null; //Flag

        if ($copy) {
            $change = DB::table("table_sinhvien_chitiet")->where("masv", "=", $masv)->update(["avatar" => "AnhHoSo/" . $masv . ".png", "avatar_temp" => null]);
        } else {
            pushNotify(0);
            return redirect()->back();
        }
        if ($change) {
            pushNotify(1);
            return redirect()->back();
        }
    }
    //Khenthuong
    function khenThuong(Request $request, $masv){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $khenthuong = DB::table("table_sinhvien_khenthuong")->join("table_namhoc_hocky", function ($join){
            $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
            $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
        })->where("masv", $masv)->get([
            'table_sinhvien_khenthuong.id',
            'table_sinhvien_khenthuong.masv',
            'table_sinhvien_khenthuong.noidung',
            'table_sinhvien_khenthuong.capkhenthuong',
            'table_sinhvien_khenthuong.soquyetdinh',
            'table_sinhvien_khenthuong.thoigian',
            'table_sinhvien_khenthuong.created_at',
            'table_sinhvien_khenthuong.updated_at',
            'table_sinhvien_khenthuong.namhoc',
            'table_sinhvien_khenthuong.hocky',
            'table_namhoc_hocky.nambatdau',
            'table_namhoc_hocky.namketthuc',
        ]);
        $kyluat = DB::table("table_sinhvien_kyluat")->join("table_namhoc_hocky", function ($join){
            $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
            $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
        })->where("masv", $masv)->get(['table_sinhvien_kyluat.id',
            'table_sinhvien_kyluat.masv',
            'table_sinhvien_kyluat.noidung',
            'table_sinhvien_kyluat.capquyetdinh',
            'table_sinhvien_kyluat.hinhthuckyluat',
            'table_sinhvien_kyluat.soquyetdinh',
            'table_sinhvien_kyluat.thoigian',
            'table_sinhvien_kyluat.created_at',
            'table_sinhvien_kyluat.updated_at',
            'table_sinhvien_kyluat.namhoc',
            'table_sinhvien_kyluat.hocky',
            'table_namhoc_hocky.nambatdau',
            'table_namhoc_hocky.namketthuc',]);
        return view("Admin.SinhVien.Sua.KhenThuong")->with([
            "khenthuong" => $khenthuong,
            "kyluat" => $kyluat,
            "sinhvien" => $sinhvien
        ]);
    }
    function themKhenThuongView(Request $request, $masv){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view('Admin.SinhVien.Sua.ThemKhenThuong')->with([
            'sinhvien' => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky
        ]);
    }
    function khenThuongStore(Request $request, $masv)
    {
        $data = [
            "masv" => $masv,
            "noidung" => $request->noidung,
            "capkhenthuong" => $request->capkhenthuong,
            "soquyetdinh" => $request->soquyetdinh,
            "namhoc" => $request->namhoc,
            "hocky" => $request->hocky,
            "thoigian" => $request->thoigian,
            "created_at" => Carbon::now()
        ];
        $response = DB::table("table_sinhvien_khenthuong")->insert($data);
        if($response){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 4,
                'created_at' => now()
            ]);
        }

        pushNotify($response);
        return redirect()->back();
    }
    function suaKhenThuong(Request $request, $masv, $id){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $khenthuong = DB::table("table_sinhvien_khenthuong")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.SuaKhenThuong")->with([
            "khenthuong" => $khenthuong,
            "sinhvien" => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky
        ]);
    }
    function suaKhenThuongStore(Request $request, $masv, $id)
    {
        $data = [
            "noidung" => $request->noidung,
            "capkhenthuong" => $request->capkhenthuong,
            "soquyetdinh" => $request->soquyetdinh,
            "namhoc" => $request->namhoc,
            "hocky" => $request->hocky,
            "thoigian" => $request->thoigian,
            "updated_at" => Carbon::now()
        ];
        $response = DB::table("table_sinhvien_khenthuong")->where("id", $id)->update($data);
        if($response){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 6,
                'created_at' => now()
            ]);
        }

        pushNotify($response);
        return redirect()->back();
    }
    function xoaKhenThuong(Request $request, $id){
        $xoa = DB::table("table_sinhvien_khenthuong")->where("id", $id)->delete();
        pushNotify($xoa);
        return redirect()->back();
    }

    function themKyLuatView(Request $request, $masv){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view('Admin.SinhVien.Sua.ThemKyLuat')->with([
            'sinhvien' => $sinhvien,
            "namhoc_hocky" => $namhoc_hocky
        ]);
    }
    function kyLuatStore(Request $request, $masv)
    {
        $data = [
            "masv" => $masv,
            "noidung" => $request->noidung,
            "hinhthuckyluat" => $request->hinhthuckyluat,
            "capquyetdinh" => $request->capquyetdinh,
            "soquyetdinh" => $request->soquyetdinh,
            "namhoc" => $request->namhoc,
            "hocky" => $request->hocky,
            "thoigian" => $request->thoigian,
            "created_at" => Carbon::now()
        ];
        $response = DB::table("table_sinhvien_kyluat")->insert($data);
        if($response){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 5,
                'created_at' => now()
            ]);
        }
        pushNotify($response);
        return redirect()->back();
    }
    function suaKyLuat(Request $request, $masv, $id){
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $kyluat = DB::table("table_sinhvien_kyLuat")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.SuaKyLuat")->with([
            "kyluat" => $kyluat,
            "sinhvien" => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky
        ]);
    }
    function suaKyLuatStore(Request $request, $masv, $id)
    {
        $data = [
            "noidung" => $request->noidung,
            "hinhthuckyluat" => $request->hinhthuckyluat,
            "capquyetdinh" => $request->capquyetdinh,
            "soquyetdinh" => $request->soquyetdinh,
            "namhoc" => $request->namhoc,
            "hocky" => $request->hocky,
            "thoigian" => $request->thoigian,
            "updated_at" => Carbon::now()
        ];
        $response = DB::table("table_sinhvien_kyluat")->where("id", $id)->update($data);
        if($response){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 7,
                'created_at' => now()
            ]);
        }
        pushNotify($response);
        return redirect()->back();
    }
    function xoaKyLuat(Request $request, $id){
        $xoa = DB::table("table_sinhvien_kyluat")->where("id", $id)->delete();
        pushNotify($xoa);
        return redirect()->back();
    }

    //Temp route
    function getEmail(){
        $email = "";
        $user = DB::table('table_sinhvien')->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->where('table_sinhvien.lopsh_id', 17)->get('table_sinhvien.email');
        foreach ($user as $value){
            $email = $email . $value->email . ',';
        }
        return $email;
    }
}
//public function caNhanView(Request $request, $masv){
//    $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")->first();
//    $tamtru = DB::table("table_sinhvien_tamtru")->where("id", "=", $sinhvien->tamtru)->first();
//    $hocky_info = DB::table("table_namhoc_hocky")->where("hienhanh", "=", 1)->first();
//    $kyluat = DB::table("table_sinhvien_kyluat")->where("masv", "=", $masv)->get();
//    $tamtrucount = DB::table("table_sinhvien_tamtru")
//        ->where("masv", "=", session("masv"))
//        ->where("namhoc_hocky", "=", $hocky_info->namhoc_key)
//        ->count("id");
//    $anhdatailen = DB::table("table_sinhvien_anh")->where("masv", "=", $masv)->get();
//    if(isset($sinhvien->avatar)){
//        $sinhvien->avatar = asset($sinhvien->avatar);
//    } else {
//        $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
//    }
//    return view("Admin.SinhVien.Sua.CaNhan")->with([
//        "sinhvien"=> $sinhvien,
//        "tamtru" => $tamtru,
//        "hocky" => $hocky_info,
//        "tamtrucount" => $tamtrucount,
//        "anhdatailen" => $anhdatailen,
//        "kyluat" => $kyluat
//    ]);
//}