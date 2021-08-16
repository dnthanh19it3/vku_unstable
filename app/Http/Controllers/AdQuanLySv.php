<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class AdQuanLySv extends Controller
{
    function danhSachSvView(Request $request)
    {
        $lop = DB::table('table_lopsh')->get();
        $nganh = DB::table('table_nganh')->get();

        $sinhvien_stmt = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id');

        if (isset($request->masv)) {
            $sinhvien_stmt->where('table_sinhvien.masv', 'LIKE', '%' . $request->masv . '%');
        }
        if (isset($request->lop)) {
            $sinhvien_stmt->where('table_sinhvien.lopsh_id', '=', $request->lop);
        }
        if (isset($request->nganh)) {
            $sinhvien_stmt->where('table_sinhvien.nganh_id', '=', $request->nganh);
        }

        $sinhvien = $sinhvien_stmt->paginate(100);
        return view('Admin.SinhVien.DanhSach')->with([
            'nganh' => $nganh,
            'lop' => $lop,
            'sinhvien' => $sinhvien
        ]);
    }

    function chiTietSinhVienView(Request $request, $masv)
    {
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->first();
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", $masv)->get();
        $tamtru = DB::table('table_sinhvien_tamtru')
            ->join('table_namhoc_hocky', 'table_sinhvien_tamtru.namhoc_hocky', '=', 'table_namhoc_hocky.namhoc_key')
            ->where('table_sinhvien_tamtru.masv', '=', $masv)
            ->get();
        $khenthuong = DB::table('table_sinhvien_khenthuong')->where('masv', '=', $masv)->get();
        $kyluat = DB::table('table_sinhvien_kyluat')->where('masv', '=', $masv)->get();
        $anhdatailen = DB::table('table_sinhvien_anhcu')->where('masv', '=', $masv)->get();
        $timeline = DB::table('table_sinhvien_timeline')->where('masv', $masv)->orderBy('thoigian', 'DESC')->get();
        $renluyen = DB::table('table_danhgiarenluyen')
            ->join('table_namhoc_hocky', 'table_danhgiarenluyen.namhoc_key', '=', 'table_namhoc_hocky.namhoc_key')
            ->where('table_danhgiarenluyen.masv', $masv)
            ->get();
        if (isset($sinhvien->avatar)) {
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        return view('Admin.SinhVien.Chitiet')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvienTamtru', $sinhhvienTamtru)
            ->with('tamtru', $tamtru)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('anhdatailen', $anhdatailen)
            ->with('renluyen', $renluyen)
            ->with('timeline', $timeline);
    }
    /*
     Sua ho so
    */

    //Ca nhan get
    public function caNhanView(Request $request, $masv)
    {
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
        return view('Admin.SinhVien.Sua.CaNhan')->with([
            'sinhvien' => $sinhvien,
        ]);
    }

    //Ca nhan post
    public function caNhanStore(Request $request, $masv)
    {

        $sinhvien = [
            "hodem" => $request->hodem,
            "ten" => $request->ten,
            "ngaysinh" => $request->ngaysinh,
            "gioitinh" => $request->gioitinh,
        ];

        $sinhvien_chitiet = [
            "cmnd" => $request->cmnd,
            "ngaycap" => $request->ngaycap,
            "noicap" => $request->noicap,
            "ma_bhyt" => $request->ma_bhyt,
            "doanthe" => $request->doanthe,
            "tongiao" => $request->tongiao,
            "hotencha" => $request->hotencha,
            "namsinhcha" => $request->namsinhcha,
            "hotenme" => $request->hotenme,
            "namsinhme" => $request->namsinhme,
            "tinh_thanh" => $request->tinh_thanh,
            "quan_huyen" => $request->quan_huyen,
            "xa_phuong" => $request->xa_phuong,
            "thon_to" => $request->thon_to,
            "dia_chi_lien_lac" => $request->dia_chi_lien_lac,
            "email_khac" => $request->email_khac,
            "facebook" => $request->facebook,
            "dienthoai" => $request->dienthoai,
            "dienthoaigiadinh" => $request->dienthoaigiadinh
        ];

        $update_sinhvien = DB::table('table_sinhvien')->where('masv', $masv)->update($sinhvien);
        $update_sinhvien_chitiet = DB::table('table_sinhvien_chitiet')->where('masv', $masv)->update($sinhvien_chitiet);

        if ($update_sinhvien || $update_sinhvien_chitiet) {
            pushNotify(1);
            return redirect()->back();
        } else {
            pushNotify(0);
            return redirect()->back();
        }
    }
    // Anh
    function anhView(Request $request, $masv){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        if(isset($sinhvien->avatar)){
        $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        $anhdatailen = DB::table('table_sinhvien_anhcu')->where('masv', '=', $masv)->get();

        return view('Admin.SinhVien.Sua.Anh')->with([
            'sinhvien' => $sinhvien,
            'anhdatailen' => $anhdatailen
        ]);
    }
    function duyetAnh(Request $request, $masv)
    {

        $sinhvien = DB::table('table_sinhvien_chitiet')->where('masv', '=', $masv)->first();
        $old_path = 'AnhHoSoCu/' . $masv . "_" . time() . '.png';

        if(isset($sinhvien->avatar)){
            $backup_cu = File::copy(public_path($sinhvien->avatar), public_path($old_path));
            DB::table('table_sinhvien_anhcu')->insert([
                'masv' => $masv,
                'duongdan' => $old_path,
                'created_at' => Carbon::now()
            ]);
        }

        $copy = File::copy(public_path($sinhvien->avatar_temp), public_path('AnhHoSo/' . $masv . '.png'));
        $change = null; //Flag

        if ($copy) {
            $change = DB::table('table_sinhvien_chitiet')->where('masv', '=', $masv)->update(['avatar' => 'AnhHoSo/' . $masv . '.png', 'avatar_temp' => null]);
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
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $khenthuong = DB::table('table_sinhvien_khenthuong')->where('masv', $masv)->get();
        return view('Admin.SinhVien.Sua.KhenThuong')->with([
            'khenthuong' => $khenthuong,
            'sinhvien' => $sinhvien
        ]);
    }
    function khenThuongStore(Request $request, $masv)
    {
        $data = [
            'masv' => $masv,
            'noidung' => $request->noidung,
            'capkhenthuong' => $request->capkhenthuong,
            'soquyetdinh' => $request->soquyetdinh,
            'thoigian' => $request->thoigian,
            'created_at' => Carbon::now()
        ];
        $response = DB::table('table_sinhvien_khenthuong')->insert($data);
        pushNotify($response);
        return redirect()->back();
    }
    function suaKhenThuong(Request $request, $masv, $id){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $khenthuong = DB::table('table_sinhvien_khenthuong')->where('masv', $masv)->where('id', $id)->first();
        return view('Admin.SinhVien.Sua.SuaKhenThuong')->with([
            'khenthuong' => $khenthuong,
            'sinhvien' => $sinhvien
        ]);
    }
    function suaKhenThuongStore(Request $request, $masv, $id)
    {
        $data = [
            'masv' => $masv,
            'noidung' => $request->noidung,
            'capkhenthuong' => $request->capkhenthuong,
            'soquyetdinh' => $request->soquyetdinh,
            'thoigian' => $request->thoigian,
            'updated_at' => Carbon::now()
        ];

        $response = DB::table('table_sinhvien_khenthuong')->where('id', $id)->update($data);

        pushNotify($response);
        return redirect()->back();
    }
    function xoaKhenThuong(Request $request, $masv, $id){
        $xoa = DB::table('table_sinhvien_khenthuong')->where('id', $id)->delete();
        pushNotify($xoa);
        return redirect()->back();
    }

    //Kyluat
    function kyLuat(Request $request, $masv){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $kyluat = DB::table('table_sinhvien_kyluat')->where('masv', $masv)->get();
        return view('Admin.SinhVien.Sua.KyLuat')->with([
            'kyluat' => $kyluat,
            'sinhvien' => $sinhvien
        ]);
    }
    function kyLuatStore(Request $request, $masv)
    {
        $data = [
            'masv' => $masv,
            'noidung' => $request->noidung,
            'hinhthuckyluat' => $request->hinhthuckyluat,
            'capquyetdinh' => $request->capquyetdinh,
            'soquyetdinh' => $request->soquyetdinh,
            'thoigian' => $request->thoigian,
            'created_at' => Carbon::now()
        ];
        $response = DB::table('table_sinhvien_kyluat')->insert($data);
        pushNotify($response);
        return redirect()->back();
    }
    function suaKyLuat(Request $request, $masv, $id){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->first();
        $kyluat = DB::table('table_sinhvien_kyLuat')->where('masv', $masv)->where('id', $id)->first();
        return view('Admin.SinhVien.Sua.SuaKyLuat')->with([
            'kyluat' => $kyluat,
            'sinhvien' => $sinhvien
        ]);
    }
    function suaKyLuatStore(Request $request, $masv, $id)
    {
        $data = [
            'noidung' => $request->noidung,
            'hinhthuckyluat' => $request->hinhthuckyluat,
            'capquyetdinh' => $request->capquyetdinh,
            'soquyetdinh' => $request->soquyetdinh,
            'thoigian' => $request->thoigian,
            'updated_at' => Carbon::now()
        ];
        $response = DB::table('table_sinhvien_kyluat')->where('id', $id)->update($data);
        pushNotify($response);
        return redirect()->back();
    }
    function xoaKyLuat(Request $request, $masv, $id){
        $xoa = DB::table('table_sinhvien_kyluat')->where('id', $id)->delete();
        pushNotify($xoa);
        return redirect()->back();
    }
}
//public function caNhanView(Request $request, $masv){
//    $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', $masv)->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
//    $tamtru = DB::table('table_sinhvien_tamtru')->where('id', '=', $sinhvien->tamtru)->first();
//    $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
//    $kyluat = DB::table('table_sinhvien_kyluat')->where('masv', '=', $masv)->get();
//    $tamtrucount = DB::table('table_sinhvien_tamtru')
//        ->where('masv', '=', session('masv'))
//        ->where('namhoc_hocky', '=', $hocky_info->namhoc_key)
//        ->count('id');
//    $anhdatailen = DB::table('table_sinhvien_anh')->where('masv', '=', $masv)->get();
//    if(isset($sinhvien->avatar)){
//        $sinhvien->avatar = asset($sinhvien->avatar);
//    } else {
//        $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
//    }
//    return view('Admin.SinhVien.Sua.CaNhan')->with([
//        'sinhvien'=> $sinhvien,
//        'tamtru' => $tamtru,
//        'hocky' => $hocky_info,
//        'tamtrucount' => $tamtrucount,
//        'anhdatailen' => $anhdatailen,
//        'kyluat' => $kyluat
//    ]);
//}
