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
    {
        $sinhvien = null;
        $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->first();
        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien = $item;
                break;
            }
        }

//        dd($sinhvien);

        $sinhvien_chitiet->thanhphangiadinh = $sinhvien_chitiet->thanhphangiadinh ? explode('|', $sinhvien_chitiet->thanhphangiadinh) : null;
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", $masv)->get();


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

        $khenthuong = DB::table('table_sinhvien_khenthuong')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('masv', $masv)
            ->get();

        $kyluat = DB::table('table_sinhvien_kyluat')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('masv', $masv)->get();
        $log_sinhvien = DB::table('table_log_sinhvien')->join('table_log_loai', 'table_log_sinhvien.id_log_loai', '=', 'table_log_loai.id')->where('masv', $masv)->orderBy('created_at', 'DESC')->get();
        $renluyen = DB::table('table_danhgiarenluyen')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_danhgiarenluyen.masv', $masv)
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

        //
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



        return view('Admin.SinhVien.Chitiet')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvien_chitiet', $sinhvien_chitiet)
            ->with('sinhvienTamtru', $sinhhvienTamtru)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('log_sinhvien', $log_sinhvien)
            ->with('renluyen', $renluyen)
            ->with('renluyen_chart', $renluyen_chart)
            ->with("tamtru", $tamtru);
    }
    /*
     Sua ho so
    */

    //Ca nhan get
    public function caNhanView(Request $request, $masv)
    {

        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }

        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_nganh", "table_sinhvien.nganh_id", "=", "table_nganh.id")
            ->first();
        $sinhvien->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;


        return view("Admin.SinhVien.Sua.CaNhan")->with([
            "sinhvien" => $sinhvien,
            "sinhvien_static" => $sinhvien_static
        ]);
    }


    /**
     * Cập nhật thông tin sinh viên
     * @param  $masv string Mã sinh viên
     * @return view mã sinh viên
     * */
    public function caNhanStore(Request $request, $masv)
    {
        $flag = 1;
        $data = $request->data;
        $chitiet = $data['chitiet'];

        $sinhvien_data = $data['sinhvien'];
        $chitiet_data = null;

        $canhan = $chitiet['canhan'];
        $giadinh = $chitiet['giadinh'];
        $lienlac = $chitiet['lienlac'];
        $diachi = $chitiet['diachi'];

        if($giadinh['thanhphangiadinh'] != null){
            if(count($giadinh['thanhphangiadinh']) > 0){
                $giadinh['thanhphangiadinh'] = implode('|', $giadinh['thanhphangiadinh']);
            }
        }

        $chitiet_data = array_merge($canhan, $giadinh, $lienlac, $diachi);

        $sinhvien_data['updated_at'] = \Illuminate\Support\Carbon::now();
        $chitiet_data['updated_at'] = \Illuminate\Support\Carbon::now();

        $update_sinhvien = DB::table('table_sinhvien')->where('masv', $masv)->update($sinhvien_data);
        $update_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->update($chitiet_data);

        if($update_chitiet || $update_sinhvien){
            $flag == 0;
        }

        //Log
        if($flag){
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 3,
                'created_at' => now()
            ]);
        } else {
            // Throw lỗi
            return back();
        }
        return back();
    }

    //Khenthuong
    function khenThuong(Request $request, $masv){
        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $khenthuong = DB::table("table_sinhvien_khenthuong")->join("table_namhoc_hocky", function ($join){
            $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
            $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
        })->where("table_sinhvien_khenthuong.masv", $masv)->where('table_sinhvien_khenthuong.trangthai', 1)->get([
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
        })
            ->where("table_sinhvien_kyluat.masv", $masv)
            ->where('table_sinhvien_kyluat.trangthai', 1)
            ->get(['table_sinhvien_kyluat.id',
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
            "sinhvien" => $sinhvien,
            'sinhvien_static' => $sinhvien_static
        ]);
    }
    function themKhenThuongView(Request $request, $masv){
        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view('Admin.SinhVien.Sua.ThemKhenThuong')->with([
            'sinhvien' => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky,
            'sinhvien_static' => $sinhvien_static
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
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function suaKhenThuong(Request $request, $masv, $id){
        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $khenthuong = DB::table("table_sinhvien_khenthuong")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.SuaKhenThuong")->with([
            "khenthuong" => $khenthuong,
            "sinhvien" => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky,
            'sinhvien_static' => $sinhvien_static
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
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function xoaKhenThuong(Request $request, $masv, $id){
        $xoa = DB::table("table_sinhvien_khenthuong")->where("id", $id)
            ->update([
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'trangthai' => 0
            ]);
        return redirect()->back();
    }

    function themKyLuatView(Request $request, $masv){
        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view('Admin.SinhVien.Sua.ThemKyLuat')->with([
            'sinhvien' => $sinhvien,
            "namhoc_hocky" => $namhoc_hocky,
            "sinhvien_static" => $sinhvien_static
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
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function suaKyLuat(Request $request, $masv, $id){
        $sinhvien_static = null;

        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $kyluat = DB::table("table_sinhvien_kyLuat")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.SuaKyLuat")->with([
            "kyluat" => $kyluat,
            "sinhvien" => $sinhvien,
            'namhoc_hocky' => $namhoc_hocky,
            "sinhvien_static" => $sinhvien_static
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
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function xoaKyLuat(Request $request, $masv, $id){
        $xoa = DB::table("table_sinhvien_kyluat")->where("id", $id)
            ->update([
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'trangthai' => 0
            ]);
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

