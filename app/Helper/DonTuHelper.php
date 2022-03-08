<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function vnDate($date){
    return \Carbon\Carbon::make($date)->format('d/m/Y');
}
function getSinhVienData($masv){
    $sinhvien_static = null;
    $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
    foreach ($sinhvien_all as $key => $item){
        if($item->masv == $masv){
            $sinhvien_static = $item;
            break;
        }
    }
    $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')
        ->where('table_sinhvien_chitiet.masv', $masv)
        ->first();
    $sinhvien = array_merge((array) $sinhvien_chitiet, (array) $sinhvien_static);
    return $sinhvien;
}
function getTruongTinh($key, $data){
    $data = (object) $data;
    switch ($key) {
        case 'masv':
            return $data->masv;
        case 'hoten':
            return $data->hodem." ".$data->ten;
        case 'hodem':
            return $data->hodem;
        case 'ten':
            return $data->ten;
        case 'ngaysinh':
            return vnDate($data->ngaysinh);
        case 'gioitinh':
            return $data->gioitinh ? 'Nữ' : 'Nam';
        case 'email':
            return $data->email;
        case 'dantoc':
            return $data->dantoc;
        case 'noisinh':
            return $data->noisinh;
        case 'tongiao':
            if($data->tongiao == 0){
                return "Không";
            }
            return $data->tongiao;
        case 'tinh_thanh':
            return $data->tinh_thanh;
        case 'quan_huyen':
            return $data->quan_huyen;
        case 'xa_phuong':
            return $data->xa_phuong;
        case 'thon_to':
            return $data->thon_to;
        case 'dia_chi_lien_lac':
            return $data->dia_chi_lien_lac;
        case 'email_khac':
            return $data->email_khac;
        case 'cmnd':
            return $data->cmnd;
        case 'ngaycap':
            return $data->ngaycap;
        case 'noicap':
            return $data->noicap;
        case 'hotencha':
            return $data->hotencha;
        case 'namsinhcha':
            return $data->namsinhcha;
        case 'dantoc_cha':
            return $data->dantoc_cha;
        case 'cmnd_cha':
            return $data->cmnd_cha;
        case 'nghenghiep_cha':
            return $data->nghenghiep_cha;
        case 'diachi_cha':
            return $data->diachi_cha;
        case 'email_cha':
            return $data->email_cha;
        case 'sdt_cha':
            return $data->sdt_cha;
        case 'hotenme':
            return $data->hotenme;
        case 'namsinhme':
            return $data->namsinhme;
        case 'dantoc_me':
            return $data->dantoc_me;
        case 'cmnd_me':
            return $data->cmnd_me;
        case 'nghenghiep_me':
            return $data->nghenghiep_me;
        case 'diachi_me':
            return $data->diachi_me;
        case 'email_me':
            return $data->email_me;
        case 'sdt_me':
            return $data->sdt_me;
        case 'thanhphangiadinh':
            return $data->thanhphangiadinh;
        case 'dienthoai':
            return $data->dienthoai;
        case 'dienthoaigiadinh':
            return $data->dienthoaigiadinh;
        case 'facebook':
            return $data->facebook;
        case 'zalo':
            return $data->zalo;
        case 'ma_bhyt':
            return $data->ma_bhyt;
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
        case 'tenlop':
            return $data->tenlop;
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
        default:
            return "N/A";
    }
}