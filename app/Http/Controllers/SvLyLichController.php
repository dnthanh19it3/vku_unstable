<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvLyLichController extends Controller
{
    function getLyLich (Request $request){
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->where('table_sinhvien.masv', '=', session('masv'))
            ->first();
        $tamtru = DB::table('table_sinhvien_tamtru')->where('masv', session('masv'))->orderBy('created_at', 'desc')->first();
        return view('Sv.HoSo.LyLich')->with([
            'sv' => $sinhvien,
            'tamtru' => $tamtru
        ]);
    }
}
