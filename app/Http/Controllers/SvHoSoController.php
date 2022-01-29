<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mikehaertl\pdftk\Pdf;

class SvHosoController extends Controller
{


    /**
     *   Cập nhật dữ liệu sinh viên
     */
    public function suahosoStore(Request $request){
        $flag = 1;
        DB::beginTransaction();
        $data = $this->validate($request,
            [
                "email_khac" => "nullable|email",
                "dienthoai" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
                "zalo" => ["nullable", "regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/"],
                "facebook" => ["nullable", "regex:/(?:http:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/"],
            ],
            [
                "email_khac" => "Định dạng email không đúng",
                "dienthoai" => "Định dạng số điện thoại không đúng",
                "zalo" => "Định dạng số điện thoại không đúng",
                "facebook" => "Định dạng số link facebook không đúng",
            ]);
        $update = DB::table('table_sinhvien_chitiet')->where('masv', session('masv'))->update($data);
        if (!$update) {
            $flag = 0;
        }
        //Log
        $log = DB::table('table_log_sinhvien')->insert([
            'masv' => session('masv'),
            'id_log_loai' => 1,
            'created_at' => now()
        ]);

        if ($flag) {
            DB::commit();
            return back();
        } else {
            DB::rollBack();
            return back();
        }
    }
    /**
     *   View sửa hồ sơ
     */
    public function suahosoIndex()
    {
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->where('table_sinhvien.masv', '=', session('masv'))
            ->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        if (isset($sinhvien->avatar)) {
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }

        return view('Sv.HoSo.SuaHoSo')->with([
            'sinhvien' => $sinhvien,
            'hocky' => $hocky_info,
        ]);
    }

    /**
     *  View hồ sơ
     */
    public function hosoIndex(Request $request){
        $masv = '19IT195';
        $sinhvien = null;


        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien = $item;
                break;
            }
        }

//        dd($sinhvien);

//        $sinhvie->thanhphangiadinh = $sinhvien->thanhphangiadinh ? explode('|', $sinhvien->thanhphangiadinh) : null;
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", session('masv'))->get();

        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }

        $khenthuong = DB::table('table_sinhvien_khenthuong')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_khenthuong.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_khenthuong.hocky", "=", "table_namhoc_hocky.hocky");
            })->where('masv', session('masv'))
            ->get();

        $kyluat = DB::table('table_sinhvien_kyluat')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_sinhvien_kyluat.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_sinhvien_kyluat.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('masv', session('masv'))->get();
        $log_sinhvien = DB::table('table_log_sinhvien')->join('table_log_loai', 'table_log_sinhvien.id_log_loai', '=', 'table_log_loai.id')->where('masv', session('masv'))->orderBy('created_at', 'DESC')->get();
        $renluyen = DB::table('table_danhgiarenluyen')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_danhgiarenluyen.masv', session('masv'))
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
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png"; // Nếu chưa có hồ sơ thay bằng ảnh trắng
        }



        return view('Sv.HoSo.xemhoso')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvienTamtru', $sinhhvienTamtru)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('log_sinhvien', $log_sinhvien)
            ->with('renluyen', $renluyen)
            ->with('renluyen_chart', $renluyen_chart);
    }
}


    function getTruongTinh($key, $data){
        $data = (object) $data;
        switch ($key) {
            case 'hoten':
                return $data->hodem." ".$data->ten;
            case 'ngaysinh':
                return vnDate($data->ngaysinh);
            case 'gioitinh':
                return $data->gioitinh ? 'Nữ' : 'Nam';
            case 'tongiao':
                if($data->tongiao == 0){
                    return "Không";
                }
                return $data->tongiao;
            case 'doanthe':
                switch ($data->doanthe) {
                    case 0:
                        return "Không";
                    case 1:
                        return "Đoàn viên";
                    case 2:
                        return "Đảng viên";
                }
            case 'ngayketnap':
                return $data->ngayketnap ? vnDate($data->ngayketnap) : "";
            case 'khoa':
                return "Chưa có dữ liệu";
            case 'khoaK':
                return $data->khoaK;
            case 'tennganh':
                if($data->tennganh && $data->tenchuyennganh){
                    return $data->tennganh;
                } else {
                    return $data->tenchuyennganh;
                }
            case 'tenchuyennganh':
                if($data->tenchuyennganh != null && $data->tennganh != null){
                    return $data->tenchuyennganh;
                } else {
                    return null;
                }
            case 'hokhauthuongtru':
                return $data->xa_phuong . ', ' . $data->quan_huyen . ', ' . $data->tinh_thanh;
        }
    }
