<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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

    // Danh sách sinh viên (Tìm kiếm theo lớp, khoá, khoa)
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
        return view("Admin.SinhVien.danhsach")->with([
            "nganh" => $nganh,
            "lop" => $lop,
            "sinhvien" => $sinhvien
        ]);
    }
    // Xem chi tiết sinh viên
    function chiTietSinhVienView(Request $request, $masv)
    {
        $sinhvien = $this->getSinhVien($masv);

        if(!$sinhvien){
            die("Không tìm thấy dữ liệu sinh viên!");
        }

        // Lấy chi tiết sinh viên
        $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->first();
        if(!$sinhvien_chitiet){
            die("Không tìm thấy dữ liệu sinh viên!");
        }
        // Xử lý thành phần gia đình sinh viên
        $sinhvien_chitiet->thanhphangiadinh = $sinhvien_chitiet->thanhphangiadinh ? explode('|', $sinhvien_chitiet->thanhphangiadinh) : null;
        // Get thông tin tạm trú
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", $masv)->get();

        // Xử lý thông tin đoàn thể
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
        // Khen thưởng
        $khenthuong = DB::table('table_sinhvien_khenthuong')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('masv', $masv)
            ->get();
        // Kỷ luật
        $kyluat = DB::table('table_sinhvien_kyluat')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('masv', $masv)->get();
        // Logs
        $log_sinhvien = DB::table('table_log_sinhvien')->join('table_log_loai', 'table_log_sinhvien.id_log_loai', '=', 'table_log_loai.id')->where('masv', $masv)->orderBy('created_at', 'DESC')->get();
        // Rèn luyện
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

        // Tạm trú
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $masv)
            ->where('table_sinhvien_tamtru.trangthai', '=', 1)
            ->where('table_sinhvien_tamtru.hienhanh', '=', 1)
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



        return view('Admin.SinhVien.chitiet')
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

    // Sửa thông tin cá nhân view
    public function caNhanView(Request $request, $masv)
    {
        // Get thông tin sinh viên ( chỉ để hiển thị ở cột trái)
        $sinhvien_static = $this->getSinhVien($masv);
        // Get thông tin sinh viên ( cho các ô edit)
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_nganh", "table_sinhvien.nganh_id", "=", "table_nganh.id")
            ->first();
        if(!$sinhvien) {die('Không tìm thấy thông tin sinh viên');}
        // Xử lý thông tin thành phần gia đình
        $sinhvien->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;

        return view("Admin.SinhVien.Sua.canhan")->with([
            "sinhvien" => $sinhvien,
            "sinhvien_static" => $sinhvien_static
        ]);
    }

    // Sửa thông tin cá nhân post
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

        if(isset($giadinh['thanhphangiadinh'])){
            if(count($giadinh['thanhphangiadinh']) > 0){
                $giadinh['thanhphangiadinh'] = implode('|', $giadinh['thanhphangiadinh']);
            }
        } else {
            $giadinh['thanhphangiadinh'] = null;
        }

        $chitiet_data = array_merge($canhan, $giadinh, $lienlac, $diachi);

        $sinhvien_data['updated_at'] = \Illuminate\Support\Carbon::now();
        $chitiet_data['updated_at'] = \Illuminate\Support\Carbon::now();


        DB::beginTransaction();

        $update_sinhvien = DB::table('table_sinhvien')->where('masv', $masv)->update($sinhvien_data);
        $update_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->update($chitiet_data);

        if(!$update_chitiet || !$update_sinhvien){
            $flag = 0;
        }

        //Log
        if($flag){
            DB::commit();
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 3,
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return back();
    }

    //Khenthuong
    function khenThuong(Request $request, $masv){
        $sinhvien_static = $this->getSinhVien($masv);

        if(!$sinhvien_static){
            die("Không tìm thấy sinh viên này!");
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

        return view("Admin.SinhVien.Sua.khenthuongkyluat")->with([
            "khenthuong" => $khenthuong,
            "kyluat" => $kyluat,
            "sinhvien" => $sinhvien,
            'sinhvien_static' => $sinhvien_static
        ]);
    }
    function themKhenThuongView(Request $request, $masv){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){
            die("Không tìm thấy sinh viên này!");
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
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }

    function suaKhenThuong(Request $request, $masv, $id){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){
            die("Không tìm thấy sinh viên này!");
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $khenthuong = DB::table("table_sinhvien_khenthuong")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.suakhenthuong")->with([
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
                'chitiet' => "Chỉnh sửa thông tin rèn luyện #$id",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }

        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function xoaKhenThuong(Request $request, $masv, $id){
        $xoa = DB::table("table_sinhvien_khenthuong")->where("id", $id)
            ->update([
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'trangthai' => 0
            ]);
        if($xoa){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 9,
                'chitiet' => "Xoá thông tin khen thưởng #$id",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect()->back();
    }

    function themKyLuatView(Request $request, $masv){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){
            die("Không tìm thấy sinh viên này!");
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view('Admin.SinhVien.Sua.themkyluat')->with([
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
        $response = DB::table("table_sinhvien_kyluat")->insertGetId($data);
        if($response){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 5,
                'chitiet' => "Thêm thông tin kỷ luật #$response",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function suaKyLuat(Request $request, $masv, $id){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){
            die("Không tìm thấy sinh viên này!");
        }
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->first();
        $kyluat = DB::table("table_sinhvien_kyLuat")->where("masv", $masv)->where("id", $id)->first();
        $namhoc_hocky = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');
        return view("Admin.SinhVien.Sua.suakyluat")->with([
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
                'chitiet' => "Sửa thông tin kỷ luật #$id",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect(route('ad.suasinhvien.khenthuong', ['masv' => $masv]));
    }
    function xoaKyLuat(Request $request, $masv, $id){
        $xoa = DB::table("table_sinhvien_kyluat")->where("id", $id)
            ->update([
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'trangthai' => 0
            ]);
        if($xoa){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 8,
                'chitiet' => "Xoá thông tin kỷ luật #$id",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect()->back();
    }
    // Index tạm trú
    public function tamTruView(Request $request, $masv)
    {
        // Get thông tin sinh viên ( chỉ để hiển thị ở cột trái)
        $sinhvien_static = $this->getSinhVien($masv);
        // Get sinh viên
        $sinhvien = DB::table("table_sinhvien")->where("table_sinhvien.masv", $masv)
            ->join("table_sinhvien_chitiet", "table_sinhvien.masv", "=", "table_sinhvien_chitiet.masv")
            ->join("table_lopsh", "table_sinhvien.lopsh_id", "=", "table_lopsh.id")
            ->join("table_nganh", "table_sinhvien.nganh_id", "=", "table_nganh.id")
            ->first();
        if(!$sinhvien) {die('Không tìm thấy thông tin sinh viên');}

        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        $khaibaohientai = DB::table('table_sinhvien_tamtru')->where(['masv' => $masv, 'namhoc' => $hocky_info->id, 'hocky' => $hocky_info->hocky, 'hienhanh' => 1])->first();
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_tamtru.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_tamtru.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->join('table_static_provinces', 'table_sinhvien_tamtru.tinhthanh_id', 'table_static_provinces.id')
            ->join('table_static_districts', 'table_sinhvien_tamtru.quanhuyen_id', 'table_static_districts.id')
            ->join('table_static_wards', 'table_sinhvien_tamtru.xaphuong_id', 'table_static_wards.id')
            ->where('table_sinhvien_tamtru.masv', '=', $masv)
            ->where('table_sinhvien_tamtru.trangthai', '=', 1)
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
                'table_sinhvien_tamtru.hienhanh',
                'table_sinhvien_tamtru.created_at',
                'table_namhoc_hocky.nambatdau',
                'table_namhoc_hocky.namketthuc'
            ]);

        return view("Admin.SinhVien.Sua.tamtru")->with([
            "sinhvien_static" => $sinhvien_static,
            "sinhvien" => $sinhvien,
            'tamtru' => $tamtru,
            'hocky' => $hocky_info,
            'khaibaohientai' => $khaibaohientai
        ]);
    }
    // Tao tam tru
    public function taoTamTru(Request $request, $masv){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){die("Không tìm thấy sinh viên");}
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', $masv)
            ->where('id', '=', $request->tamtru_id)
            ->first();

        $tamtrukey =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', $masv)
            ->orderBy('created_at', 'desc')
            ->first();

        $tamtrukey = ($tamtrukey != null) ? $tamtrukey->id : null;
        $tinhthanh = DB::table('table_static_provinces')->orderBy('name')->get();
        $hocky_info = DB::table('table_namhoc_hocky')->get();

        return view('Admin.SinhVien.Sua.themtamtru')->with([
            'tamtru' => $tamtru,
            'tamtrukey' => $tamtrukey,
            'tinhthanh' => $tinhthanh,
            'sinhvien_static' => $sinhvien_static,
            'hocky_info' => $hocky_info
        ]);
    }
    public function suaTamTru(Request $request, $masv, $id){
        $sinhvien_static = $this->getSinhVien($masv);
        if(!$sinhvien_static){die("Không tìm thấy sinh viên");}
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', $masv)
            ->where('id', '=', $id)
            ->first();
        if(!$tamtru){die("Không thể truy xuất bảng ghi tạm trú này! Vui lòng kiểm tra lại");}
        $tamtru->namhoc_hocky = implode('|', [$tamtru->namhoc, $tamtru->hocky]);
        if(!$tamtru){die("Không tìm thấy bản ghi tạm trú này");}
        $tinhthanh = DB::table('table_static_provinces')->orderBy('name')->get();
        $hocky_info = DB::table('table_namhoc_hocky')->get(); // Thông tin học kì


        return view('Admin.SinhVien.Sua.suatamtru')->with([
            'tamtru' => $tamtru,
            'tinhthanh' => $tinhthanh,
            'sinhvien_static' => $sinhvien_static,
            'hocky_info' => $hocky_info
        ]);
    }
    public function taoTamTruPost(Request $request, $masv)
    {


        $flag = 1;
        $namhoc_hocky = null;
        if(isset($request['namhoc_hocky'])){
            $namhoc_hocky = explode('|', $request['namhoc_hocky']);
        }

        $tamtrucu = DB::table('table_sinhvien_tamtru')->where('masv', $masv)->where('trangthai', 1)->first();    //Tạm trú cũ

        $msg = [];
        $error = 0;

        $email_regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $phone_regex = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';

        $data = [];

        $validate_sdt = preg_match($phone_regex, $request->sdtchuho);
        // Validate số điện thoại
        if($validate_sdt){
            $data['sdtchuho'] = $request->sdtchuho;
        } else {
            array_push($msg, "SĐT chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->xaphuong_id && $request->quanhuyen_id && $request->tinhthanh_id && $request->sonha && $request->thonto){
            $data['xaphuong_id'] = $request->xaphuong_id;
            $data['quanhuyen_id'] = $request->quanhuyen_id;
            $data['tinhthanh_id'] = $request->tinhthanh_id;
            $data['sonha'] = $request->sonha;
            $data['thonto'] = $request->thonto;
        } else {
            array_push($msg, "Địa chỉ không hợp lệ");
            $error = 1;
        }
        if($request->tenchuho){
            $data['tenchuho'] = $request->tenchuho;
        } else {
            array_push($msg, "Tên chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->thoigianbatdau){
            $data['thoigianbatdau'] = $request->thoigianbatdau;
        } else {
            array_push($msg, "Thời gian bắt đầu không được bỏ trống");
            $error = 1;
        }


        // Tiep tuc cap nhat
        $data['trangthai'] = 1;
        $data['hienhanh'] = $request->hienhanh;
        $data['created_at'] = Carbon::now();
        $data['masv'] = $masv;

        if(is_array($namhoc_hocky)){
            if(count($namhoc_hocky) > 1){
                $data['namhoc'] = $namhoc_hocky[0];
                $data['hocky'] = $namhoc_hocky[1];
            } else {
                array_push($msg, "Năm học học kỳ không được bỏ trống!");
                $error = 1;
            }
        }

        // Loi input, tra ve thong bao loi
        if($error){
            $request->session()->flash('error', $msg);
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        }

        foreach ($data as $key => $value) {
            $value = trim($value);
        }
        // Đổi trạng thái tạm trú cũ sang 0
        if (isset($tamtrucu)) {
            $disabletamtrucu = DB::table('table_sinhvien_tamtru')
                ->where('id', $tamtrucu->id)
                ->update(['trangthai' => 0]);
        }
        // Tạo bản ghi mới
        $insert = DB::table('table_sinhvien_tamtru')->insert($data);
        if (!$insert) {
            $flag = 0;
        } else {
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 2,
                'chitiet' => "Phòng công tác sinh viên đã thêm bản ghi tạm trú",
                'created_at' => Carbon::now()
            ]);
        }
        // Cập nhật lại route quay về bảng chi tiết, thêm thông báo thành công!
        if($flag){
            $request->session()->flash('success', "Cập nhật thành công!");
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        } else {
            $request->session()->flash('error', "Cập nhật thất bại!");
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        }
    }
    public function suaTamTruPost(Request $request, $masv, $id)
    {
        $flag = 1;

        $namhoc_hocky = null;
        if(isset($request['namhoc_hocky'])){
            $namhoc_hocky = explode('|', $request['namhoc_hocky']);
        }
        $tamtrucu = DB::table('table_sinhvien_tamtru')->where('masv', $masv)->where('trangthai', 1)->first();    //Tạm trú cũ

        $msg = [];
        $error = 0;

        $email_regex = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $phone_regex = '/(84|0[3|5|7|8|9])+([0-9]{8})\b/';

        $data = [];

        $validate_sdt = preg_match($phone_regex, $request->sdtchuho);
        // Validate số điện thoại
        if($validate_sdt){
            $data['sdtchuho'] = $request->sdtchuho;
        } else {
            array_push($msg, "SĐT chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->xaphuong_id && $request->quanhuyen_id && $request->tinhthanh_id && $request->sonha && $request->thonto){
            $data['xaphuong_id'] = $request->xaphuong_id;
            $data['quanhuyen_id'] = $request->quanhuyen_id;
            $data['tinhthanh_id'] = $request->tinhthanh_id;
            $data['sonha'] = $request->sonha;
            $data['thonto'] = $request->thonto;
        } else {
            array_push($msg, "Địa chỉ không hợp lệ");
            $error = 1;
        }
        if($request->tenchuho){
            $data['tenchuho'] = $request->tenchuho;
        } else {
            array_push($msg, "Tên chủ hộ không hợp lệ");
            $error = 1;
        }
        if($request->thoigianbatdau){
            $data['thoigianbatdau'] = $request->thoigianbatdau;
        } else {
            array_push($msg, "Thời gian bắt đầu không được bỏ trống");
            $error = 1;
        }

        // Loi input, tra ve thong bao loi
        if($error){
            $request->session()->flash('error', $msg);
            return redirect(route('sv.tamtru.index'));
        }
        // Tiep tuc cap nhat
        $data['hienhanh'] = $request->hienhanh;
        $data['updated_at'] = Carbon::now();
        if(is_array($namhoc_hocky)){
            if(count($namhoc_hocky) > 1){
                $data['namhoc'] = $namhoc_hocky[0];
                $data['hocky'] = $namhoc_hocky[1];
            } else {
                array_push($msg, "Năm học học kỳ không được bỏ trống!");
                $error = 1;
            }
        }

        // Loi input, tra ve thong bao loi
        if($error){
            $request->session()->flash('error', $msg);
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        }

        foreach ($data as $key => $value) {
            $value = trim($value);
        }
        // Đổi trạng thái tạm trú cũ sang 0
        if ($request->hienhanh) {
            $disabletamtrucu = DB::table('table_sinhvien_tamtru')
                ->where('masv', $masv)
                ->where('hienhanh', 1)
                ->update(['trangthai' => 0]);
        }
        // Tạo bản ghi mới
        $insert = DB::table('table_sinhvien_tamtru')->where('id', $id)->update($data);
        if (!$insert) {
            $flag = 0;
        } else {
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 2,
                'chitiet' => "Phòng công tác sinh viên đã thêm bản ghi tạm trú",
                'created_at' => Carbon::now()
            ]);
        }

        // Cập nhật lại route quay về bảng chi tiết, thêm thông báo thành công!
        if($flag){
            $request->session()->flash('success', "Cập nhật thành công!");
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        } else {
            $request->session()->flash('error', "Cập nhật thất bại!");
            return redirect(route('ad.suasinhvien.tamtru', ['masv' => $masv]));
        }
    }
    function xoaTamTru(Request $request, $masv, $id){
        $xoa = DB::table("table_sinhvien_tamtru")->where("id", $id)
            ->update([
                'updated_at' => \Illuminate\Support\Carbon::now(),
                'trangthai' => 0
            ]);
        if($xoa){
            //Log
            $log = DB::table('table_log_sinhvien')->insert([
                'masv' => $masv,
                'id_log_loai' => 12,
                'chitiet' => "Xoá thông tin khen thưởng #$id",
                'created_at' => Carbon::now()
            ]);
            $request->session()->flash('success', "Thành công!");
        } else {
            $request->session()->flash('error', "Thất bại!");
        }
        return redirect()->back();
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

