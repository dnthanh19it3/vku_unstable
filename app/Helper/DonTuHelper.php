<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function vnDate($date){
    return \Carbon\Carbon::make($date)->format('d/m/Y');
}
function getSinhVienData($masv){
    $sinhvien = DB::table('table_sinhvien')
        ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
        ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
        ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
        ->where('table_sinhvien.masv', $masv)
        ->first([
            //Sinhvien
            'table_sinhvien.masv',
            'table_sinhvien.hodem',
            'table_sinhvien.ten',
            'table_sinhvien.ngaysinh',
            'table_sinhvien.gioitinh',
            'table_sinhvien.email',
            //Chi tiet sinh vien
            'table_sinhvien_chitiet.dantoc',
            'table_sinhvien_chitiet.noisinh',
            'table_sinhvien_chitiet.tongiao',
            'table_sinhvien_chitiet.tinh_thanh',
            'table_sinhvien_chitiet.quan_huyen',
            'table_sinhvien_chitiet.xa_phuong',
            'table_sinhvien_chitiet.thon_to',
            'table_sinhvien_chitiet.dia_chi_lien_lac',
            'table_sinhvien_chitiet.email_khac',
            'table_sinhvien_chitiet.cmnd',
            'table_sinhvien_chitiet.ngaycap',
            'table_sinhvien_chitiet.noicap',
            //Thong tin cha
            'table_sinhvien_chitiet.hotencha',
            'table_sinhvien_chitiet.namsinhcha',
            'table_sinhvien_chitiet.dantoc_cha',
            'table_sinhvien_chitiet.cmnd_cha',
            'table_sinhvien_chitiet.nghenghiep_cha',
            'table_sinhvien_chitiet.diachi_cha',
            'table_sinhvien_chitiet.email_cha',
            'table_sinhvien_chitiet.sdt_cha',
            //Thong tin me
            'table_sinhvien_chitiet.hotenme',
            'table_sinhvien_chitiet.namsinhme',
            'table_sinhvien_chitiet.dantoc_me',
            'table_sinhvien_chitiet.cmnd_me',
            'table_sinhvien_chitiet.nghenghiep_me',
            'table_sinhvien_chitiet.diachi_me',
            'table_sinhvien_chitiet.email_me',
            'table_sinhvien_chitiet.sdt_me',
            //Gia dinh
            'table_sinhvien_chitiet.thanhphangiadinh',
            //Lien he
            'table_sinhvien_chitiet.dienthoai',
            'table_sinhvien_chitiet.avatar',
            'table_sinhvien_chitiet.facebook',
            'table_sinhvien_chitiet.zalo',
            'table_sinhvien_chitiet.ma_bhyt',
            'table_sinhvien_chitiet.sotaikhoan',
            'table_sinhvien_chitiet.nganhang',
            'table_sinhvien_chitiet.doanthe',
            'table_sinhvien_chitiet.ngayketnap',
            //Lop SH
            'table_lopsh.tenlop',
            'table_lopsh.khoaK',
            // Nganh
            'table_nganh.tennganh',
        ]);

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
            return $data->gioitinh ? 'Nam' : 'Nữ';
        case 'email':
            return $data->email;
        case 'dantoc':
            return $data->dantoc;
        case 'noisinh':
            return $data->noisinh;
        case 'tongiao':
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
            return vnDate($data->ngayketnap);
        case 'tenlop':
            return $data->tenlop;
        case 'khoa':
            return $data->khoaK;
        case 'tennganh':
            return $data->tennganh;

    }
}